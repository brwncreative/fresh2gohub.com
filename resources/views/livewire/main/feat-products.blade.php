<div id="ftp-container">
    <div id="ftp-wrapper">
        @foreach ($products as $product)
            <div class="ftp-card">
                <div class="ftp-contents">
                    <div class="pc-logo">dsa</div>
                    <div class="card-text pc-tags">{{ $product->tags }}</div>
                    <div class="card-text pc-name">{{ $product->name }}</div>
                    <div class="card-text pc-options">{{ $product->options }}</div>
                    <div class="card-text pc-price">{{ $product->price }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
