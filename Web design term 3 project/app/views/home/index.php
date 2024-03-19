<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harlem Festival</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Vampiro+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="CSS_files/home.css">
  </head>

  <body class="antialiased font-'Open Sans'">
  <?php include __DIR__ . '/../header.php';

  // Initialize the repository
  $repository = new App\Repositories\userRepository();

  // Fetch users
  $users = $repository->getUsers();
  ?>
    <div class="word-container">
      <div class="word-vertical haarlem" style="margin-left: 120px; margin-top: 30px;">
        <div>H</div>
        <div>A</div>
        <div>A</div>
        <div>R</div>
        <div>L</div>
        <div>E</div>
        <div>M</div>
      </div>
      <div class="word-vertical festival" style="margin-left: 60px; margin-top: 30px;">
        <div>F</div>
        <div>E</div>
        <div>S</div>
        <div>T</div>
        <div>I</div>
        <div>V</div>
        <div>A</div>
        <div>L</div>
      </div>
    </div>
    <!-- <div class="banner">
      Let The Fun Begin
    </div> -->
  <div>
    
    <section class="section-bg py-10 px-10">
      <div class="text-center mb-8 text-white">
        <h2 class="text-6xl font-bold">WHAT IS THERE TO DO?</h2>
        <div class="flex items-center justify-center bg-no-repeat bg-center bg-contain h-72 md:h-96 lg:min-h-[300px] px-12 py-10" 
          style="background-image: url('assets/images/elements/Union.png'); ">
          <p class="text-base font-normal text-white rounded-lg lg:text-black">
            Indulge in Haarlem's vibrant tapestry—immerse in cultural marvels within museums and iconic windmills,
            savor the city's culinary delights,<br> and let kids revel in a mobile event tied to the Taylers Museum.
            For the night owls, "Dance" beckons with lively hotspots.<br> Discover history, flavors, family fun,
            and nightlife in this captivating city—a blend of past, present, and endless possibilities.
          </p>
        </div>
      <div class="container mx-auto grid grid-cols-1 gap-4"></div>
    </section>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-7xl rounded-lg bg-white p-6 shadow-lg lg:grid lg:grid-cols-2 lg:gap-4 items-center"
       style="max-width: 1300px; background-color: white;">
    <div class="flex justify-center lg:justify-start px-4 lg:pl-0"
         style="flex: 1; max-width: 50%;">
      <img src="assets/images/Home_page_Images/Dance_Image_Homepage.png"
           alt="A vibrant dance event with people enjoying music and performances"
           class="rounded-lg max-w-xs md:max-w-sm lg:max-w-none"
           style="width: 100%; height: auto; margin-left: 0; lg:margin-left: 150px;">
    </div>
    <div class="text-center lg:text-left px-4 lg:px-0"
         style="flex: 1; padding: 20px; margin-right: 0; lg:margin-right: 250px;">
      <h3 class="text-2xl font-bold text-gold mt-4">Dance!</h3>
      <p class="text-gray-600 mt-2">If you are a music enthusiast, Haarlem is THE PLACE for YOU! With lots of bars and music venues, you can find any kind of music you might like: from the best techno parties to live bands playing jazz and songwriter’s concerts. Suitable for young adults, families and people with special needs, Haarlem has a place for everyone!</p>
      <a href="#" class="mt-4 lg:mt-8 inline-block bg-red-500 text-white py-2 px-6 lg:px-20 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
         style="display: block; width: 100%; text-align: center;">Learn More</a>
    </div>
  </div>
</div>

<!-- <div class="container mx-auto grid grid-cols-1 gap-4">
    <div class="event-bg rounded-lg p-6 flex items-center justify-between"
      style="background-color: white; padding: 10px; max-width: 1300px; margin: auto;">
      <div style="flex: 1; max-width: 50%;">
        <img class="image-round" src="assets/images/Home_page_Images/Dance_Image_Homepage.png"
          alt="A vibrant dance event with people enjoying music and performances" class="rounded-lg"
          style="width: 100%; height: auto; max-width: 50%; margin-left: 150px;">
      </div>
      <div style="flex: 1; padding: 20px; margin-right: 250px;">
        <h3 class="text-gold text-2xl font-bold mt-4">Dance!</h3>
        <p class="text-gray-600 mt-2">If you are a music enthusiast, Haarlem is THE PLACE for YOU!
          With lots of bars and music venues, you can find any kind of music you might like: from the
          best techno parties to live bands playing jazz and songwriter’s concerts.
          Suitable for young adults, families and people with special needs, Haarlem has a place for everyone!</p>
        <a href="#" class="bg-red-500 text-white py-2 px-20 rounded"
          style="display: block; width: 100%; margin-top: 15px; text-align: center;">Learn More</a>
      </div>
    </div> -->

    <!-- Food -->
    <div class="event-bg rounded-lg p-6 flex items-center justify-between"
      style="background-color: white; padding: 10px; max-width: 1300px; margin: auto;">
      <div style="flex: 1; max-width: 50%;">
        <img src="assets\images\Home_page_Images\Yummy_Image_Homepage.png"
          alt="A vibrant dance event with people enjoying music and performances" class="rounded-lg"
          style="width: 100%; height: auto; max-width: 50%; margin-left: 150px;">
      </div>
      <div style="flex: 1; padding: 20px; margin-right: 250px;">
        <h3 class="text-gold text-2xl font-bold mt-4">Yummy!</h3>
        <p class="text-gray-600 mt-2">
          Discover the hidden gems of Haarlem's vibrant culinary scene as we bring you a feast for the senses.
          While Haarlem may not be a global culinary icon, our city is home to a diverse array of restaurants that are
          sure to captivate
          your taste buds. Dive into a world of gastronomic delights, where each bite tells a unique story.</p>
        <a href="#" class="bg-blue-500 text-white py-2 px-20 rounded"
          style="display: block; width: 100%; margin-top: 15px; text-align: center;">Learn More</a>
      </div>
    </div>

    <!-- History -->
    <div class="event-bg rounded-lg p-6 flex items-center justify-between"
      style="background-color: white; padding: 10px; max-width: 1300px; margin: auto;">
      <div style="flex: 1; max-width: 50%;">
        <img src="assets\images\Home_page_Images\History_Image_Homepage.png"
          alt="A vibrant dance event with people enjoying music and performances" class="rounded-lg"
          style="width: 100%; height: auto; max-width: 50%; margin-left: 150px;">
      </div>
      <div style="flex: 1; padding: 20px; margin-right: 250px;">
        <h3 class="text-gold text-2xl font-bold mt-4">History!</h3>
        <p class="text-gray-600 mt-2">
          Haarlem, a city rich in history and adorned with captivating tales,
          offering a treasure trove of landmarks waiting to be explored.
          We invite you to immerse yourself in this enchanting blend of antiquity and modernity,
          where the past's timeless charm meets the vibrant pulse of the present—a perfect opportunity
          to discover and indulge in the city's breath-taking splendor.</p>
        <a href="#" class="bg-yellow-500 text-white py-2 px-20 rounded"
          style="display: block; width: 100%; margin-top: 15px; text-align: center;">Learn More</a>
      </div>
    </div>


  <div style="height: 60px;"></div>
    <title>Festival Location</title>
    </div>

  <div>
    <div class="right-aligned-text">
      WHERE IS THE FESTIVAL?
    </div>

    <div class="festival-location-section flex-col-reverse md:flex-row ">
      <div class="info-box md:w-2/3 pr-14">
        <!-- <h2>WHERE IS THE FESTIVAL?</h2> -->
        <p>Discover the magic of The Festival in the vibrant city of Haarlem,
          nestled to the west of Amsterdam and north of The Hague.
          The festival takes place across the entire city of Haarlem, but most noticeably in the center.
          Join us for an unforgettable experience!</p>
        <a href="#" class="btn" style="padding: 0.5rem 1rem; width: 50%; margin-left: 180px; font-size: 0.9rem;">Check
          festival schedule</a>
      </div>

      <div class="md:w-1/3 h-80 rounded-lg overflow-hidden">
        <!-- Replace the src attribute's value with the actual path to your image -->
        <img src="assets/images/Home_page_Images/Map_Image_Homepage.png" class="h-full object-cover">
      </div>
    </div>
    </div>

  <div style="height: 20px;"></div>

  <div>
    <div class="font-sans">
      <div class="text-center text-5xl">
        SCHEDULE OF THE EVENTS
      </div>
    </div>
    </div>

    <!-- Dates -->
    <div class="flex justify-around space-x-10 mb-10"
      style="display: flex; justify-content: space-around; margin-bottom: 2.5rem;">
      <div class="text-center px-5" style="text-align: center; padding-left: 1.25rem; padding-right: 1.25rem;">
        <div class="text-6xl" style="font-size: 5rem; font-family: 'Impact', sans-serif;">25</div>
        <div class="text-xl" style="font-size: 1.5rem; font-family: 'Imprima', sans-serif;">Jul</div>
        <div style="font-size: 1.25rem; font-family: 'Imprima', sans-serif;">Thursday</div>
      </div>
      <div class="text-center px-5" style="text-align: center; padding-left: 1.25rem; padding-right: 1.25rem;">
        <div class="text-6xl" style="font-size: 5rem; font-family: 'Impact', sans-serif;">26</div>
        <div class="text-xl" style="font-size: 1.5rem; font-family: 'Imprima', sans-serif;">Jul</div>
        <div style="font-size: 1.25rem; font-family: 'Imprima', sans-serif;">Friday</div>
      </div>
      <div class="text-center px-5" style="text-align: center; padding-left: 1.25rem; padding-right: 1.25rem;">
        <div class="text-6xl" style="font-size: 5rem; font-family: 'Impact', sans-serif;">27</div>
        <div class="text-xl" style="font-size: 1.5rem; font-family: 'Imprima', sans-serif;">Jul</div>
        <div style="font-size: 1.25rem; font-family: 'Imprima', sans-serif;">Saturday</div>
      </div>
      <div class="text-center px-5" style="text-align: center; padding-left: 1.25rem; padding-right: 1.25rem;">
        <div class="text-6xl" style="font-size: 5rem; font-family: 'Impact', sans-serif;">28</div>
        <div class="text-xl" style="font-size: 1.5rem; font-family: 'Imprima', sans-serif;">Jul</div>
        <div style="font-size: 1.25rem; font-family: 'Imprima', sans-serif;">Sunday</div>
      </div>
    </div>
    </div>

    <!-- Events -->
    <div class="space-y-10 px-20">
      <!-- Historical Tour -->
      <div class="pt-8"
        style="background-image: url('assets/images/Home_page_Images/Rectangle.png'); background-repeat: no-repeat; background-position: top; background-size: 100% auto;">
        <div style="height: 20px;"></div>
        <div class="text-4xl font-bold mb-4 text-white bg-black py-4" style="font-family: 'Playfair Display', serif;">A
          Stroll Through History</div>
        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-1">
            <img src="assets\images\Home_page_Images\HistoryEvent_Image_Homepage.png" alt="Historical Tour"
              class="w-full h-auto">
          </div>
          <div class="col-span-2 text-base flex items-center justify-center"
            style="font-family: 'Imprima', sans-serif; font-size: 1.6em; margin-right: 380px;">
            The event takes place every day, the hours when the tours start are always 10:00, 13:00, 16:00.
            The tours are available in multiple languages.
          </div>
        </div>
      </div>

      <div style="height: 5px;"></div>

      <!-- Food Festival -->
      <div class="pt-8"
        style="background-image: url('assets/images/Home_page_Images/Rectangle.png'); background-repeat: no-repeat; background-position: top; background-size: 100% auto;">
        <div style="height: 20px;"></div>
        <div class="text-4xl font-bold mb-4 text-white bg-black py-4" style="font-family: 'Playfair Display', serif;">
          Yummy!</div>
        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-1">
            <img src="assets\images\Home_page_Images\YummyEvent_Image_Homepage.png" alt="Food Festival"
              class="w-full h-auto">
          </div>
          <div class="col-span-2 text-base flex items-center justify-center"
            style="font-family: 'Imprima', sans-serif; font-size: 1.6em; margin-right: 380px;">
            Reservations can be made during the period of the festival at various restaurants
            across Haarlem at various hours depending on the restaurant.
          </div>
        </div>
      </div>

      <div style="height: 5px;"></div>
      <!-- Dance Event -->
      <div class="pt-8"
        style="background-image: url('assets/images/Home_page_Images/Rectangle.png'); background-repeat: no-repeat; background-position: top; background-size: 100% auto;">
        <div style="height: 20px;"></div>
        <div class="text-4xl font-bold mb-4 text-white bg-black py-4" style="font-family: 'Playfair Display', serif;">
          Dance!</div>
        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-1">
            <img src="assets\images\Home_page_Images\DanceEvent_Image_Homepage.jpg" alt="Dance Event"
              class="w-full h-auto">
          </div>
          <div class="col-span-2 text-base flex items-center justify-center"
            style="font-family: 'Imprima', sans-serif; font-size: 1.6em; margin-right: 380px;">
            The event takes place on the dates of 26, 27 and 28. Multiple artists will play
            their music at different places across Haarlem. Most of the concerts will take place in the evening and
            during the night.
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>

  <div style="height: 60px;"></div>

  <div>
    <div class="event-section">
      <img class="event-image" src="assets/images/Home_page_Images/Dexter_Image_Homepage.png" alt="Image of Dexter">

      <div class="content">
        <div class="event-title">The Secret of Professor Teyler</div>
        <div class="mobile-event" style="margin-bottom: 20px;">(mobile event)</div>
        <div class="event-description">
          Looking for a great way to keep your kids entertained?
          Join in on the excitement with The Teyler Museum's
          scavenger hunt during the festival! Get started by downloading
          the activity app—just scan the QR code to begin the adventure.
        </div>
      </div>
      <img class="qr-code" src="assets/images/Home_page_Images/QR_Image_Homepage.png" alt="QR Code">
    </div>
  <div style="height: 40px;"></div>
  <?php include __DIR__ . '/../footer.php'; ?>
    </div>
    </body>
</html>

