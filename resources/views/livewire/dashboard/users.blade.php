<main id="dashboard">
    <div id="users">
        <div id="user-container">
            @foreach ($users as $user)
                <div class="user">
                    <div class="pic"></div>
                    <div class="information">
                        <div class="name-role">
                            <p class="small-title">{{ $user->name }} </p>
                            <span class="role role-{{ $user->role }}"> {{ $user->role }}</span>
                            <span><i class="bi bi-envelope-check"></i></span>
                        </div>
                        <p class="paragraph">{{ $user->email }}</p>
                    </div>
                    <div class="actions">
                        <button><i class="bi bi-trash delete"></i></button>
                        <button><i class="bi bi-envelope mail"></i></button>
                        <button><i class="bi bi-check2-all"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="mail">
        {{-- Actions --}}
        <div class="input">
            <span>
                <p class="bold">New Message</p>
            </span>
            <span style="display: grid; grid-template: 1fr / 1fr 1fr">
                <div style='padding-inline-end: 1rem'>
                    <p>To:</p> <input wire:model.live='recipients' type="text" placeholder="Recipients">
                </div>
                {{json_encode($mlist)}}
            </span>
            <span>
                <div>
                    <p>Subject:</p><input wire:model='subject' type="text" placeholder="Subject">
                </div>
            </span>
            <div class="text-area">
                <textarea wire:model.live='message' placeholder="Message"></textarea>
            </div>
            {{$message}}
        </div>
        <div id="actions"> <button wire:click='sendMail'>Send</button></div>
    </div>
</main>
