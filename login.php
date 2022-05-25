<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: W3S.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/favicon.ico" />
    <link rel="stylesheet" href="mystyle.css">

    <title>Yoinkmania!</title>

    <style>

    </style>

</head>

<body class="absolute-Center">
    <div>
        <h1>Good Day <?php echo $_SESSION['username']; ?>!</h1>
    <p>No content here yet.</p><br>
    <a href="logout.php">Logout</a>
    </div>
</body>

</html>