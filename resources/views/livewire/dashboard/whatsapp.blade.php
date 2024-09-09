<main>
    <button wire:click='getQr'>button</button>
    <canvas id="qr-code"></canvas>
    {{ $qr }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode/1.5.0/qrcode.min.js"></script>
    @script
        <script>
            console.log($wire.qr)
            const canvas = document.querySelector('#qr-code');
            QRCode.toCanvas(canvas, $wire.qr, function(error) {
                if (error) {
                    console.log('error')
                }
            })
        </script>
    @endscript
</main>
