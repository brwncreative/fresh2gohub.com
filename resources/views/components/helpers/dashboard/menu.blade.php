<div class="bucket">
    <div class="items">
        @foreach ($items as $item)
            {{-- Menu Items (Item, Identifier) --}}
            <div class="item">
                <a href="{{ route('dashboard', ['purpose' => $item]) }}">
                    <p>{{ $item }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
