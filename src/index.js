'use strict';
const arrowDown = () => {
    const arrowDownBtn = document.querySelector('.header-arrowDown');
    arrowDownBtn.addEventListener('click', () => {
        event.preventDefault();
        window.scrollTo({ top: screen.height-100, behavior: "smooth"});
    });
};
arrowDown();


