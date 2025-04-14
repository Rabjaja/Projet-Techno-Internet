<?php
session_start();

$pageToLoad = 'public/content/home.php';

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['username'] == 'admin') {
        header("Location: admin/content/dashboard.php");
    }
    else{
        header("Location: public/content/loged.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/index.css">
    <title>Vinyland Sanga</title>
</head>
<body>
<div id="page" class="container">

    <?php include('public/src/php/utils/header.php'); ?>

    <section>
        <?php
        include($pageToLoad);
        ?>
    </section>

    <?php include('public/src/php/utils/footer.php'); ?>

</div>
</body>
</html>
