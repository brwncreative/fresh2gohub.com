<div class="bucket">
    <div class="items">
        @foreach ($items as $item)
            {{-- Menu Items (Item, Identifier) --}}
            <div class="item {{ str_contains(url()->current(), $item) ? 'active' : '' }}">
                <a href="{{ route('dashboard', ['purpose' => $item]) }}">
                    {{ $item }}
                </a>
            </div>
        @endforeach
    </div>
</div>
