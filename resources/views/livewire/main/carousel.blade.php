<div id="h-wrapper">
    <div id="h-mailing" class="center">
        <div>
            <h1>{{$title}}</h1>
            <br id="m-spacer">
            <p>Keep in the know about all things Fresh2Go!</p>
            <br>
            <form wire:submit='addToMailing'>
                <div id="m-controls">
                    <div id="email-input"><input wire:model="email" type="input" name="email"
                            placeholder="E-mail"></input></div>
                    @error('email')
                        <div id="m-emailError" class="center error">
                            <div id="ee-content">
                                <p>{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                    <button type="submit" id="m-btn" id="m-btn" class="center">Join Us!</button>
                </div>
            </form>
        </div>
    </div>
    <div id="h-products">@livewire('main.feat-products')</div>
    <div>
        
    </div>
</div>
