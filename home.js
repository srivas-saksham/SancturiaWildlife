// DOM Elements
const btnRs = document.querySelectorAll('.btn-warning');
const donationAmt = document.querySelector('#donationAmt');
const parkImgs = document.querySelectorAll('.sanctuary-image');

let sancName;
// Set placeholder on button click
btnRs.forEach(btn => {
    btn.addEventListener('click', (e) => {
        sancName = e.target.alt;
        localStorage.setItem('SanctuaryName', sancName);
        donationAmt.placeholder = btn.innerText;
    });
});

// Redirect on image click
parkImgs.forEach(img => {
    img.addEventListener('click', (e) => {
        sancName = e.target.alt;
        localStorage.setItem('SanctuaryName', sancName);
        window.location.href = './sancturies.html';
    });
});
