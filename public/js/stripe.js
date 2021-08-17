const menuItems = document.querySelectorAll('nav ul li');
const menuBackground = document.querySelector('.menu-background');

menuItems.forEach(menuItem => {
    menuItem.addEventListener('mouseover', handleEnter)
    menuItem.addEventListener('mouseleave', handleLeave)
});

function handleEnter() {
    // console.log(this);
    const menu = this.querySelector('.menu');
    menu.classList.add('menu-enter');

    setTimeout( () => {
        menu.classList.add('menu-enter-active');
    }, 50);

    // menuBackground.classList.add('next');

    const menuCoords = menu.getBoundingClientRect()
    // console.log(menuCoords);
    menuBackground.classList.add('open');
    menuBackground.style.setProperty('width', `${menuCoords.width}px`);
    menuBackground.style.setProperty('height', `${menuCoords.height}px`);
    menuBackground.style.setProperty('top', `${menuCoords.top + window.scrollY}px`);
    menuBackground.style.setProperty('left', `${menuCoords.left}px`);
    // console.log(menuCoords);
}

function handleLeave(item) {
    const menu = this.querySelector('.menu');

    menu.classList.remove('menu-enter-active', 'menu-enter');

    menuBackground.classList.remove('open');

    menu.classList.add('menu-leave');
    setTimeout(() => {
        menu.classList.add('menu-leave-active');
    }, 50);

    setTimeout(() => {
        menu.classList.remove('menu-leave-active', 'menu-leave');
        // menuBackground.classList.remove('open');
        // menu.classList.remove('menu-enter', 'menu-enter-active');
    }, 200);

}