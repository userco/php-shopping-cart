<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
     <title><?= $title ?? 'Home' ?></title>
</head>
<body>
    <main>
        <div>
            <?php
            if (session_id()) {
                    echo "Hello " . $_SESSION['user']->name ."!";
                }
            ?>
        </div>