// DOM
const btnRs1 = document.querySelector('#btnRs1');
const btnRs2 = document.querySelector('#btnRs2');
const btnRs3 = document.querySelector('#btnRs3');
const btnRs4 = document.querySelector('#btnRs4');
const donationAmt = document.querySelector('#donationAmt');

btnRs1.addEventListener('click', ()=>{
    donationAmt.placeholder = btnRs1.innerText;
})
btnRs2.addEventListener('click', ()=>{
    donationAmt.placeholder = btnRs2.innerText;
})
btnRs3.addEventListener('click', ()=>{
    donationAmt.placeholder = btnRs3.innerText;
})
btnRs4.addEventListener('click', ()=>{
    donationAmt.placeholder = btnRs4.innerText;
})