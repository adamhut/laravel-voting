const menuItems = document.querySelectorAll('nav ul li');

menuItems.forEach(menuItem => {
    menuItem.addEventListener('mouseover', handleEnter)
    menuItem.addEventListener('mouseleave', handleLeave)
})


function handleEnter() {
    // console.log(this);
    const menu = this.querySelector('.menu');
    menu.classList.add('menu-enter');

    setTimeout( () => {
        menu.classList.add('menu-enter-active');
    },50);
}

function handleLeave(item) {
    const menu = this.querySelector('.menu');

    menu.classList.remove('menu-enter-active', 'menu-enter');

    menu.classList.add('menu-leave');
    setTimeout(() => {
        menu.classList.add('menu-leave-active');
    }, 50);

    setTimeout(() => {
        // menu.classList.remove('menu-leave-active','menu-leave');
        menu.classList.remove('menu-enter', 'menu-enter-active');
    }, 200);

}