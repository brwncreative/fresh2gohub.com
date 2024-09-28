<div id="login-container">
    @if ($type = 'text')
        <style>
            #login-container {
                .bucket {
                    right: -5% !important;
                }
            }
        </style>
    @endif
    @switch($how)
        @case('icon')
            <div id="icon" wire:click="$toggle('state')"><i class="bi bi-person h3"></i></div>
        @break
        @case('text')
            <a wire:click="$toggle('state')">Login</a>
        @break
    @endswitch


    <div class="bucket {{ $state ? 'active' : 'in-active' }}">
        <i class="bi bi-caret-up-fill tail"></i>
        <div class="intro">
            <p class="small-title bold">Login</p>
            <p>Welcome back!</p>
            <hr>
        </div>
        <form wire:submit='login'>
            <div class="errors">
                @error('email')
                    <div class="error"> {{ $message }}</div>
                @enderror
                @error('password')
                    <div class='error'> {{ $message }}</div>
                @enderror
            </div>
            <input placeholder="E-mail" type="text" name="email" wire:model='email'>
            <input placeholder="Password" type="password" name="password" wire:model='password'>
            <button class="bold">Login</button>
        </form>
    </div>
</div>
