<head>
    <?php session_start();
    use App\Models\User\UserRole;


    if (isset($_SESSION['userRole']) && $_SESSION['userRole'] !== UserRole::Admin->value) {
        header('Location: /');
        exit();
    }

    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2/dist/purify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="/CSS_files/js_custome_alert.css">
    <link rel="icon" type="image/png" href="/assets/images/Logos/H.png">

</head>