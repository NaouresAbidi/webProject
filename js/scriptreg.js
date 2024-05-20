const signUpBtnLink = document.querySelector('.sign-up-link');
const signInBtnLink = document.querySelector('.sign-in-link');
const wrapper = document.querySelector('.wrapper');

signUpBtnLink.addEventListener('click',() => {
    wrapper.classList.toggle('active');
});
signInBtnLink.addEventListener('click',() => {
    wrapper.classList.toggle('active');
});
function lines(){
    let sizeW = Math.random() *12;
    let duration = Math.random() *3;
    let e = document.createElement('div');
    e.setAttribute('class','circle');
    document.body.appendChild(e);
    e.style.width = 2+sizeW+'px';
    e.style.left = Math.random() * + innerWidth + 'px';
    e.style.animationDuration = 2 + duration+'s';
    setTimeout(function(){
    document.body.removeChild(e);
    },50000);
}

setInterval(function(){
    lines();
},200);

