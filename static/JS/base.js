
// js for login modal

var loginModalBtn = document.getElementById('nav-login-btn');
var loginModal = document.getElementById('login-modal');
loginModalBtn.addEventListener('click', ()=>{
    loginModal.style.display = 'block';
})
var closeLoginModalBtn = document.getElementById('close-login-modal');
closeLoginModalBtn.addEventListener('click', ()=>{
    loginModal.style.display = 'none';
})
