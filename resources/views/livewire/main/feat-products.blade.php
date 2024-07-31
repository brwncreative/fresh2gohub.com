<div>
    <div id="pcc-actions">
        <i class="bi bi-chevron-left pcc-left"></i>
        <div id="spacer"></div>
        <i class="bi bi-chevron-right pcc-right"></i>
    </div>
    <div id="ftp-container">
        <div id="ftp-wrapper">
            @foreach ($products as $product)
                <div class="ftp-card">
                    <div class="ftp-contents">
                        <div class="pc-logo"><img
                                src="{{ App\Http\Controllers\FileController::serveImageFile($product->name, 'webp') }}"
                                alt="Fresh2Go Product"></div>
                        <div class="card-text pc-tags middle">
                            @foreach ($product->tags as $tag)
                                <div class="pc-tag tag-{{ $tag }}">{{ $tag }}</div>
                            @endforeach
                        </div>
                        <div class="card-text pc-name">{{ $product->name }}</div>
                        <div class="card-text pc-options middle"><select name="options">
                                @foreach ($product->options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                                < </select>
                        </div>
                        <div class="pc-info middle">
                            <div class="card-text pc-price">${{ $product->price }}</div>
                            <div class="pc-actions"><i class="bi bi-plus-circle"></i></div>
                        </div>
                    </div>
                </div>
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
