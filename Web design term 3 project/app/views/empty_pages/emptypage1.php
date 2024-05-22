<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework Page</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 2800px;
        }
        header, footer {
            background-color: #333;
            width: 100%;
            /* padding: 10px 20px; */
        }
        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }
        .section {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid white;
            border-radius: 10px;
            width: 100%;
        }
        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .three-images .image-container {
            display: flex;
            justify-content: space-between;
        }
        .three-images .image-container img {
            width: 32%;
        }
        h2 {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            color: white;
            cursor: pointer;
        }
        .button.red { background-color: red; }
        .button.blue { background-color: blue; }
        .button.yellow { background-color: yellow; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../header.php'; ?>
    <div class="container">
        <div class="section">
            <div class="image-container">
                <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 1">
            </div>
            <h2>Subtitle 1</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section">
            <h2>Subtitle 2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section three-images">
            <div class="image-container">
                <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 3-1">
                <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 3-2">
                <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 3-3">
            </div>
            <h2>Subtitle 3</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section">
            <div class="image-container">
                <img src="https://via.placeholder.com/800x400" alt="Placeholder Image 4">
            </div>
            <h2>Subtitle 4</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="section">
            <h2>Subtitle 5</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>

