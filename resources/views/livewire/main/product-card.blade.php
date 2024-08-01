<div class="ftp-card">
    <div class="ftp-contents">
        <div class="pc-image center"><img src="{{ $url }}" alt="Fresh2Go Product"></img></div>
        <div class="card-text pc-tags middle">
            @foreach ($tags as $tag)
                <div class="pc-tag tag-{{ $tag }}">{{ $tag }}</div>
            @endforeach
        </div>
        <div class="card-text pc-name">{{ $name }}</div>
        <div class="card-text pc-options middle"><select name="options">
                @foreach ($options as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
                < </select>
        </div>
        <div class="pc-info middle">
            <div class="card-text pc-price middle">${{ $price }} <div class="spacer-smallest">
                </div>
                <p>{{ $metric }}</p>
            </div>
            <div class="pc-actions"><i class="bi bi-plus-circle"
                    wire:click.prevent="addToCart(@js($id))"></i></div>
        </div>
    </div>
</div>
