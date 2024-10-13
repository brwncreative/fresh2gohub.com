<div id="explore">
    {{-- Mailing List CTA --}}
    <div id="mailing-cta">
        <div id="confetti">
            <canvas id="confetti-canvas"></canvas>
        </div>
        <div class="text">
            <h3 class="bold">{{ $title }}</h3>
            <p class="paragraph">Updates, deals, news?! Keep in the know about all things fresh2gohub!</p>
        </div>
        <div id="mcta-inputs">
            <input type="email" placeholder="Join us!" name="email" wire:model='email'>
            <div class="input-btn" wire:click='handleInvitee'><i class="bi bi-envelope h3"></i></div>
        </div>
        @error('email')
            <div class="error">
                <i class="bi bi-exclamation-circle"></i> {{ $message }}
            </div>
        @enderror
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
@script
    <script>
        $wire.on('confetti', () => {
            // Canvas
            canvas = document.querySelector("#confetti-canvas");
            // Confetti
            let play = confetti.create(canvas);
            play({
                particleCount: 200,
                spread: 500,
                startVelocity: 15,
                scalar: .6,
                ticks: 120,
            });
        });
    </script>
@endscript
