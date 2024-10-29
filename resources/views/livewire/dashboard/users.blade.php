<main id="dashboard">
    <div class="greeting">
        <h2>Users</h2>
        <p class="paragraph">Manage and send mail to your users here</p>
        <hr>
    </div>
    <div id="users">
        <div id="user-container">
            @foreach ($users['chunk'] as $user)
                <div class="user">
                    <div class="pic"></div>
                    <div class="information">
                        {{-- Icons --}}
                        <div class="icons"></div>
                        <div class="name-role">
                            <span><i class="bi bi-envelope-check"
                                    style="color:{{ $user->mailing ? 'green' : 'red' }}"></i></span>
                            <span class="role role-{{ $user->role }}"> {{ $user->role }}</span>
                        </div>
                        {{-- Context --}}
                        <div class="context">
                            <p class="bold">{{ $user->name ? $user->name : 'NA' }} </p>
                            <p class="paragraph">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="actions">
                        <button><i class="bi bi-trash delete"></i></button>
                        <button wire:click="handleUser('mailBtn','{{ $user->email }}')"><i
                                class="bi bi-envelope mail"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="pagination-controls">
        <div id="pagination-controls">
            @for ($x = 0; $x < $users['size']; $x++)
                <p class="{{ $chunk == $x ? 'active' : '' }}" wire:click="prepUsers({{ $x }})">
                    {{ $x + 1 }}</p>
            @endfor
        </div>
    </div>
    <div id="mail">
        <h5 class="bold">New Message</h5>
        {{-- Sending --}}
        <div class="sending">
            <div class="recipients">
                @for ($x = 0; $x < sizeof($recipients); $x++)
                    @if (array_key_exists($x, $recipients))
                        <div class="recipient pill"><i class="bi bi-x del"
                                wire:click="handleUser('del','?',{{ $x }})"></i>
                            {{ $recipients[$x] }}
                        </div>
                    @endif
                @endfor
            </div>
            <div class="inputs">
                <input type="text" placeholder="To" wire:model='recipientString'
                    wire:keydown.space="handleUser('mailForm')">
                <input type="text" placeholder="Subject" wire:model='subject'>
                <textarea wire:model='message' placeholder="Message"></textarea>
            </div>
        </div>
        <div id="actions">
            <button wire:click='sendMail'>Send</button>
        </div>
    </div>
</main>
