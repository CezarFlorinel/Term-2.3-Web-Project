<!-- What is there to do? -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harlem Festival</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .event-bg {margin-left: 50px; margin-right: 50px;}
         body { background-color: #000; }
        .fest-bg { background-color: #333; }
        .section-bg { background-color: #000; }
        .schedule-bg { background-color: #222; }
        .event-bg { background-color: #fff; }
        .text-gold { color: #000; }
        .text-dim-white { color: rgba(255, 255, 255, 0.7); }
    </style>
</head>

<body class="antialiased font-'Open Sans'">
<?php include __DIR__ . '/../header.php';

// Initialize the repository
$repository = new App\Repositories\userRepository();

// Fetch users
$users = $repository->getUsers();
?>

<!DOCTYPE html>
<html>
<head>
<style>
    body {
        background-color: black;
        color: white;
        font-family: 'Playfair Display', serif;
        margin: 0;
        padding-top: 100px; /* This adds vertical space at the top */
    }

    .word-container {
        display: flex;
        justify-content: flex-start; /* Align to the left */
        margin-left: 50px; /* Adjust if more space is needed from the left edge */
    }

    .word-vertical {
        display: flex;
        flex-direction: column;
        font-size: 50px; /* Larger font size */
        margin-right: 20px; /* Horizontal margin between HAARLEM and FESTIVAL */
    }

    .word-vertical div {
        margin-bottom: 5px; /* Vertical margin between each letter */
    }

    .haarlem {
        color: white;
    }

    .festival {
        color: purple;
        font-family: 'Vampiro One', cursive;
    }

    .banner {
        position: absolute;
        right: 10%;
        top: 50%;
        transform: translate(0, -50%) rotate(12deg);
        background-color: red;
        color: white;
        padding: 8px 32px;
        font-size: 24px;
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display|Vampiro+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class ="word-container">
        <div class ="word-vertical haarlem" style= "margin-left: 120px; margin-top: 30px;">
            <div>H</div>
            <div>A</div>
            <div>A</div>
            <div>R</div>
            <div>L</div>
            <div>E</div>
            <div>M</div>
        </div>
        <div class="word-vertical festival" style= "margin-left: 60px; margin-top: 30px;">
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
    <div class="banner">
        Let The Fun Begin
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
    <main>
    <section class="section-bg py-10 px-10">
    <div class="text-center mb-8 text-white">
        <h2 class="text-6xl font-bold">WHAT IS THERE TO DO?</h2>
        <div class="flex items-center justify-center" style="background: url('assets/images/elements/Union.png') no-repeat center center; background-size: contain; margin-left: 50px; margin-right: 50px; min-height: 300px;">
            <p style="font-size: 1.4em; font-weight: normal; color: black; border-radius: 10px;">
                Indulge in Haarlem's vibrant tapestry—immerse in cultural marvels within museums and iconic windmills, 
                savor the city's culinary delights, and let kids revel in a mobile event tied to the Taylers Museum. 
                For the night owls, "Dance" beckons with lively hotspots. Discover history, flavors, family fun, 
                and nightlife in this captivating city—a blend of past, present, and endless possibilities.</p>
        </div>
    </div>
    <div class="container mx-auto grid grid-cols-1 gap-4"></div>
</section>
</main>

        <div class="container mx-auto grid grid-cols-1 gap-4">
       
<style>
  .event-bg {
    background-color: white;
    border-radius: 8px;
    padding: 10px;
    max-width: 1300px;
    margin: 20px auto; /* Added space for the tilt effect */
    display: flex;
    align-items: center;
    justify-content: space-between;
    transform: rotate(-3deg); /* Tilts the section */
    overflow: hidden; /* Ensures nothing spills outside the border */
  }

  .image-container {
    flex: 1;
    max-width: 50%;
    margin-left: 150px;
  }

  .image-round {
    width: 100%;
    height: auto;
    border-radius: 8px;
  }

  .content-container {
    flex: 1;
    padding: 20px;
  }

  .text-gold {
    /* your existing styles for text-gold */
  }

  .text-gray-600 {
    /* your existing styles for text-gray-600 */
  }

  .btn {
    display: block;
    width: 100%;
    text-align: center;
    padding: 10px 20px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    margin-top: 15px;
  }

  .btn-red {
    background-color: #e53e3e; /* TailwindCSS red-600 */
  }

  .btn-blue {
    background-color: #3182ce; /* TailwindCSS blue-500 */
  }

  .btn-yellow {
    background-color: #ecc94b; /* TailwindCSS yellow-400 */
  }
</style>

   <!-- Dance -->
        <div class="event-bg rounded-lg p-6 flex items-center justify-between" style="background-color: white; padding: 10px; max-width: 1300px; margin: auto;">
    <div style="flex: 1; max-width: 50%;">
        <img class = "image-round" src="assets/images/Home_page_Images/Dance_Image_Homepage.png" 
             alt="A vibrant dance event with people enjoying music and performances" 
             class="rounded-lg" 
             style="width: 100%; height: auto; max-width: 50%; margin-left: 150px;">
    </div>
    <div style="flex: 1; padding: 20px; margin-right: 250px;">
        <h3 class="text-gold text-2xl font-bold mt-4">Dance!</h3>
        <p class="text-gray-600 mt-2">If you are a music enthusiast, Haarlem is THE PLACE for YOU!
        With lots of bars and music venues, you can find any kind of music you might like: from the 
        best techno parties to live bands playing jazz and songwriter’s concerts.
        Suitable for young adults, families and people with special needs, Haarlem has a place for everyone!</p>
        <a href="#" class="bg-red-500 text-white py-2 px-20 rounded" style="display: block; width: 100%; margin-top: 15px; text-align: center;">Learn More</a>
    </div>
</div>

   <!-- Food -->
            <div class="event-bg rounded-lg p-6 flex items-center justify-between" style="background-color: white; padding: 10px; max-width: 1300px; margin: auto;">
    <div style="flex: 1; max-width: 50%;">
        <img src="assets\images\Home_page_Images\Yummy_Image_Homepage.png" 
             alt="A vibrant dance event with people enjoying music and performances" 
             class="rounded-lg" 
             style="width: 100%; height: auto; max-width: 50%; margin-left: 150px;">
    </div>
    <div style="flex: 1; padding: 20px; margin-right: 250px;">
        <h3 class="text-gold text-2xl font-bold mt-4">Yummy!</h3>
        <p class="text-gray-600 mt-2">
                    Discover the hidden gems of Haarlem's vibrant culinary scene as we bring you a feast for the senses. 
                    While Haarlem may not be a global culinary icon, our city is home to a diverse array of restaurants that are sure to captivate 
                    your taste buds. Dive into a world of gastronomic delights, where each bite tells a unique story.</p>
                    <a href="#" class="bg-blue-500 text-white py-2 px-20 rounded" style="display: block; width: 100%; margin-top: 15px; text-align: center;">Learn More</a>
    </div>
</div>

  <!-- History -->
<div class="event-bg rounded-lg p-6 flex items-center justify-between" style="background-color: white; padding: 10px; max-width: 1300px; margin: auto;">
    <div style="flex: 1; max-width: 50%;">
        <img src="assets\images\Home_page_Images\History_Image_Homepage.png" 
             alt="A vibrant dance event with people enjoying music and performances" 
             class="rounded-lg" 
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
                    <a href="#" class="bg-yellow-500 text-white py-2 px-20 rounded" style="display: block; width: 100%; margin-top: 15px; text-align: center;">Learn More</a>
    </div>
</div>

<div style="height: 20px;"></div>
</html>

<div style="height: 20px;"></div>
<div style="height: 20px;"></div>

<!-- Festival Location -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Festival Location</title>
<style>
  .festival-location-section {
    border-radius: 8px;
    padding: 24px;
    margin-left: 50px;
    margin-right: 50px;
    display: flex;
    align-items: center;
    background-color: black; /* Adjust the background color if needed */
  }
  .info-box {
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
  border-top-right-radius: 0; /* Make top right corner flat */
  border-bottom-right-radius: 0; /* Make bottom right corner flat */
  padding: 24px;
  background-color: #FDF7D9; /* Dark yellow background */
  flex: 1; /* Takes up remaining space */
  color: black; /* Text color changed to black */
  margin-right: -24px; /* Adjust so it touches the image */
}
  .info-box h2 {
    margin-top: 0;
    color: black; /* Ensuring the heading is also black */
  }
  .btn {
    display: inline-block;
    text-decoration: none;
    padding: 10px 20px;
    background-color: red; /* Button color changed to red */
    color: white;
    border-radius: 5px;
    margin-top: 10px;
  }
  .btn:hover {
    background-color: darkred; /* Darker red on hover */
  }
  iframe {
    border-radius: 8px;
    width: 600px; /* Fixed width for the image */
    height: 400px; /* Fixed height for the image */
    border: none; /* Removes the default border */
  }

  /* ------------------------ */
  .right-aligned-text {
  text-align: right;
  color: white;
  background-color: black;
  width: 100%; /* or the width you desire */
  height: 100px; /* or the height you desire */
  display: flex;
  align-items: center; /* This centers the text vertically */
  justify-content: flex-end; /* This aligns the text to the right */
  padding-right: 60px; /* Adjust the padding to ensure the text doesn't touch the edges */
  font-family: 'Playfair Display', serif; /* Specify the font you want to use */
  font-size: 50px; /* Adjust the font size as needed */
}
</style>
</head>
<body>

<div class="right-aligned-text">
  WHERE IS THE FESTIVAL?
</div>

<div class="festival-location-section">
  <div class="info-box">
    <!-- <h2>WHERE IS THE FESTIVAL?</h2> -->
    <p>Discover the magic of The Festival in the vibrant city of Haarlem, 
        nestled to the west of Amsterdam and north of The Hague. 
        The festival takes place across the entire city of Haarlem, but most noticeably in the center. 
        Join us for an unforgettable experience!</p>
        <a href="#" class="btn" style="padding: 0.5rem 1rem; width: 50%; margin-left: 180px; font-size: 0.9rem;">Check festival schedule</a>
  </div>

  <div>
    <!-- Replace the src attribute's value with the actual path to your image -->
    <iframe src="assets/images/Home_page_Images/Map_Image_Homepage.png" frameborder="0"></iframe>
  </div>
</div>

</body>
</html>

<div style="height: 20px;"></div>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Schedule</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
<style>
@import url('https://fonts.googleapis.com/css?family=Playfair+Display&display=swap');

.font-sans {
    font-family: 'Playfair Display', serif;
    background-color: black;
    color: white;
    padding-top: 2.5rem; /* 40px */
    padding-bottom: 2.5rem; /* 40px */
}

.text-center {
    text-align: center;
    margin-bottom: 2.5rem; /* 40px */
}

.text-4xl {
    font-size: 2.5rem; /* Adjusted to 40px */
    letter-spacing: 0.1em; /* Added spacing between letters */
}
</style>
</head>
<body>

<div class="font-sans">
  <div class="text-center text-5xl">
    SCHEDULE OF THE EVENTS
  </div>
</div>

  <!-- Dates -->
  <div class="flex justify-around space-x-10 mb-10" style="display: flex; justify-content: space-around; margin-bottom: 2.5rem;">
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
    <div class="pt-8" style="background-image: url('assets/images/Home_page_Images/Rectangle.png'); background-repeat: no-repeat; background-position: top; background-size: 100% auto;">
    <div style="height: 20px;"></div>
    <div class="text-4xl font-bold mb-4 text-white bg-black py-4" style="font-family: 'Playfair Display', serif;">A Stroll Through History</div>
      <div class="grid grid-cols-3 gap-4">
        <div class="col-span-1">
          <img src="assets\images\Home_page_Images\HistoryEvent_Image_Homepage.png" alt="Historical Tour" class="w-full h-auto">
        </div>
        <div class="col-span-2 text-base flex items-center justify-center" style="font-family: 'Imprima', sans-serif; font-size: 1.6em; margin-right: 380px;">
          The event takes place every day, the hours when the tours start are always 10:00, 13:00, 16:00. 
          The tours are available in multiple languages.
        </div>
      </div>
    </div>
    
    <div style="height: 5px;"></div>
    <!-- Food Festival -->
    <div class="pt-8" style="background-image: url('assets/images/Home_page_Images/Rectangle.png'); background-repeat: no-repeat; background-position: top; background-size: 100% auto;">
    <div style="height: 20px;"></div>
    <div class="text-4xl font-bold mb-4 text-white bg-black py-4" style="font-family: 'Playfair Display', serif;">Yummy!</div>
      <div class="grid grid-cols-3 gap-4">
        <div class="col-span-1">
          <img src="assets\images\Home_page_Images\YummyEvent_Image_Homepage.png" alt="Food Festival" class="w-full h-auto">
        </div>
        <div class="col-span-2 text-base flex items-center justify-center" style="font-family: 'Imprima', sans-serif; font-size: 1.6em; margin-right: 380px;">
          Reservations can be made during the period of the festival at various restaurants 
          across Haarlem at various hours depending on the restaurant.
        </div>
      </div>
    </div>

    <div style="height: 5px;"></div>
    <!-- Dance Event -->
    <div class="pt-8" style="background-image: url('assets/images/Home_page_Images/Rectangle.png'); background-repeat: no-repeat; background-position: top; background-size: 100% auto;">
    <div style="height: 20px;"></div>
    <div class="text-4xl font-bold mb-4 text-white bg-black py-4" style="font-family: 'Playfair Display', serif;">Dance!</div>
      <div class="grid grid-cols-3 gap-4">
        <div class="col-span-1">
          <img src="assets\images\Home_page_Images\DanceEvent_Image_Homepage.jpg" alt="Dance Event" class="w-full h-auto">
        </div>
        <div class="col-span-2 text-base flex items-center justify-center" style="font-family: 'Imprima', sans-serif; font-size: 1.6em; margin-right: 380px;">
          The event takes place on the dates of 26, 27 and 28. Multiple artists will play 
          their music at different places across Haarlem. Most of the concerts will take place in the evening and during the night.
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<div style="height: 60px;"></div>

<!-- Teylor Museum -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Secret of Professor Teyler</title>
<style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #f3f3f3; /* Light grey background for the whole page */
  }

  .event-section {
    background-color: white; /* White background for the section */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-family: 'Comic Sans MS', 'Comic Neue', sans-serif; /* This is a playful font that might match the style */
    padding: 40px; /* Increased padding for more vertical space */
    margin: 20px; /* Adds margin for some space from the edges of the viewport */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional: adds a subtle shadow for depth */
    border-radius: 10px; /* Optional: rounds the corners of the section */
  }

  .event-title {
    font-size: 48px;
    color: red;
  }

  .mobile-event {
    font-size: 32px;
    color: red;
    font-style: italic;
  }

  .event-description {
    font-size: 24px;
  }

  .event-image, .qr-code {
    width: 250px; /* Increased size of images */
    height: auto;
    margin: 0 20px; /* Adds horizontal spacing around the images */
  }

  /* Ensure the content is centered */
  .content {
    color: black;
    flex-grow: 2; /* Allows the content to grow and fill the space for better centering */
    padding: 0 40px; /* Adds padding to the left and right of the content */
  }
</style>
</head>
<body>

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

</body>
</html>

<div style="height: 20px;"></div>
<div style="height: 20px;"></div>

<?php include __DIR__ . '/../footer.php';?>
</body>
</html>
