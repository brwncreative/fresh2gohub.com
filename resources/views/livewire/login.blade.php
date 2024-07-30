<div id="login-container" class="center">
    <div id="login-wrapper">
        <h1>Welcome Back</h1>
        <p> Let's get you something to eat!</p>
        <p class='{{$evp_status ? 'account-found' : 'account-nfound'}}'>{{$login_message}}</p>
        <br>
        <form wire:submit='login'>
            <div id="login-ui" class="center"><input wire:model.live.debounce.250ms="email" name="email" placeholder="E-mail"></input></div>
            @error('email')
                <div id="username-error" class="login-error">
                    <div id="ue-content">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            @enderror
            <br>
            <div id="login-pi" class="center"><input type="password" wire:model="password" name="password"
                    placeholder="Password"></input></div>
            @error('password')
                <div id="password-error" class="login-error">
                    <div id="pe-content">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            @enderror
            <br>
            <button type="submit" id="login-submit" class="center">Login</button>
        </form>
    </div>
</div>
