<?php

namespace Adminetic\Website\Http\Livewire\Admin\Faq;

use Adminetic\Website\Models\Admin\Faq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FaqTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Faq::query()
            ->orderBy('position'); // Eager load anything; // Select some things
    }

    public array $bulkActions = [
        'bulkDelete' => 'Bulk Delete',
    ];

    public function bulkDelete()
    {
        Faq::whereIn('id', $this->getSelected())->delete();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No faq found');

        $this->setReorderStatus(true);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Faq::find((int) $item['value'])->update(['position' => (int) $item['order']]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Question', 'question')
                ->format(
                    fn ($value, $row, Column $column) => $row->question
                )
                ->html(),
            Column::make('Answer', 'answer')
                ->format(
                    fn ($value, $row, Column $column) => $row->question
                )
                ->html()->collapseOnTablet(),
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="faq" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
