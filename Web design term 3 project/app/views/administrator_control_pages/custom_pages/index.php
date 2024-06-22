<?php
use App\Services\UserService;
use App\Services\CustomPageService;
use App\Models\User\UserRole;

$userService = new UserService();
$customPageService = new CustomPageService();

session_start();

$isAdmin = false;

if (isset($_SESSION['userRole'])) {
    $role = $_SESSION['userRole'];
    if ($role === UserRole::Admin->value) {
        $isAdmin = true;
    }
}

$customPageId = $_GET['id'];
$customPage = $customPageService->getCustomPageByID($customPageId);
$contentOfCustomPage = $customPage->content;
$titleOfCustomPage = $customPage->title;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <?php require __DIR__ . '/../../../components/general/commonDataHeaderTailwind.php'; ?>
    <style>
        #saveContent {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            margin-top: 10px;
            margin-left: 30px;
            margin-bottom: 30px;
        }

        #saveContent:hover {
            background-color: #218838;
        }

        #saveContent:active {
            background-color: #1e7e34;
        }

        #title {
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 20px;
            margin-left: 30px;
        }

        #label_title {
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 20px;
            margin-left: 30px;
        }
    </style>
</head>

<body>
    <?php require __DIR__ . '/../../../components/general/topBar.php'; ?>


    <?php if ($isAdmin): ?>
        <div id="editor">
            <br>
            <label id="label_title" for="title">Title (name of the page):</label>
            <input type="text" id="title" value="<?php echo $titleOfCustomPage ?>">
            <textarea id="summernote"><?php echo $contentOfCustomPage; ?></textarea>
            <button id="saveContent">Save</button>
        </div>
    <?php else: ?>
        <div id="content">
            <?php echo $contentOfCustomPage; ?>
        </div>
    <?php endif; ?>


    <?php include __DIR__ . '/../../../components/general/footer.php'; ?>

    <script type="text/javascript">
        const isAdmin = <?php echo json_encode($isAdmin); ?>;
        const customPageId = <?php echo json_encode($customPageId); ?>;
    </script>
    <script type="module" src="javascript/Custom_Pages/custom_page.js"></script>
</body>

</html>