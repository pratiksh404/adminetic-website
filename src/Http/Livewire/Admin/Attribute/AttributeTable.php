<?php

namespace Adminetic\Website\Http\Livewire\Admin\Attribute;

use Adminetic\Website\Models\Admin\Attribute;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AttributeTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Attribute::query()->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function filters(): array
    {
        return [
            SelectFilter::make('Searchable')
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('is_searchable', true);
                    } elseif ($value === '0') {
                        $builder->where('is_searchable', false);
                    }
                }),
        ];
    }

    public function bulkDelete()
    {
        Attribute::whereIn('id', $this->getSelected())->delete();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No attribute found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Attribute::find((int)$item['value'])->update(['position' => (int)$item['order']]);
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
            Column::make("Values", "values")
                ->format(
                    fn ($value, $row, Column $column) => view('website::admin.layouts.modules.attribute.values', ['attribute' => $row])
                )
                ->collapseOnTablet(),
            Column::make("Searchable", "is_searchable")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-' . ($row->getRawOriginal('is_searchable') ? "success" : "danger") . ' ">' . ($row->getRawOriginal('is_searchable') ? "Yes" : "No") . '</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Action")
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="attribute" :show="0" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
