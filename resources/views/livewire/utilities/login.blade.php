<div id="login-container">
    @if ($type == 'text')
        <style>
            #login-container {
                .bucket {
                    right: -5% !important;
                }
            }
        </style>
    @endif

    {{-- Clickable Item --}}
    @switch($how)
        @case('icon')
            <div class="icon" wire:click="$toggle('state')"><i class="bi bi-person h4"></i></div>
        @break

        @case('text')
            <a class="click-text" wire:click="$toggle('state')">Login</a>
        @break
    @endswitch

    {{-- Form --}}
    <div class="bucket {{ $state ? 'active' : 'in-active' }}">
        <i class="bi bi-caret-up-fill tail"></i>
        <div class="intro">
            <p class="bolder">Login</p>
            <p class="paragraph">Welcome back!</p>
            <hr>
        </div>
        <form wire:submit='login'>
            <div class="input"> <input placeholder="E-mail" type="text" name="email" wire:model='email'>
                @error('email')
                    <div class="error"> {{ $message }}</div>
                @enderror
            </div>
            <div class="input"> <input placeholder="Password" type="password" name="password" wire:model='password'>
                @error('password')
                    <div class='error'> {{ $message }}</div>
                @enderror
            </div>

            <button class="bold">Login</button>
        </form>
    </div>
</div>
