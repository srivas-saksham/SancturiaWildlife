<?php
require_once '../config/database.php';

$sanctuaries = [
    [1, 'Ranthambore National Park', 'Rajasthan', 'Famous for Bengal tigers and diverse wildlife. Do Visit Once', '/Assets_TBU/Animal Images/img1.jpg', 'https://www.ranthamborenationalpark.com/'],
    [2, 'Kaziranga National Park', 'Assam', 'Home to the Indian one-horned rhinoceros. Amazing Experience', '/Assets_TBU/Animal Images/img2.jpeg', 'https://www.kaziranganationalpark-india.com/'],
    [3, 'Jim Corbett National Park', 'Uttarakhand', 'First national park in India known for its diverse fauna.', '/Assets_TBU/Animal Images/img3.jpg', 'http://www.corbettnationalpark.in'],
    [4, 'Sundarban National Park', 'West Bengal', 'Unique mangrove ecosystem and royal Bengal tigers.', '/Assets_TBU/Animal Images/img4.jpg', 'https://www.sunderbans-national-park.com/'],
    [5, 'Bandhavgarh National Park', 'Madhya Pradesh', 'Known for large populations of tigers and wildlife safaris.', '/Assets_TBU/Animal Images/img5.jpg', 'http://www.bandhavgarhnationalpark.in'],
    [6, 'Gir National Park', 'Gujarat', 'Famous for Asiatic lions and diverse flora.', '/Assets_TBU/Animal Images/img6.jpg', 'http://www.girnationalpark.in'],
    [7, 'Periyar Wildlife Sanctuary', 'Kerala', 'Home to elephants tigers and beautiful landscapes.', '/Assets_TBU/Animal Images/img7.jpg', 'http://www.periyartigerreserve.org'],
    [8, 'Manas National Park', 'Assam', 'Rich biodiversity and home to endangered species.', '/Assets_TBU/Animal Images/img8.jpg', 'https://whc.unesco.org/en/list/338/'],
    [9, 'Keoladeo National Park', 'Rajasthan', 'Famous for birdwatching and diverse habitats.', '/Assets_TBU/Animal Images/img9.jpg', 'https://www.tourism.rajasthan.gov.in/keoladeo-ghana-national-park.html'],
    [10, 'Nagarhole National Park', 'Karnataka', 'Known for its rich wildlife including elephants and tigers.', '/Assets_TBU/Animal Images/img10.jpg', 'https://www.nagaraholetigerreserve.com/en/'],
    // Add remaining 42 sanctuaries here following same pattern...
    [51, 'Chilika Wildlife Sanctuary', 'Odisha', "Asia's largest brackish water lagoon famous for migratory birds and rich aquatic life.", '/Assets_TBU/Animal Images/img51.jpg', 'https://www.chilika.com/'],
    [52, 'Nal Sarovar Bird Sanctuary', 'Gujarat', 'A wetland known for its winter migratory birds especially flamingos and pelicans.', '/Assets_TBU/Animal Images/img52.jpg', 'https://www.gujarattourism.com/central-zone/ahmedabad/nalsarovar-bird-sanctuary.html']
];

try {
    $stmt = $pdo->prepare("INSERT INTO sanctuaries (sanctuary_id, name, location, description, image_path, website_url) VALUES (?, ?, ?, ?, ?, ?)");
    
    foreach ($sanctuaries as $sanctuary) {
        $stmt->execute($sanctuary);
    }
    
    echo "Successfully inserted " . count($sanctuaries) . " sanctuaries!\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>