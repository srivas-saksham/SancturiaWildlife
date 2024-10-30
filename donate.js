// DOM
const tCard1 = document.querySelector('.tier-card1');
const tCard2 = document.querySelector('.tier-card2');
const tCard3 = document.querySelector('.tier-card3');
const tVid1 = document.querySelector('#tier-vid1');
const tVid2 = document.querySelector('#tier-vid2');
const tVid3 = document.querySelector('#tier-vid3');
const donateBtn = document.querySelector('.donate-button');
const donationPlaceholder = document.querySelector('#donationAmount');

let donationValue = localStorage.getItem('DonationPreset');
if(donationValue != ''){
    donationPlaceholder.placeholder = donationValue;
}

tCard1.addEventListener('mouseover', ()=>{
    tVid1.loop = true;
    tVid1.play()
    tVid1.style.scale = '120%';
})
tCard2.addEventListener('mouseover', ()=>{
    tVid2.loop = true;
    tVid2.play()
    tVid2.style.scale = '120%';
})
tCard3.addEventListener('mouseover', ()=>{
    tVid3.loop = true;
    tVid3.play()
    tVid3.style.scale = '120%';
})

tCard1.addEventListener('mouseout', ()=>{
    tVid1.pause()
    tVid1.style.scale = '100%';
})
tCard2.addEventListener('mouseout', ()=>{
    tVid2.pause()
    tVid2.style.scale = '100%';
})
tCard3.addEventListener('mouseout', ()=>{
    tVid3.pause()
    tVid3.style.scale = '100%';
})

donateBtn.addEventListener('click', ()=>{
    tierIconMove()
})
function tierIconMove(){
    tVid1.loop = false;
    tVid2.loop = false;
    tVid3.loop = false;
    tVid1.currentTime = 0;
    tVid2.currentTime = 0;
    tVid3.currentTime = 0;
    tVid1.play()
    tVid2.play()
    tVid3.play()
    tVid1.style.scale = '130%';
    tVid2.style.scale = '130%';
    tVid3.style.scale = '130%';
    
    setTimeout(() => {
    tVid1.style.scale = '100%';
    tVid2.style.scale = '100%';
    tVid3.style.scale = '100%';
    }, 2000);
}