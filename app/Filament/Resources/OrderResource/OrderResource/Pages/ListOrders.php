<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('panel.all')),
            'new' => Tab::make(__('panel.new'))->query(fn($query) => $query->where('status', 'new')),
            'processing' => Tab::make(__('panel.processing'))->query(fn($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make(__('panel.shipped'))->query(fn($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make(__('panel.delivered'))->query(fn($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make(__('panel.cancelled'))->query(fn($query) => $query->where('status', 'cancelled')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderResource\Widgets\OrderStats::class,
        ];
    }
}
