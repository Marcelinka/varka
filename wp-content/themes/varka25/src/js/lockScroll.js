// Заблокировать прокрутку страницы
const lockScroll = () => {
    if (!window.locked) {
    window.bodyScrollTop = (typeof window.pageYOffset !== 'undefined') ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
    document.getElementsByTagName('body')[0].classList.add('scroll-locked');
    document.getElementsByTagName('body')[0].style.top = `-${bodyScrollTop}px`;
    locked = true;
    };
}

// Включить прокрутку страницы
const unlockScroll = () => {
    if (window.locked) {
    document.getElementsByTagName('body')[0].classList.remove('scroll-locked');
    document.getElementsByTagName('body')[0].style.top = null;
    window.scrollTo(0, window.bodyScrollTop);
    locked = false;
    }
}

export {
    lockScroll,
    unlockScroll
}