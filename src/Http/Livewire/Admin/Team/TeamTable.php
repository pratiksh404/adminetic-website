<?php

namespace Adminetic\Website\Http\Livewire\Admin\Team;

use Adminetic\Website\Models\Admin\Team;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TeamTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Team::query()->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function bulkDelete()
    {
        Team::whereIn('id', $this->getSelected())->delete();
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No team found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Team::find((int)$item['value'])->update(['position' => (int)$item['order']]);
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
            Column::make("Phone", "phone")
                ->sortable()
                ->searchable(),
            Column::make("Social Media", "social_medias")
                ->format(
                    fn ($value, $row, Column $column) => view('website::admin.layouts.modules.team.social_media', ['team' => $row])
                ),
            Column::make("Group", "group")
                ->sortable()
                ->searchable(),
            Column::make("Action")
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="team" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
