<main id="dashboard">
    <div id="products">
        @foreach ($products as $product)
            <livewire:dashboard.helpers.product-card :key="$product->id" :product="$product"
                @saved="update"></livewire:dashboard.helpers.product-card>
        @endforeach
    </div>
    <div id="form"><button id="add-btn"><i class="bi bi-plus-lg"></i></button></div>
</main>
