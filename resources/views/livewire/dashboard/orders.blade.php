<div id="dashboard">
    <div id="greeting">
        <div class="text">
            <h2 class="bold">Orders</h2>
            <p>Manage your orders here</p>
        </div>
        <div id="filters">
            <i class="bi bi-funnel h4" wire:click="$toggle('filtering')"></i>
            <select id="filter-status" wire:model='filterStatus'>
                <option value="?"> Status</option>
                <option value=1> paid</option>
                <option value=0> unpaid</option>
            </select>
            <select id="filter-stage" wire:model='filterStage'>
                <option value="?"> Stage</option>
                @foreach ($stages as $stage)
                    <option value="{{ $stage }}">{{ $stage }}</option>
                @endforeach
            </select>
        </div>
        <hr>
    </div>
    <div id="orders-bucket">
        @if ($orders['size'] > 0)
            <div id="order-container">
                @foreach ($orders['chunk'] as $order)
                    <livewire:dashboard.helpers.order-card :key="$order->id"
                        :order="$order"></livewire:dashboard.helpers.order-card>
                @endforeach
            </div>
        @else
            <h4>No orders just yet</h4>
            <p>When someone places an order you will see it reflected here</p>
        @endif
    </div>
</div>
