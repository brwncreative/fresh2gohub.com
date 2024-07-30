<div id="d-menu-container">
    <div id="d-menu-wrapper">
        @foreach ($menu_items as $item)
            <div class='{{request()->is('dashboard/'.$item) ? 'd-active' : 'd-not-active'}} dm-item center'>
                <a href="{{route('dashboard-'.$item)}}"><p>{{ $item }}</p></a>
            </div>
        @endforeach
    </div>
</div>
