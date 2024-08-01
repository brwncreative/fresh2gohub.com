<div id="m-layout">
    <div id="m-wrapper">
        @foreach ($menuItems as $item)
            <div class="m-item">
                <img src="{{App\Http\Controllers\FileController::serveImageFile($item,'svg')}}" height="25px"
                    width="auto" fetchpriority="high" loading="eager" alt="{{ $item }}"></img>
                <p> {{ $item }} </p>
            </div>
        @endforeach
    </div>
</div>
