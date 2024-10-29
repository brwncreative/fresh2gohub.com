<div class="carousel">
    <div class="appeal">
        <div class="text">
            <h4 class="bold">Your news carousel</h4>
            <h5>{{date('m/d/Y', time())}}</h5>
        </div>
    </div>
    <div class="bucket">
        <div class="media">
            @for ($x = 0; $x < sizeof($media); $x++)
                <div
                    class="{{ $pointer == 0 ? ($x == sizeof($media) - 1 ? 'previous' : '') : '' }}{{ $pointer == sizeof($media) - 1 ? ($x == 0 ? 'incoming' : '') : '' }}{{ $x == $pointer + 1 ? 'incoming' : '' }}{{ $x == $pointer - 1 ? 'previous' : '' }} {{ $pointer == $x ? 'active' : '' }} slide slide-{{ $x }}">
                    <div>
                        {{-- <h2>{{ $x }}</h2> --}}
                    </div>
                </div>
            @endfor
        </div>
    </div>
    @script
        <script>
            setInterval(function() {
                $wire.call("queue", '+');
            }, 10000);
        </script>
    @endscript
</div>
