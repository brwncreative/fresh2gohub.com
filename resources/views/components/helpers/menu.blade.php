<div class="bucket">
    <div class="items center">
        <div class="item {{ Request::get('find') == 'Events' ? 'active' : '' }}">
            <a href="{{ route('results', ['find' => 'Events']) }}">
                <img src="{{ App\Http\Controllers\MediaController::serveImage('vegetables', 'svg') }}" height="20px"
                    width="auto" fetchpriority="high" loading="eager" alt="Fresh2Go Logo"></img>
                <p>Events</p>
            </a>

        </div>
        <div class="item {{ Request::get('find') == 'Salts' ? 'active' : '' }}">
            <a href="{{ route('results', ['find' => 'Salts']) }}">
                <img src="{{ App\Http\Controllers\MediaController::serveImage('vegetables', 'svg') }}" height="20px"
                    width="auto" fetchpriority="high" loading="eager" alt="Fresh2Go Logo"></img>
                <p>Salts</p>
            </a>

        </div>
        @foreach ($items as $item)
            {{-- Menu Items (Item, Identifier) --}}
            <div class="item {{ Request::get('find') == $item ? 'active' : '' }}">
                <a href="{{ route('results', ['find' => $item]) }}">
                    <img src="{{ App\Http\Controllers\MediaController::serveImage($item, 'svg') }}" height="20px"
                        width="auto" fetchpriority="high" loading="eager" alt="Fresh2Go Logo"></img>
                    <p>{{ $item }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
