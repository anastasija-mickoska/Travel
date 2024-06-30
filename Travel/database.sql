CREATE DATABASE IF NOT EXISTS travel_agency;

USE travel_agency;

CREATE TABLE IF NOT EXISTS users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    emailAddress VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS admins (
    adminID INT AUTO_INCREMENT PRIMARY KEY,
    emailAddress VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    FullName VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS categories (
    categoryID INT AUTO_INCREMENT PRIMARY KEY,
    categoryName VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS destinations (
    destinationID INT AUTO_INCREMENT PRIMARY KEY,
    categoryID INT NOT NULL,
    destinationName VARCHAR(100) NOT NULL,
    fromDate DATE NOT NULL,
    toDate DATE NOT NULL,
    description VARCHAR(1000) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    location VARCHAR(100) NOT NULL,
    imgUrl VARCHAR(500) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
);
CREATE TABLE IF NOT EXISTS bookings (
    bookingID INT AUTO_INCREMENT PRIMARY KEY,
    destinationID INT NOT NULL,
    userID INT NOT NULL,
    bookingDate DATE NOT NULL,
    FOREIGN KEY (destinationID) REFERENCES destinations(destinationID),
    FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO categories (categoryName) VALUES
( 'Spring'),
( 'Summer'),
( 'Fall'),
( 'Winter');

INSERT INTO destinations (categoryID, destinationName, fromDate, toDate, description, price, location, imgUrl, created_at) VALUES
(1, 'Cherry blossom season in Japan', '2025-04-02', '2025-04-06', 'As spring unfolds, Kyoto becomes a canvas painted in shades of pink as cherry blossoms, or sakura, blanket the city. You can stroll through iconic sites like Maruyama Park and Philosopher''s Path, where cherry trees create a breathtaking canopy of blooms.', 850.00, 'Japan', 'https://www.japanrailpassnow.com/wp-content/uploads/2012/07/Fujiyoshida-Japan-at-Chureito-Pagoda-and-Mt.-Fuji-in-the-spring-with-cherry-blossoms.jpg', NOW()),
(1, 'Amsterdam Tulip Festival', '2025-04-10', '2025-04-15', 'Plan your perfect trip to the capital of Holland, Amsterdam and see the Dutch tulips fields in bloom. The tulip season in Holland marks the beginning of spring. The colorful flowers and the rising temperatures make many people from all over the world happy.', 350.00, 'Amsterdam', 'https://tulipfestivalamsterdam.com/wp-content/uploads/2021/06/Tulip-season-Amsterdam-2022.jpg', NOW()),
(1, 'Istanbul', '2025-04-26', '2025-04-29', 'Istanbul welcomes the spring in style with Judas trees that bloom along the Bosphorus coastline, tulips that surround the entire city and create mesmerizing views in Emirgan Forest and Göztepe Park, which host the Tulip Festival.', 180.00, 'Istanbul', 'https://img.freepik.com/premium-photo/spring-istanbul-turkey_928112-1833.jpg', NOW()),
(2, 'Barcelona', '2024-07-12', '2024-07-20', 'Barcelona is a magnificent melting pot of a city where every step brings another delight. Lying by the glittering Mediterranean, it is home to world-class architecture, culture and food, as well as some of the best nightlife in Europe, and one of the world’s greatest club soccer teams, FC Barcelona.', 650.00, 'Barcelona', 'https://hostemplo.com/wp-content/uploads/2018/06/Playa-de-Barcelona.jpg', NOW()),
(2, 'Amalfi Coast', '2024-06-30', '2024-07-10', 'Amalfi Coast boasts a classic Mediterranean landscape, a sensual blend of both natural and cultural wonders. The breathtaking terrain includes dramatic coastline topography scattered with terraced vineyards, orchards, and pastures—often with enchanting views of the vibrant waters below.', 790.00, 'Amalfi Coast', 'https://www.travelandleisure.com/thmb/c-nuaEqUffHAByhV7Ls6iDEeXwc=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/TAL-header-atrani-italy-amalfi-coast-AMALFITOWNS0223-c516bc91bb434e19b5ec6e2fb50cb9eb.jpg', NOW()),
(2, 'Mykonos', '2024-07-21', '2024-07-28', 'Mykonos is known for its Cycladic architecture (whitewashed houses, alleyways and chapels), cosmopolitan vibe and luxury accommodation and services, as well as its party scene and beautiful, sandy beaches. Many beaches have internationally-acclaimed restaurants and clubs, attracting celebrity DJs.', 920.00, 'Mykonos', 'https://media.timeout.com/images/106025742/750/422/image.jpg', NOW()),
(2, 'Dubrovnik', '2024-08-10', '2024-08-18', 'The Pearl of the Adriatic, situated on the Dalmatian coast,is known for its rich history and culture, stunning architecture, and picturesque landscapes. Old Town of Dubrovnik is listed as a UNESCO World Heritage Site and full of historic landmarks like the Walls of Dubrovnik', 570.00, 'Dubrovnik', 'https://www.godubrovnik.com/wp-content/uploads/croatia-dubrovnik-holidays.jpg', NOW()),
(3, 'Kranjska Gora and Bled Lake', '2024-10-10', '2024-10-14', 'Slovenia is a country of four distinct seasons, therefore nature shows us all its treasures! Autumn in Bled creates a breath-taking story of the warm shades of yellow, brown, red and purple colours that reflect on the calm lake surface. Peace is in nature and peace is in people. Destination Kranjska Gora offers peace and every morning a new color spectrum in forests and meadows.', 320.00, 'Slovenia', 'https://www.gardatravelclub.com/wp-content/uploads/2018/01/slovenia.jpg', NOW()),
(3, 'Milano, Lugano, Como', '2024-09-28', '2024-10-02', 'Milano in the fall is intriguing and mesmerizing. Chestnuts and lime trees change foliage, the fog returns, the weather is still warm, but light changes. Embark on a historical journey with your guide in the lakeside city of Lugano.Enjoy a tour in the historical centre of Como to discover its main highlights.Take a Boat Tour on the Lake with your Guide and experience breathtaking views', 220.00, 'Italy, Switzerland', 'https://www.thenaturaladventure.com/wp-content/uploads/2018/11/Trails-of-Italian-Lakes-Como-and-Lugano.jpg', NOW()),
(4, 'Strasbourg and Colmar', '2024-12-01', '2024-12-05', 'Alsace is a region brimming with charm, from its half-timbered houses and quaint cobblestone streets to its hearty dishes, delicious wine, and flower-adorned villages... Since 1570, the Strasbourg Christmas Market has been turning the city into a winter wonderland. With its four centuries of tradition, it is the oldest Christmas market in France, and one of the oldest in Europe! Each of Colmar six Christmas Markets is a separate mini-village with its own collection of passionate craftsmen. Installed in squares with their own architectural signature, these islands of festivity reflect the character of the city hosting them: friendly and authentic.', 430.00, 'France', 'https://www.noel.alsace/wp-content/uploads/2019/06/thio-noel-colmar-aaa-nis-for-1600x900.jpg', NOW()),
(4, 'Christmas Market in Vienna', '2024-12-06', '2024-12-10', 'This is a large Christmas market, with plenty of beautiful lights, lots of food options, and many unique stalls with different souvenirs. There is an adult carousel, a ferris wheel and an ice rink. The town hall makes a beautiful backdrop for the market.', 170.00, 'Vienna', 'https://cdn-blob.austria.info/cms-uploads-prod/default/0001/04/thumb_3006_default_teaser.jpeg?cachebuster=1696691247', NOW()),
(4, 'Magic Winter on the Arctic Circle in Rovaniemi', '2024-12-15', '2024-12-18', 'Adventure through the Arctic! Check out the view from the peak of the local fell. Ride on a sleigh in the local reindeer and husky farms. Meet Santa Claus in his village and get your Arctic adventurer certificate for crossing the Arctic Circle.', 690.00, 'Rovaniemi', 'https://media.voog.com/0000/0041/6144/photos/private-aurora-locations-beyond-arctic-rovaniemi-lapland_block.jpg', NOW());

INSERT INTO users (emailAddress, password, firstName, lastName) VALUES
('dolores@gmail.com', 'dolores123', 'Dolores', 'Medina'),
('liam_s@gmail.com', 'liamS1234!', 'Liam', 'Stephens'),
('theodore_adams@yahoo.com', 'theo0000!', 'Theodore', 'Adams'),
('kaya@outlook.com', 'kaya1234', 'Kaya', 'Miller');

INSERT INTO admins ( emailAddress, password, FullName) VALUES
( 'admin1@travelagency.com', 'Admin1123', 'Admin1'),
( 'admin2@travelagency.com', 'Admin2123', 'Admin2');
