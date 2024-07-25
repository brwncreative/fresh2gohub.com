import './bootstrap';
import './carousel';

// TOGGLE HIDE NAV ---
const navMenu = document.querySelector('#menu')
const navFilters = document.querySelector('#filters')
const navPanel = document.querySelector('#panel')

window.addEventListener("scroll", () => {
    // scroll Y axis no
    const scrolled = window.scrollY;
    if (scrolled > 15) {
        navMenu.classList.add('hideNav')
        navFilters.classList.add('noDisplay')
        navPanel.classList.add('shrink')
    } else {
        navMenu.classList.remove('hideNav')
        navFilters.classList.remove('noDisplay')
        navPanel.classList.remove('shrink')
    }
});
