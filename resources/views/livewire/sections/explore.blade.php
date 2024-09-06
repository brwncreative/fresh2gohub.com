<div id="explore">
    <div id="mailing-cta">
        <p class="title">{{ $title }}</p>
        <p clas="paragraph">Updates, deals, news?! Keep in the know about all things fresh2go-hub!</p>
        <div>
            <input type="email" placeholder="Join us!" name="email" wire:model='email'>
            <div class="input-btn" wire:click='handleInvitee'><i class="bi bi-envelope h3"></i></div>
        </div>
        @error('email')
            {{ $message }}
        @enderror
    </div>
    <div id="featured-products">
        <div>
            <hgroup>
                <p class="small-title">Check out whats popular!</p>
                <a href="{{ route('results', ['find' => "$find"]) }}"> See more </a>
            </hgroup>
        </div>
        <div class="products">
            <div class="bucket">
                @foreach ($products as $product)
                    <livewire:products.product-card :key="$product->id" :id="$product->id"  :tags="$product->tags" :provider="$product->provider"
                        :name="$product->name" :description="$product->description" :options="$product->options"
                        :prices="$product->prices"></livewire:products.product-card>
                @endforeach
            </div>
        </div>
    </div>
</div>
