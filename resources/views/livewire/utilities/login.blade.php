<div class="bucket">
    <p class="title">Login</p>
    <p>Welcome back!</p>
    <a class="back" href="{{ route('welcome') }}"><i class="bi bi-arrow-90deg-left h3"></i></a>
    <form wire:submit='login'>
        <input placeholder="E-mail" type="text" name="email" wire:model='email'>
        @error('email')
            {{ $message }}
        @enderror
        <input placeholder="Password" type="password" name="password" wire:model='password'>
        @error('password')
            {{ $message }}
        @enderror
        <button class="bold">Login</button>
    </form>
</div>
