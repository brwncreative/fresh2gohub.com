<div class="bucket">
    <div class="items">
        @foreach ($items as $item)
            {{-- Menu Items (Item, Identifier) --}}
            <div class="item">
                <a href="">
                    <img src="{{ App\Http\Controllers\MediaController::serveImage($item, 'svg') }}" height="20px"
                        width="auto" fetchpriority="high" loading="eager" alt="Fresh2Go Logo"></img>
                    <p>{{ $item }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
