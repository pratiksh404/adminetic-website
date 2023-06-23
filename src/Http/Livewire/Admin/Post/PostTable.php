<?php

namespace Adminetic\Website\Http\Livewire\Admin\Post;

use Adminetic\Website\Models\Admin\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PostTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Post::query()
            ->with('category')->orderBy('position'); // Eager load anything; // Select some things
    }

    public function bulkActions(): array
    {
        return [
            'bulkDelete' => 'Bulk Delete',
            'bulkChangeStatusToNotApproved' => 'Mark as not approved',
            'bulkChangeStatusToPublish' => 'Mark as published',
            'bulkChangeStatusToPending' => 'Mark as pending',
            'bulkChangeStatusToDraft' => 'Mark as draft',
        ];
    }

    public function bulkDelete()
    {
        Post::whereIn('id', $this->getSelected())->delete();
    }

    public function bulkChangeStatusToNotApproved()
    {
        Post::whereIn('id', $this->getSelected())->update([
            'status' => 0,
            'approved_by' => Auth::user()->id,
        ]);
    }

    public function bulkChangeStatusToPublish()
    {
        Post::whereIn('id', $this->getSelected())->update([
            'status' => 1,
            'approved_by' => Auth::user()->id,
        ]);
    }

    public function bulkChangeStatusToPending()
    {
        Post::whereIn('id', $this->getSelected())->update([
            'status' => 2,
            'approved_by' => Auth::user()->id,
        ]);
    }

    public function bulkChangeStatusToDraft()
    {
        Post::whereIn('id', $this->getSelected())->update([
            'status' => 3,
            'approved_by' => Auth::user()->id,
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
                    '0' => 'Not Approved',
                    '1' => 'Published',
                    '2' => 'Pending',
                    '3' => 'Draft',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '0') {
                        $builder->where('status', 0);
                    } elseif ($value === '1') {
                        $builder->where('status', 1);
                    } elseif ($value === '2') {
                        $builder->where('status', 2);
                    } elseif ($value === '3') {
                        $builder->where('status', 3);
                    }
                }),
            SelectFilter::make('Author')
                ->options(array_merge([
                    '' => 'All',
                ], User::find(array_unique(Post::pluck('id')->toArray()))->mapWithKeys(function ($user) {
                    return [$user->id => $user->name];
                })->toArray()))
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('user_id', (int) $value);
                }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEagerLoadAllRelationsEnabled();

        $this->setEmptyMessage('No post found');

        $this->setReorderStatus(true);

        $this->setBulkActionsStatus(true);

        $this->setBulkActions([
            'exportSelected' => 'Export',
        ]);

        $this->setDefaultReorderSort('position', 'asc');
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Post::find((int) $item['value'])->update(['position' => (int) $item['order']]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Category', 'category_id')
                ->format(
                    fn ($value, $row, Column $column) => $row->category->name ?? '-'
                )
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Active', 'active')
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-'.($row->getRawOriginal('active') ? 'success' : 'danger').' ">'.($row->getRawOriginal('active') ? 'Active' : 'Inactive').'</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make('Featured', 'featured')
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-'.($row->getRawOriginal('featured') ? 'success' : 'primary').' ">'.($row->getRawOriginal('featured') ? 'Featured' : 'Not Featured').'</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make('Status', 'status')
                ->format(
                    fn ($value, $row, Column $column) => '<span class="badge badge-'.$row->getStatusColor().' ">'.$row->status.'</span>'
                )
                ->html()
                ->collapseOnTablet(),
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => Blade::render('<x-adminetic-action :model="$model" route="post" />', ['model' => $row])
                )
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
