
class Sanctuary {
    constructor(id, name, location, description, img, website) {
        this.id = id;
        this.name = name;
        this.location = location;
        this.description = description;
        this.img = img;
        this.website = website;
    }

    getInfo() {
        return `${this.id}, ${this.name}, ${this.location}, ${this.description}, ${this.img}, ${this.website}`; //returns a string
    }
}

const sanctuaries = [
    new Sanctuary(1, 'Ranthambore National Park', 'Rajasthan', 'Famous for Bengal tigers and diverse wildlife. Do Visit Once', './Assets_TBU/Animal Images/img1.jpg', 'https://www.ranthamborenationalpark.com/'),
    new Sanctuary(2, 'Kaziranga National Park', 'Assam', 'Home to the Indian one-horned rhinoceros. Amazing Experience', './Assets_TBU/Animal Images/img2.jpeg', 'https://www.kaziranganationalpark-india.com/'),
    new Sanctuary(3, 'Jim Corbett National Park', 'Uttarakhand', 'First national park in India known for its diverse fauna.', './Assets_TBU/Animal Images/img3.jpg', 'http://www.corbettnationalpark.in'),
    new Sanctuary(4, 'Sundarban National Park', 'West Bengal', 'Unique mangrove ecosystem and royal Bengal tigers.', './Assets_TBU/Animal Images/img4.jpg', 'https://www.sunderbans-national-park.com/'),
    new Sanctuary(5, 'Bandhavgarh National Park', 'Madhya Pradesh', 'Known for large populations of tigers and wildlife safaris.', './Assets_TBU/Animal Images/img5.jpg', 'http://www.bandhavgarhnationalpark.in'),
    new Sanctuary(6, 'Gir National Park', 'Gujarat', 'Famous for Asiatic lions and diverse flora.', './Assets_TBU/Animal Images/img6.jpg', 'http://www.girnationalpark.in'),
    new Sanctuary(7, 'Periyar Wildlife Sanctuary', 'Kerala', 'Home to elephants tigers and beautiful landscapes.', './Assets_TBU/Animal Images/img7.jpg', 'http://www.periyartigerreserve.org'),
    new Sanctuary(8, 'Manas National Park', 'Assam', 'Rich biodiversity and home to endangered species.', './Assets_TBU/Animal Images/img8.jpg', 'https://whc.unesco.org/en/list/338/'),
    new Sanctuary(9, 'Keoladeo National Park', 'Rajasthan', 'Famous for birdwatching and diverse habitats.', './Assets_TBU/Animal Images/img9.jpg', 'https://www.tourism.rajasthan.gov.in/keoladeo-ghana-national-park.html'),
    new Sanctuary(10, 'Nagarhole National Park', 'Karnataka', 'Known for its rich wildlife including elephants and tigers.', './Assets_TBU/Animal Images/img10.jpg', 'https://www.nagaraholetigerreserve.com/en/'),
    new Sanctuary(11, 'Tadoba Andhari Tiger Reserve', 'Maharashtra', 'One of the largest tiger reserves in India.', './Assets_TBU/Animal Images/img11.jpg', 'http://www.tadobatigerreserve.com'),
    new Sanctuary(12, 'Sariska Tiger Reserve', 'Rajasthan', 'Known for its tigers and rich wildlife diversity.', './Assets_TBU/Animal Images/img12.jpg', 'http://www.sariskatigerreserve.com'),
    new Sanctuary(13, 'Panna National Park', 'Madhya Pradesh', 'Home to diverse wildlife including leopards and deer.', './Assets_TBU/Animal Images/img13.jpeg', 'https://www.pannatigerreserve.in/'),
    new Sanctuary(14, 'Satpura National Park', 'Madhya Pradesh', 'Famous for its hilly terrain and wildlife diversity.', './Assets_TBU/Animal Images/img14.jpg', 'http://www.satpuranationalpark.in'),
    new Sanctuary(15, 'Kanha National Park', 'Madhya Pradesh', 'Known for its vast meadows and tiger population.', './Assets_TBU/Animal Images/img15.jpg', 'http://www.kanhanationalpark.in'),
    new Sanctuary(16, 'Pench National Park', 'Madhya Pradesh', 'Home to diverse wildlife and scenic landscapes.', './Assets_TBU/Animal Images/img16.jpeg', 'http://www.penchnationalpark.in'),
    new Sanctuary(17, 'Mudumalai Wildlife Sanctuary', 'Tamil Nadu', 'Famous for its elephants and rich biodiversity.', './Assets_TBU/Animal Images/img17.jpg', 'http://www.mudumalaitigerreserve.com'),
    new Sanctuary(18, 'Bhitar Kanika Wildlife Sanctuary', 'Odisha', 'Unique estuarine ecosystem with rich wildlife.', './Assets_TBU/Animal Images/img18.jpeg', 'https://www.bhitarkanika.in/about-bhitarkanika.html'),
    new Sanctuary(19, 'Chinnar Wildlife Sanctuary', 'Kerala', 'Home to endangered species like the Nilgiri Tahr.', './Assets_TBU/Animal Images/img19.jpeg', 'https://keralatourism.org/destination/chinnar-wildlife-sanctuary/65'),
    new Sanctuary(20, 'Bhadra Wildlife Sanctuary', 'Karnataka', 'Rich in biodiversity and famous for its wildlife.', './Assets_TBU/Animal Images/img20.jpeg', 'https://chikmagalurtourism.org.in/bhadra-wildlife-sanctuary-muthodi-wildlife-sanctuary-chikmagalur'),
    new Sanctuary(21, 'Valley of Flowers National Park', 'Uttarakhand', 'Famous for its stunning alpine flowers and landscapes.', './Assets_TBU/Animal Images/img21.jpg', 'https://uttarakhandtourism.gov.in/destination/valley-of-flowers'),
    new Sanctuary(22, 'Eravikulam National Park', 'Kerala', 'Home to the Nilgiri Tahr and rich biodiversity.', './Assets_TBU/Animal Images/img22.jpeg', 'https://www.eravikulamnationalpark.in'),
    new Sanctuary(23, 'Rajaji National Park', 'Uttarakhand', 'Known for its rich flora and fauna especially elephants.', './Assets_TBU/Animal Images/img23.jpg', 'http://www.rajajinationalpark.in'),
    new Sanctuary(24, 'Mukurthi National Park', 'Tamil Nadu', 'Home to diverse wildlife and beautiful landscapes.', './Assets_TBU/Animal Images/img24.jpeg', 'https://www.tamilnadutourism.tn.gov.in/destinations/mukurthi-national-park'),
    new Sanctuary(25, 'Anamalai Tiger Reserve', 'Tamil Nadu', 'Famous for its tigers and rich flora.', './Assets_TBU/Animal Images/img25.jpg', 'https://www.forests.tn.gov.in/AnamalaiTigerReserve.html'),
    new Sanctuary(26, 'Desert National Park', 'Rajasthan', 'Unique desert ecosystem with diverse wildlife.', './Assets_TBU/Animal Images/img26.jpeg', 'https://rajras.in/rajasthan/wildlife/pa/national-parks/desert/'),
    new Sanctuary(27, 'Hemis National Park', 'Ladakh', 'Famous for its rugged terrain and unique wildlife.', './Assets_TBU/Animal Images/img27.jpeg', 'https://www.tourmyindia.com/states/ladakh/hemis-national-park.html'),
    new Sanctuary(28, 'Dandeli Wildlife Sanctuary', 'Karnataka', 'Home to rich biodiversity and adventure activities.', './Assets_TBU/Animal Images/img28.jpeg', 'https://www.tourmyindia.com/wildlife_sancturies/dandeli-national-park.html'),
    new Sanctuary(29, 'Simlipal National Park', 'Odisha', 'Known for its stunning landscapes and wildlife.', './Assets_TBU/Animal Images/img29.jpeg', 'https://www.similipal.org/#view-1'),
    new Sanctuary(30, 'Palamau Tiger Reserve', 'Jharkhand', 'Home to tigers and diverse wildlife.', './Assets_TBU/Animal Images/img30.jpeg', 'https://www.palamautigerreserve.in/'),
    new Sanctuary(31, 'Buxa Tiger Reserve', 'West Bengal', 'Famous for its rich biodiversity and scenic beauty.', './Assets_TBU/Animal Images/img31.jpeg', 'https://www.wildbengal.com/buxa-np.php'),
    new Sanctuary(32, 'Mouling National Park', 'Arunachal Pradesh', 'Known for its diverse flora and fauna.', './Assets_TBU/Animal Images/img32.jpg', 'https://arunachalforests.gov.in/services/forest-wildlife/mouling-national-park'),
    new Sanctuary(33, 'Sundha Mata Wildlife Sanctuary', 'Rajasthan', 'Home to diverse wildlife in a picturesque setting.', './Assets_TBU/Animal Images/img33.jpg', 'https://environment.rajasthan.gov.in/content/environment/en/rsbb/about-rajasthan/wild-life-protection-areas.html'),
    new Sanctuary(34, 'Bannerghatta National Park', 'Karnataka', 'Famous for its wildlife and picturesque landscapes.', './Assets_TBU/Animal Images/img34.jpg', 'https://bangaloretourism.in/bannerghatta-national-park'),
    new Sanctuary(35, 'Simbalbara National Park', 'Himachal Pradesh', 'Known for its rich biodiversity in the Himalayas.', './Assets_TBU/Animal Images/img35.jpg', 'https://www.tourtravelworld.com/india/sirmaur/simbalbara-sanctuary.htm'),
    new Sanctuary(36, 'Betla National Park', 'Jharkhand', 'Home to diverse wildlife and beautiful landscapes.', './Assets_TBU/Animal Images/img36.jpg', 'https://www.incredibleindia.gov.in/en'),
    new Sanctuary(37, 'Mukundra Hills National Park', 'Rajasthan', 'Famous for its rich biodiversity and scenic hills.', './Assets_TBU/Animal Images/img37.jpg', 'https://www.ranthamborenationalpark.com/mukundra-hills-tiger-reserve.html'),
    new Sanctuary(38, 'Great Himalayan National Park', 'Himachal Pradesh', 'Home to unique Himalayan wildlife and landscapes.', './Assets_TBU/Animal Images/img38.jpeg', 'https://www.greathimalayannationalpark.org/'),
    new Sanctuary(39, 'Neora Valley National Park', 'West Bengal', 'Known for its rich biodiversity and scenic beauty.', './Assets_TBU/Animal Images/img39.jpg', 'https://www.neoravalleyretreat.com/'),
    new Sanctuary(40, 'Dudhwa National Park', 'Uttar Pradesh', 'Famous for its diverse wildlife and scenic landscapes.', './Assets_TBU/Animal Images/img40.jpg', 'https://www.dudhwanationalpark.in/'),
    new Sanctuary(41, 'Nameri National Park', 'Assam', 'Home to one-horned rhinoceroses and rich flora.', './Assets_TBU/Animal Images/img41.jpg', 'https://www.kaziranga-national-park.com/nameri-national-park.shtml'),
    new Sanctuary(42, 'Murlen National Park', 'Mizoram', 'Known for its unique wildlife and beautiful landscapes.', './Assets_TBU/Animal Images/img42.jpg', 'https://forest.mizoram.gov.in/page/murlen-national-park'),
    new Sanctuary(43, 'Ranganathittu Bird Sanctuary', 'Karnataka', 'Famous for its rich birdlife and scenic beauty.', './Assets_TBU/Animal Images/img43.jpg', 'https://rsis.ramsar.org/ris/2473'),
    new Sanctuary(44, 'Cotigao Wildlife Sanctuary', 'Goa', 'Home to diverse wildlife and beautiful beaches.', './Assets_TBU/Animal Images/img44.jpg', 'https://goa-tourism.com/wildlife/cotigao-wildlife-sanctuary/'),
    new Sanctuary(45, 'Kuno Wildlife Sanctuary', 'Madhya Pradesh', 'Known for its rich biodiversity and wildlife conservation.', './Assets_TBU/Animal Images/img45.jpg', 'https://wildtrails.in/kuno-wildlife-sanctuary/'),
    new Sanctuary(46, 'Jaldapara National Park', 'West Bengal', 'Famous for its diverse wildlife and river ecosystems.', './Assets_TBU/Animal Images/img46.jpg', 'http://www.jaldapara.com'),
    new Sanctuary(47, 'Khangchendzonga National Park', 'Sikkim', 'Home to the Khangchendzonga range and unique wildlife.', './Assets_TBU/Animal Images/img47.jpg', 'https://kaziranganationalparkassam.in/khangchendzonga-national-park/'),
    new Sanctuary(48, 'Orang National Park', 'Assam', 'Famous for its one-horned rhinoceros and rich biodiversity.', './Assets_TBU/Animal Images/img48.jpg', 'https://www.east-himalaya.com/orang.php'),
    new Sanctuary(49, 'Pobitora Wildlife Sanctuary', 'Assam', 'Home to diverse wildlife and beautiful wetlands.', './Assets_TBU/Animal Images/img49.jpg', 'https://www.pobitorawildlifesanctuary.in/'),
    new Sanctuary(50, 'Dibru Saikhowa National Park', 'Assam', 'Known for its unique ecosystems and rich biodiversity.', './Assets_TBU/Animal Images/img50.jpg', 'https://kaziranganationalparkassam.in/dibru-saikhowa-national-park/'),
    new Sanctuary(51, 'Chilika Wildlife Sanctuary', 'Odisha', 'Asia\'s largest brackish water lagoon famous for migratory birds and rich aquatic life.', './Assets_TBU/Animal Images/img51.jpg', 'https://www.chilika.com/'),
    new Sanctuary(52, 'Nal Sarovar Bird Sanctuary', 'Gujarat', 'A wetland known for its winter migratory birds especially flamingos and pelicans.', './Assets_TBU/Animal Images/img52.jpg', 'https://www.gujarattourism.com/central-zone/ahmedabad/nalsarovar-bird-sanctuary.html'),
];

// Search by name
function findSanctuaryByName(name) {
    return sanctuaries.find(sanctuary => sanctuary.name.split(' ')[0].toLowerCase() === name.split(' ')[0].toLowerCase());
    // Here using split(' ') to split the string array whenever it reaches a whitespace. 
    // To Search for the first word only EG: 'Ranthambore' not 'Ranthambore National Park'.
}
//Example
//console.log(findSanctuaryByName('Kaziranga').getInfo());

// Modal Animation
const modalAnim = [
    {opacity: 0, transform: 'scale(80%)'},
    {opacity: 1, transform: 'scale(100%)'}
]
const modalAnimTime = {
    duration: 500,
    easing: 'ease',
    fill: 'backwards'
}
const modalAnimTimeRev = {
    duration: 300,
    easing: 'ease',
    fill: 'backwards',
    direction: 'reverse'
}
const gridShift = [
    {transform: 'translateY(-70vh)'},
    {transform: 'translateY(0vh)'}
]

// DOM Accessing ------------------------------------------------------------------------------------------------------------------------------
const container = document.querySelector('.sanctuary-grid');
const searchBar = document.querySelector('.searchBar');
const searchBtn = document.querySelector('.searchBtn');
const searchedModal = document.querySelector('.searchedModal');
const navbarToggler = document.querySelector('.navbar-toggler');
const sancGrid = document.querySelector('.sanctuary-grid');

// Searching a Sanctuary
searchedModal.style.display = 'none';
let searchVal;
let searchInfo;

// if redirected from home page through a sanctuary image, that sanctuary will be searched
searchBar.value = localStorage.getItem('SanctuaryName');
if(searchBar.value != ''){
    searchSanc()
    searchedModal.animate(modalAnim, modalAnimTime);
    sancGrid.animate(gridShift, modalAnimTime);
}

// Search Bar Event Listeners
searchBtn.addEventListener('click', ()=> {
    searchSanc();
    searchedModal.animate(modalAnim, modalAnimTime);
    sancGrid.animate(gridShift, modalAnimTime);
})
searchBar.addEventListener('keyup', (e)=> {
    if(e.key == 'Enter'){
        searchSanc();
        searchedModal.animate(modalAnim, modalAnimTime);
        sancGrid.animate(gridShift, modalAnimTime);
    }
})


// To Add Sancturies Loop through the sanctuaries and generate HTML
function regenSancturies() {
    shuffledArray.forEach(sanctuary => {
        const sanctuaryCard = `
            <div class="sanctuary-card">
                <div class="sanctuary-image-bg">
                <img src="${sanctuary.img}" class="sanctuary-image img-fluid">
                </div>
                <div class="sanctuary-content">
                    <h3>${sanctuary.name}</h3>
                    <p>Location: ${sanctuary.location}</p>
                    <p>${sanctuary.description}</p>
                    <button> <a href="${sanctuary.website}" target="_blank" style="text-decoration: none; color: white;"> 
                    Get Info Here 
                    </a> </button>
                </div>
            </div>
         `;
        container.innerHTML += sanctuaryCard;
    });
}

// To Shuffle the Sanctuaries Array
function shuffleArray(array) {
    for (let i = 0; i < array.length-1; i++) {
        // Generate a random index from 0 to i
        const j = Math.floor(Math.random() * (50));
        
        // Swap elements at indices i and j
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}
const shuffledArray = shuffleArray(sanctuaries);
regenSancturies()

// To Search Sanctuaries
function searchSanc(){
    try{
        searchedModal.style.display = 'block';
        searchedModal.innerHTML = null; // to erase any pre-searched santuary modal
        searchVal = searchBar.value;
        searchInfo = findSanctuaryByName(searchVal).getInfo();
        searchInfo = searchInfo.split(', ');
        const searchedCard = `
            <div class="sanctuary-card">
            <div class="sanctuary-image-bg">
            <img src="${searchInfo[4]}" class="sanctuary-image img-fluid">
            </div>
            <div class="sanctuary-content">
                <h3>${searchInfo[1]}</h3>
                <p>Location: ${searchInfo[2]}</p>
                <p>${searchInfo[3]}</p><button> <a href="${searchInfo[5]}" target="_blank" style="text-decoration: none; color: white;"> 
                    Get Info Here 
                    </a> </button>
                <a class="closeBtn btn btn-danger my-2">Close</a>
            </div>
            </div>
        `;
        searchedModal.innerHTML += searchedCard;

        // Add close functionality to the close button
        const newCloseBtn = searchedModal.querySelector('.closeBtn');
        newCloseBtn.addEventListener('click', () => {
            searchedModal.animate(modalAnim,modalAnimTimeRev);
            sancGrid.animate(gridShift, modalAnimTimeRev);
            setTimeout(() => {
                searchedModal.style.display = 'none';
            }, 300);
        });
        
        navbarToggler.click() //for mobiles to auto close the navbar toggler icon
        searchBar.value = null;
        scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    } 
    catch (error) {
        searchedModal.style.display = 'none';
        alert("No Such Sanctuary in List!");
        // console.log(error);
    }
}