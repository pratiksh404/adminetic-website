<?php

namespace Adminetic\Website\Http\Livewire\Admin\Payment;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Adminetic\Website\Models\Admin\Payment;

class PaymentTable extends DataTableComponent
{
    protected $model = Payment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Particular", "particular")
                ->sortable(),
            Column::make("Amount", "amount")
                ->sortable(),
            Column::make("Type", "type")
                ->sortable(),
            Column::make("Paymentable type", "paymentable_type")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
