<div id=tags>
    @foreach ($tags as $tag)
        <div class="nav-tag tag-{{$tag}}">
            <p> {{$tag}} </p>
        </div>
    @endforeach
</div>
