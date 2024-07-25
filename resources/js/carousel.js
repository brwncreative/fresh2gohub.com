// Error visual handling
const subscribe = document.querySelector("#m-btn");
subscribe.addEventListener("click", () => {
    setTimeout(() => {
        var e = document.querySelector("#m-emailError");
        e.classList.add("fade");
    }, 2000);
});
// Mailing list success visual handling
import { create } from "canvas-confetti";
const formControls = document.querySelector("#h-mailing");
if (window.location.href.indexOf('/welcome') > -1) {
    //Disable form
    // formControls.style.pointerEvents = "none";
    // Create canvas
    let canvas = document.createElement("canvas");
    canvas.width = 450;
    canvas.height = 400;
    formControls.appendChild(canvas);
    let play = create(canvas);
    play({
        particleCount: 200,
        spread: 500,
        startVelocity: 25,
        scalar: 1,
        ticks: 120,
    }).then(() => formControls.removeChild(canvas));
}