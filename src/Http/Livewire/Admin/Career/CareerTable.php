<?php

namespace Adminetic\Website\Http\Livewire\Admin\Career;

use Adminetic\Website\Models\Admin\Career;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CareerTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Career::query()->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function bulkDelete()
    {
        Career::whereIn('id', $this->getSelected())->delete();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No career found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Career::find((int) $item['value'])->update(['position' => (int) $item['order']]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Group', 'group')
                ->label(
                    fn ($row, Column $column) => $row->group ?? '-'
                )
                ->sortable()
                ->searchable(),
            Column::make('Designation', 'designation')
                ->sortable()
                ->searchable(),
            Column::make('Location', 'location')
                ->sortable()
                ->searchable(),
            Column::make('Salary', 'salary')
                ->label(
                    fn ($row, Column $column) => ! is_null($row->salary) ? (currency().$row->salary) : '-'
                )
                ->searchable(),
            Column::make('Deadline', 'deadline')
                ->label(
                    fn ($row, Column $column) => ! is_null($row->deadline) ? (Carbon::crate($row->deadline))->toFormattedDateString() : '-'
                )
                ->sortable()
                ->searchable(),
            Column::make('Excerpt', 'excerpt')
                ->sortable()
                ->searchable(),
            Column::make('Active', 'active')
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-'.($row->getRawOriginal('active') ? 'success' : 'danger').' ">'.($row->getRawOriginal('active') ? 'Active' : 'Inactive').'</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make('Apply Button', 'add_apply_button')
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-'.($row->getRawOriginal('add_apply_button') ? 'success' : 'danger').' ">'.($row->getRawOriginal('add_apply_button') ? 'Active' : 'Inactive').'</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="career"><x-slot name="buttons"><a href="{{ route("career.applications", ["career" => $model->id]) }}"class="btn btn-info btn-air-info p-2 btn-sm"><i class="fa fa-file"></i> <span class="mx-2 p-2"style="background-color: white;color:black">{{ $model->applications->count() }}</span></a></x-slot></x-adminetic-action>', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
