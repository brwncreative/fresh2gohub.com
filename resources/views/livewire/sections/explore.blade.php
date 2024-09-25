<div id="explore">
    {{-- Mailing List CTA --}}
    <div id="mailing-cta">
        {{-- <div id="confetti">
            <canvas id="confetti-canvas"></canvas>
        </div> --}}
        <p class="title">{{ $title }}</p>
        <p clas="paragraph">Updates, deals, news?! Keep in the know about all things fresh2go-hub!</p>
        <div id="mcta-inputs">
            <input type="email" placeholder="Join us!" name="email" wire:model='email'>
            <div class="input-btn" wire:click='handleInvitee'><i class="bi bi-envelope h3"></i></div>
        </div>
        @error('email')
            <div class="error">
                <i class="bi bi-exclamation-circle"></i> {{ $message }}
            </div>
        @enderror
    </div>
    {{-- Feature products --}}
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
                    <livewire:products.product-card :key="$product->id" :id="$product->id" :tags="$product->tags"
                        :provider="$product->provider" :name="$product->name" :description="$product->description" :options="$product->options" :prices="$product->prices"
                        :available="$product->available" :category="$product->category"></livewire:products.product-card>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
@script
    <script>
        $wire.on('confetti', () => {
            // Canvas
            canvas = document.querySelector("#confetti-canvas");
            // Confetti
            let play = confetti.create(canvas);
            play({
                particleCount: 200,
                spread: 500,
                startVelocity: 15,
                scalar: .6,
                ticks: 120,
            });
        });
    </script>
@endscript
