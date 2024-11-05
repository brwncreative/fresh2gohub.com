<div class="bucket">
    <p>Shop by: </p>
    <div class="filters">
        @foreach ($items as $item)
            <p class="tag-filter tag-{{ $item }}"><a
                    href="{{ route('results', ['find' => $item]) }}">{{ $item }}</a></p>
        @endforeach
    </div>
</div>
