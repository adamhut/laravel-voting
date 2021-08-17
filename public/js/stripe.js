const menuItems = document.querySelectorAll('nav ul li');
const menuBackground = document.querySelector('.menu-background');
const arrow = document.querySelector('.arrow')
const nav = document.querySelector('nav ul');

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

    const menuCoords = menu.getBoundingClientRect();
    const navCoords = nav.getBoundingClientRect()

    // console.log(menuCoords);
    menuBackground.classList.add('open');
    arrow.classList.add('open')
    // menuBackground.style.setProperty('width', `${menuCoords.width}px`);
    // menuBackground.style.setProperty('height', `${menuCoords.height}px`);
    // menuBackground.style.setProperty('top', `${menuCoords.top + window.scrollY}px`);
    // menuBackground.style.setProperty('left', `${menuCoords.left}px`);
    // translate(${menuCoords.left + (menuCoords.width / 2) - 7}px, ${menuCoords.top - navCoords.top}px)
    arrow.style.setProperty('transform',
        `
        translate(${menuCoords.left + (menuCoords.width / 2) - 7}px, ${menuCoords.top }px)
        rotate(45deg) translateY(-50%)
        `);
    menuBackground.style.setProperty('transform',
        `
        translate(${menuCoords.left}px,${menuCoords.top + window.scrollY}px)
        scaleX(${ menuCoords.width / 100 })
        scaleY(${ menuCoords.height / 100 })
        `);

    console.log(arrow);
}

function handleLeave(item) {
    const menu = this.querySelector('.menu');

    menu.classList.remove('menu-enter-active', 'menu-enter');

    menuBackground.classList.remove('open');

    arrow.classList.remove('open');
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