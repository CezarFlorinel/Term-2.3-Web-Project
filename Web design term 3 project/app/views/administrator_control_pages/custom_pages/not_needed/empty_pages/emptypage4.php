<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework Page</title>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
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
            font-size: 60px;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .section {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .section img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 18px;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        .grid-2 {
            grid-template-columns: 1fr 1fr;
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>
    <h1>Unique Page 4</h1>
    <div class="container">
        <div class="grid grid-2 section">
            <div>
                <img src="https://via.placeholder.com/400x300" alt="Placeholder Image 1">
                <h2>Dynamic Subtitle 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div>
                <img src="https://via.placeholder.com/400x300" alt="Placeholder Image 2">
                <h2>Dynamic Subtitle 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="section">
            <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 3">
            <h2>Dynamic Subtitle 3</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="grid grid-3 section">
            <div>
                <img src="https://via.placeholder.com/250x400" alt="Placeholder Image 4-1">
                <h2>Dynamic Subtitle 4</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div>
                <img src="https://via.placeholder.com/250x400" alt="Placeholder Image 4-2">
                <h2>Dynamic Subtitle 5</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div>
                <img src="https://via.placeholder.com/250x400" alt="Placeholder Image 4-3">
                <h2>Dynamic Subtitle 6</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="section">
            <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 5">
            <h2>Dynamic Subtitle 7</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>