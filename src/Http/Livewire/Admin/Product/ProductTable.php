<?php

namespace Adminetic\Website\Http\Livewire\Admin\Product;

use Adminetic\Website\Models\Admin\Product;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProductTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Product::query()
            ->with('category')->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function bulkDelete()
    {
        Product::whereIn('id', $this->getSelected())->delete();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Active')
                ->options([
                    '' => 'All',
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No product found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Product::find((int)$item['value'])->update(['position' => (int)$item['order']]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable()
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Category", "category_id")
                ->format(
                    fn ($value, $row, Column $column) => $row->category->name ?? '-'
                )
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make("Active", "active")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-' . ($row->getRawOriginal('active') ? "success" : "danger") . ' ">' . ($row->getRawOriginal('active') ? "Active" : "Inactive") . '</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("SP", "selling_price")
                ->format(
                    fn ($value, $row, Column $column) => !is_null($row->selling_price) ? (currency() . $row->selling_price) : ''
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("CP", "cost_price")
                ->format(
                    fn ($value, $row, Column $column) => !is_null($row->cost_price) ? (currency() . $row->cost_price) : ''
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Discount", "discount")
                ->format(
                    fn ($value, $row, Column $column) => !is_null($row->discount) ? (currency() . $row->discount) : ''
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Quantity", "quantity")
                ->sortable()
                ->searchable(),
            Column::make("Action")
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="product" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
