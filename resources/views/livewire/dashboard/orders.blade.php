<main id="dashboard">
    <div id="orders-bucket">
        @if (count($orders) > 0)
        <div id="order-container">
            @foreach ($orders as $order)
                <livewire:dashboard.helpers.order-card :key="$order->id"
                    :order="$order"></livewire:dashboard.helpers.order-card>
            @endforeach
        </div>
        @else
        <p class="medium-title">No orders just yet</p>
        @endif
    </div>
</main>
