<div id="explore">
    {{-- Canvas Confetti --}}
    <div id="confetti">
        <canvas id="confetti-canvas"></canvas>
    </div>
    {{-- Mailing --}}
    <div class="mailing">
        <div class="text">
            {{-- Title --}}
            <h3 class="bold">{{ $title }}</h3>
            <h5>benefits include:</h5>
            {{-- Benefits --}}
            <div id="benefits">
                @for ($x = 0; $x < sizeof($benefits); $x++)
                    <div class="benefit {{ $pointer == $x ? 'active' : '' }}">
                        <i class="bi {{ $benefits[$x]['icon'] }} h4"></i>
                        <div class="text">
                            <h6 class="bold">{{ $benefits[$x]['tagline'] }}</h4>
                                <p class="context">{{ $benefits[$x]['text'] }}</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        {{-- Inputs --}}
        <div class="inputs">
            <input type="email" placeholder="Keep in the loop!" name="email" wire:model="email" />
            <div class="input-btn" wire:click="handleInvitee">
                <i class="bi bi-envelope h3"></i>
            </div>
        </div>
        @error('email')
            <div class="error">
                <i class="bi bi-exclamation-circle"></i> {{ $message }}
            </div>
        @enderror
    </div>

    @script
        <script>
            setInterval(function() {
                $wire.call("switch");
            }, 5000);
        </script>
    @endscript
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    @script
        <script>
            $wire.on("confetti", () => {
                // Canvas
                canvas = document.querySelector("#confetti-canvas");
                // Confetti
                let play = confetti.create(canvas);
                play({
                    particleCount: 200,
                    spread: 500,
                    startVelocity: 15,
                    scalar: 0.6,
                    ticks: 120,
                });
            });
        </script>
    @endscript
</div>
