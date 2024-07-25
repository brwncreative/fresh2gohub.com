<div id="m-layout">
    <div id="m-wrapper">
        @foreach ($menuItems as $item)
            <div class="m-item">
                <img src="https://brwncreative.github.io/fresh2gohub.com/images/{{ $item }}.svg" height="30px"
                    width="auto" fetchpriority="high" loading="eager" alt="{{ $item }}"></img>
                <p> {{ $item }} </p>
            </div>
        @endforeach
    </div>
</div>
