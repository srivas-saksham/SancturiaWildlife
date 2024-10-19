
class Sanctuary {
    constructor(id, name, location, description, img) {
        this.id = id;
        this.name = name;
        this.location = location;
        this.description = description
        this.img = img
    }

    getInfo() {
        return `ID: ${this.id}, Sanctuary: ${this.name}, State: ${this.state}`;
    }
}

const sanctuaries = [
    new Sanctuary(1, 'Ranthambore National Park', 'Rajasthan', 'Famous for Bengal tigers and diverse wildlife. Do Visit Once', './Assets_TBU/Animal Images/img1.jpg'),
    new Sanctuary(2, 'Kaziranga National Park', 'Assam', 'Home to the Indian one-horned rhinoceros. Amazing Experience', './Assets_TBU/Animal Images/img2.jpeg'),
    new Sanctuary(3, 'Jim Corbett National Park', 'Uttarakhand', 'First national park in India, known for its diverse fauna.', './Assets_TBU/Animal Images/img3.jpg'),
    new Sanctuary(4, 'Sundarbans National Park', 'West Bengal', 'Unique mangrove ecosystem and royal Bengal tigers.', './Assets_TBU/Animal Images/img4.jpg'),
    new Sanctuary(5, 'Bandhavgarh National Park', 'Madhya Pradesh', 'Known for large populations of tigers and wildlife safaris.', './Assets_TBU/Animal Images/img5.jpg'),
    new Sanctuary(6, 'Gir National Park', 'Gujarat', 'Famous for Asiatic lions and diverse flora.', './Assets_TBU/Animal Images/img6.jpg'),
    new Sanctuary(7, 'Periyar Wildlife Sanctuary', 'Kerala', 'Home to elephants, tigers, and beautiful landscapes.', './Assets_TBU/Animal Images/img7.jpg'),
    new Sanctuary(8, 'Manas National Park', 'Assam', 'Rich biodiversity and home to endangered species.', './Assets_TBU/Animal Images/img8.jpg'),
    new Sanctuary(9, 'Keoladeo National Park', 'Rajasthan', 'Famous for birdwatching and diverse habitats.', './Assets_TBU/Animal Images/img9.jpg'),
    new Sanctuary(10, 'Nagarhole National Park', 'Karnataka', 'Known for its rich wildlife, including elephants and tigers.', './Assets_TBU/Animal Images/img10.jpg'),
    new Sanctuary(11, 'Tadoba Andhari Tiger Reserve', 'Maharashtra', 'One of the largest tiger reserves in India.', './Assets_TBU/Animal Images/img11.jpg'),
    new Sanctuary(12, 'Sariska Tiger Reserve', 'Rajasthan', 'Known for its tigers and rich wildlife diversity.', './Assets_TBU/Animal Images/img12.jpg'),
    new Sanctuary(13, 'Panna National Park', 'Madhya Pradesh', 'Home to diverse wildlife, including leopards and deer.', './Assets_TBU/Animal Images/img13.jpeg'),
    new Sanctuary(14, 'Satpura National Park', 'Madhya Pradesh', 'Famous for its hilly terrain and wildlife diversity.', './Assets_TBU/Animal Images/img14.jpg'),
    new Sanctuary(15, 'Kanha National Park', 'Madhya Pradesh', 'Known for its vast meadows and tiger population.', './Assets_TBU/Animal Images/img15.jpg'),
    new Sanctuary(16, 'Pench National Park', 'Madhya Pradesh', 'Home to diverse wildlife and scenic landscapes.', './Assets_TBU/Animal Images/img16.jpeg'),
    new Sanctuary(17, 'Mudumalai Wildlife Sanctuary', 'Tamil Nadu', 'Famous for its elephants and rich biodiversity.', './Assets_TBU/Animal Images/img17.jpg'),
    new Sanctuary(18, 'Bhitar Kanika Wildlife Sanctuary', 'Odisha', 'Unique estuarine ecosystem with rich wildlife.', './Assets_TBU/Animal Images/img18.jpeg'),
    new Sanctuary(19, 'Chinnar Wildlife Sanctuary', 'Kerala', 'Home to endangered species like the Nilgiri Tahr.', './Assets_TBU/Animal Images/img19.jpeg'),
    new Sanctuary(20, 'Bhadra Wildlife Sanctuary', 'Karnataka', 'Rich in biodiversity and famous for its wildlife.', './Assets_TBU/Animal Images/img20.jpeg'),
    new Sanctuary(21, 'Valley of Flowers National Park', 'Uttarakhand', 'Famous for its stunning alpine flowers and landscapes.', './Assets_TBU/Animal Images/img21.jpg'),
    new Sanctuary(22, 'Eravikulam National Park', 'Kerala', 'Home to the Nilgiri Tahr and rich biodiversity.', './Assets_TBU/Animal Images/img22.jpeg'),
    new Sanctuary(23, 'Rajaji National Park', 'Uttarakhand', 'Known for its rich flora and fauna, especially elephants.', './Assets_TBU/Animal Images/img23.jpg'),
    new Sanctuary(24, 'Mukurthi National Park', 'Tamil Nadu', 'Home to diverse wildlife and beautiful landscapes.', './Assets_TBU/Animal Images/img24.jpeg'),
    new Sanctuary(25, 'Anamalai Tiger Reserve', 'Tamil Nadu', 'Famous for its tigers and rich flora.', './Assets_TBU/Animal Images/img25.jpeg'),
    new Sanctuary(26, 'Desert National Park', 'Rajasthan', 'Unique desert ecosystem with diverse wildlife.', './Assets_TBU/Animal Images/img26.jpeg'),
    new Sanctuary(27, 'Hemis National Park', 'Ladakh', 'Famous for its rugged terrain and unique wildlife.', './Assets_TBU/Animal Images/img27.jpeg'),
    new Sanctuary(28, 'Dandeli Wildlife Sanctuary', 'Karnataka', 'Home to rich biodiversity and adventure activities.', './Assets_TBU/Animal Images/img28.jpeg'),
    new Sanctuary(29, 'Simlipal National Park', 'Odisha', 'Known for its stunning landscapes and wildlife.', './Assets_TBU/Animal Images/img29.jpeg'),
    new Sanctuary(30, 'Palamau Tiger Reserve', 'Jharkhand', 'Home to tigers and diverse wildlife.', './Assets_TBU/Animal Images/img30.jpeg'),
    new Sanctuary(31, 'Buxa Tiger Reserve', 'West Bengal', 'Famous for its rich biodiversity and scenic beauty.', './Assets_TBU/Animal Images/img31.jpeg'),
    new Sanctuary(32, 'Mouling National Park', 'Arunachal Pradesh', 'Known for its diverse flora and fauna.', './Assets_TBU/Animal Images/img32.jpg'),
    new Sanctuary(33, 'Sundha Mata Wildlife Sanctuary', 'Rajasthan', 'Home to diverse wildlife in a picturesque setting.', './Assets_TBU/Animal Images/img33.jpg'),
    new Sanctuary(34, 'Bannerghatta National Park', 'Karnataka', 'Famous for its wildlife and picturesque landscapes.', './Assets_TBU/Animal Images/img34.jpg'),
    new Sanctuary(35, 'Simbalbara National Park', 'Himachal Pradesh', 'Known for its rich biodiversity in the Himalayas.', './Assets_TBU/Animal Images/img35.jpg'),
    new Sanctuary(36, 'Betla National Park', 'Jharkhand', 'Home to diverse wildlife and beautiful landscapes.', './Assets_TBU/Animal Images/img36.jpg'),
    new Sanctuary(37, 'Mukundra Hills National Park', 'Rajasthan', 'Famous for its rich biodiversity and scenic hills.', './Assets_TBU/Animal Images/img37.jpg'),
    new Sanctuary(38, 'Great Himalayan National Park', 'Himachal Pradesh', 'Home to unique Himalayan wildlife and landscapes.', './Assets_TBU/Animal Images/img38.jpg'),
    new Sanctuary(39, 'Neora Valley National Park', 'West Bengal', 'Known for its rich biodiversity and scenic beauty.', './Assets_TBU/Animal Images/img39.jpg'),
    new Sanctuary(40, 'Dudhwa National Park', 'Uttar Pradesh', 'Famous for its diverse wildlife and scenic landscapes.', './Assets_TBU/Animal Images/img40.jpg'),
    new Sanctuary(41, 'Nameri National Park', 'Assam', 'Home to one-horned rhinoceroses and rich flora.', './Assets_TBU/Animal Images/img41.jpg'),
    new Sanctuary(42, 'Murlen National Park', 'Mizoram', 'Known for its unique wildlife and beautiful landscapes.', './Assets_TBU/Animal Images/img42.jpg'),
    new Sanctuary(43, 'Ranganathittu Bird Sanctuary', 'Karnataka', 'Famous for its rich birdlife and scenic beauty.', './Assets_TBU/Animal Images/img43.jpg'),
    new Sanctuary(44, 'Cotigao Wildlife Sanctuary', 'Goa', 'Home to diverse wildlife and beautiful beaches.', './Assets_TBU/Animal Images/img44.jpg'),
    new Sanctuary(45, 'Kuno Wildlife Sanctuary', 'Madhya Pradesh', 'Known for its rich biodiversity and wildlife conservation.', './Assets_TBU/Animal Images/img45.jpg'),
    new Sanctuary(46, 'Jaldapara National Park', 'West Bengal', 'Famous for its diverse wildlife and river ecosystems.', './Assets_TBU/Animal Images/img46.jpg'),
    new Sanctuary(47, 'Khangchendzonga National Park', 'Sikkim', 'Home to the Khangchendzonga range and unique wildlife.', './Assets_TBU/Animal Images/img47.jpg'),
    new Sanctuary(48, 'Orang National Park', 'Assam', 'Famous for its one-horned rhinoceros and rich biodiversity.', './Assets_TBU/Animal Images/img48.jpg'),
    new Sanctuary(49, 'Pobitora Wildlife Sanctuary', 'Assam', 'Home to diverse wildlife and beautiful wetlands.', './Assets_TBU/Animal Images/img49.jpg'),
    new Sanctuary(50, 'Dibru-Saikhowa National Park', 'Assam', 'Known for its unique ecosystems and rich biodiversity.', './Assets_TBU/Animal Images/img50.jpg')
];

// Example usage:
console.log(sanctuaries[2].getInfo());  // Output: "ID: 1, Sanctuary: Ranthambore National Park, State: Rajasthan"

// Search by name
function findSanctuaryByName(name) {
    return sanctuaries.find(sanctuary => sanctuary.name.toLowerCase() === name.toLowerCase());
}

// Example usage
console.log(findSanctuaryByName('Kaziranga National Park').getInfo());

// To Add 50 Sancturies
const container = document.getElementById('sanctuaries-container');

// Loop through the sanctuaries and generate HTML
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
                <button>Get Info Here</button>
            </div>
        </div>
        `;
        container.innerHTML += sanctuaryCard;
    });
}

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
