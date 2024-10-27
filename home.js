// DOM Elements
const btnRs = document.querySelectorAll('.btn-warning');
const donationAmt = document.querySelector('#donationAmt');
const parkBtns = document.querySelectorAll('.parkBtn');
const parkImgs = document.querySelectorAll('.sanctuary-image');

localStorage.clear()
let sancName;
// Set placeholder on button click
btnRs.forEach(btn => {
    btn.addEventListener('click', (e) => {
        sancName = e.target.alt;
        donationAmt.placeholder = btn.innerText;
    });
});

// Redirect on click
parkBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        sancName = e.target.name;
        localStorage.setItem('SanctuaryName', sancName);
        window.location.href = './sancturies.html';
    });
});

parkImgs.forEach(img => {
    img.addEventListener('click', (e) => {
        sancName = e.target.alt;
        localStorage.setItem('SanctuaryName', sancName);
        window.location.href = './sancturies.html';
    });
});
