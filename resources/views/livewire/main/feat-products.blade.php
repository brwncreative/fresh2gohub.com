<div>
    <div id="pcc-actions">
        <h3>See whats popular!</h3>
        <div class="spacer-small"></div>
        <i class="bi bi-chevron-left pcc-left"></i>
        <div class="spacer"></div>
        <i class="bi bi-chevron-right pcc-right"></i>
    </div>
    <div id="ftp-container">
        <div id="ftp-wrapper">
            @foreach ($products as $product)
            @livewire('main.product-card',['id'=>$product->id,'url'=>$product->url,'tags'=>$product->tags,'name'=>$product->name,'options'=>$product->options,'price'=>$product->price,'metric'=>$product->metric])
            @endforeach
        </div>
    </div>
    <script>
        // Monitor Buttons
        const left = document.querySelector(".pcc-left");
        const right = document.querySelector(".pcc-right");
        const products_container = document.querySelector("#ftp-container");
        const products_wrapper = document.querySelector("#ftp-wrapper");

        left.addEventListener("click", () => {
            smoothScroll('-')
        });
        right.addEventListener("click", () => {
            smoothScroll('+')
        });

        function smoothScroll(direction) {
            var count = 0
            var incr = 0
            var decr = 0

            var timer = setInterval(() => {
                if (direction == '+') {
                    if (count < 50) {
                        if (incr < 25) {
                            products_container.scrollLeft = products_container.scrollLeft + incr
                            incr++
                        } else {
                            products_container.scrollLeft = products_container.scrollLeft + (incr - decr)
                            decr++
                        }
                        count++
                    } else clearInterval(timer)
                }

                if (direction == '-') {
                    if (count < 50) {
                        if (incr > -25) {
                            products_container.scrollLeft = products_container.scrollLeft + incr
                            incr--
                        } else {
                            products_container.scrollLeft = products_container.scrollLeft + (incr + decr)
                            decr++
                        }
                        count++
                    } else clearInterval(timer)
                }
            }, 15);
        }
    </script>
</div>
