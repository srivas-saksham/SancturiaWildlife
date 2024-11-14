// DOM Elements
const btnRs = document.querySelectorAll('.btnRs');
const donationAmt = document.querySelector('#donationAmt');
const donateNow = document.querySelector('.donateNow');
const parkBtns = document.querySelectorAll('.parkBtn');
const parkImgs = document.querySelectorAll('.sanctuary-image');

localStorage.clear()
let sancName;
let donationPreset;
// Set placeholder on button click
btnRs.forEach(btn => {
    btn.addEventListener('click', (e) => {
        donationPreset = e.target.innerText;
        localStorage.setItem('DonationPreset', donationPreset);
        donationAmt.placeholder = btn.innerText;
    });
});

donateNow.addEventListener('click', ()=> {
    if(donationAmt.value != ''){
        donationPreset = donationAmt.value;
        localStorage.setItem('DonationPreset', donationPreset);
    }
})

donationAmt.addEventListener('keyup', (e)=>{
    if(e.key == 'Enter'){
        console.log('hi');
        donateNow.click()
    }
})

// Redirect to sancturies on click
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
