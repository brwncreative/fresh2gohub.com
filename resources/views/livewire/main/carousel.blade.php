<div id="h-wrapper">
    <div id="h-mailing" class="center">
        <div>
            <h1>Join Our Mailing List</h1>
            <p>Join us on our journey! Get exclusive deals, news and more all at Fresh2Go!</p>
            <br>
            <form wire:submit='addToMailing'>
                <div id="m-controls">
                    <div id="email-input"><input wire:model="email" type="input" name="email"
                            placeholder="E-mail"></input></div>
                    @error('email')
                        <div class="center error">
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
    <div id="h-collection" class="center">
        <div>
            <h1>Welcome to Fresh2Go.com</h1>
            <p>your one stop shop all things fresh and ready to go!</p>
        </div>
    </div>
</div>
