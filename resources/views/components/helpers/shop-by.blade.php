<div class="bucket">
    <p>Shop by: </p>
    @foreach ($items as $item)
        <p class="tag-filter tag-{{ $item }}"><a
                href="{{ route('results', ['find' => $item]) }}">{{ $item }}</a></p>
    @endforeach
</div>
