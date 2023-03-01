import swipeDetect from "./libs/swipe";

window.addEventListener("load", function (event) {
    const MENU_OPEN_CLASS = "mobile-nav-opened";
    let toggle = document.querySelector(".js-nav-top__toggle");
    let menuContainer = document.querySelector(".js-nav-top");
    toggle.addEventListener("click", toggleHandler);
    swipeDetect(menuContainer, function (event, swipeDirection) {
        if (swipeDirection === 'right') {
            closeMenu();
        }
    });

    function toggleHandler(event) {
        if (isMenuOpen()) {
            closeMenu();
            return true;
        }
        openMenu();
    }

    function isMenuOpen() {
        return document.body.classList.contains(MENU_OPEN_CLASS);
    }

    function openMenu() {
        document.body.classList.add(MENU_OPEN_CLASS);
    }

    function closeMenu() {
        document.body.classList.remove(MENU_OPEN_CLASS);
    }
});
