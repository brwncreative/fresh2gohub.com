<div class="product-card">
    <div class="image" wire:click='callPage'><img src="" alt="">
        <div></div>
    </div>
    <div class="tags">tags</div>
    <div class="identifiers" wire:click='callPage'>Provider : <span class="small-title">Name</span></div>
    <div class="description paragraph">Paragraph</div>
    <div class="options">
        <select name="options">
            <option value="">dsada</option>
        </select>
    </div>
    <div class="main-actions">
        <div class="prices">
            <select name="prices">
                <option value="">9.99</option>
            </select>
        </div>
        <div class="btns">
            <i class="bi bi-dash-circle minus h4"></i>
            <p>
                {{ $quantity }}
            </p>
            <i class="bi bi-plus-circle add h4"></i>
        </div>
    </div>
</div>
