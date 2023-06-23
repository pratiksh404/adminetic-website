<?php

namespace Adminetic\Website\Http\Livewire\Admin\Testimonial;

use Adminetic\Website\Models\Admin\Testimonial;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TestimonialTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Testimonial::query()->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
        'bulkApprove' => 'Mark As Approved',
        'bulkNotApprove' => 'Mark As Not Approved',
    ];

    public function bulkDelete()
    {
        Testimonial::whereIn('id', $this->getSelected())->delete();
    }

    public function bulkApprove()
    {
        Testimonial::whereIn('id', $this->getSelected())->update([
            'approved' => 1
        ]);
    }

    public function bulkNotApprove()
    {
        Testimonial::whereIn('id', $this->getSelected())->update([
            'approved' => 0
        ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Approved')
                ->options([
                    '' => 'All',
                    '1' => 'Approved',
                    '0' => 'Not Approved',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('approved', true);
                    } elseif ($value === '0') {
                        $builder->where('approved', false);
                    }
                }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No testimonial found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Testimonial::find((int)$item['value'])->update(['position' => (int)$item['order']]);
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
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Company", "company")
                ->sortable()
                ->searchable(),
            Column::make("Designation", "designation")
                ->sortable()
                ->searchable(),
            Column::make("Message", "message")
                ->format(
                    fn ($value, $row, Column $column) => $row->message
                )
                ->html()
                ->sortable()
                ->searchable(),
            Column::make("Rating", "rating")
                ->sortable()
                ->searchable(),
            Column::make("Approved", "approved")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-' . ($row->getRawOriginal('approved') ? "success" : "danger") . ' ">' . ($row->getRawOriginal('approved') ? "Approved" : "Not Approved") . '</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Action")
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="testimonial" :show="0" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
