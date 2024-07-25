<div id="m-layout">
    <div id="m-wrapper">
        @foreach ($menuItems as $item)
            <div class="m-item"><i class="bi bi-people h3"></i>
                {{ $item }}
            </div>
        @endforeach
    </div>
</div>
