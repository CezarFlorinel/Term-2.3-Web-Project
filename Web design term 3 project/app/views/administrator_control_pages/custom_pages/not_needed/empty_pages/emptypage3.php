<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework Page</title>
    <style>
        body {
            background-color: #1a202c;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 50px;
            margin: 30px 0;
        }

        .section {
            background-color: #2d3748;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .section img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 18px;
        }

        .image-grid {
            display: flex;
            justify-content: space-between;
        }

        .image-grid img {
            width: 32%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>
    <h1>Unique Page 3</h1>
    <div class="container">
        <div class="section">
            <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 1">
            <h2 class="text-green-400">Amazing Subtitle 1</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section">
            <h2 class="text-purple-400">Fascinating Subtitle 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section image-grid">
            <img src="https://via.placeholder.com/250x400" alt="Placeholder Image 2-1">
            <img src="https://via.placeholder.com/250x400" alt="Placeholder Image 2-2">
            <img src="https://via.placeholder.com/250x400" alt="Placeholder Image 2-3">
        </div>
        <div class="section">
            <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 3">
            <h2 class="text-pink-400">Inspiring Subtitle 4</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section">
            <h2 class="text-teal-400">Intriguing Subtitle 5</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>