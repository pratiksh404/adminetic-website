<?php

namespace Adminetic\Website\Http\Livewire\Admin\Project;

use Adminetic\Website\Models\Admin\Project;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProjectTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Project::query()
            ->with('category')->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
        'bulkMarkAsFinished' => 'Mark As Finished',
        'bulkMarkAsNotStarted' => 'Mark As Not Started',
        'bulkMarkAsOngoing' => 'Mark As Ongoing',
    ];

    public function bulkDelete()
    {
        Project::whereIn('id', $this->getSelected())->delete();
    }

    public function bulkMarkAsFinished()
    {
        Project::whereIn('id', $this->getSelected())->updated([
            'status' => 3
        ]);
    }

    public function bulkMarkAsNotStarted()
    {
        Project::whereIn('id', $this->getSelected())->updated([
            'status' => 2
        ]);
    }

    public function bulkMarkAsOngoing()
    {
        Project::whereIn('id', $this->getSelected())->updated([
            'status' => 1
        ]);
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
            SelectFilter::make('Featured')
                ->options([
                    '' => 'All',
                    '1' => 'Featured',
                    '0' => 'Not Featured',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('featured', true);
                    } elseif ($value === '0') {
                        $builder->where('featured', false);
                    }
                }),
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    '1' => 'Ongoing',
                    '2' => 'Not Started',
                    '3' => 'Finished',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('status', 1);
                    } elseif ($value === '2') {
                        $builder->where('status', 2);
                    } elseif ($value === '3') {
                        $builder->where('status', 3);
                    }
                }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No project found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Project::find((int)$item['value'])->update(['position' => (int)$item['order']]);
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
            Column::make("Featured", "featured")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-' . ($row->getRawOriginal('featured') ? "success" : "primary") . ' ">' . ($row->getRawOriginal('featured') ? "Featured" : "Not Featured") . '</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Status", "status")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-info">' . ($row->status) . '</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Icon", "icon")
                ->format(
                    fn ($value, $row, Column $column) => '<span class="' . $row->icon . ' "></span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Color", "color")
                ->format(
                    fn ($value, $row, Column $column) => '<span style="height:30px;width:50px;background-color:' . $row->color . '"></span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make("Action")
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="project" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
