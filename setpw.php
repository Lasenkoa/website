<html lang="en">

<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="absolute-Center">
    <div>
    <form action="setpw.php" method="post">
        <h1>Create new password</h1>
        <input type="password" name="pwd" placeholder="   Password" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.35);" required><br><br>
        <input type="password" name="pwd2" placeholder="   Repeat Password" required><br><br>
        <button type="submit" name="submit" style="background-color: #20DF7F">Submit</button><br><br>
        <a href="W3S.php" style="font-size: 15px;">Return to Homepage</a>
    </form><br>
    <?php
    if (isset($_GET["token"])) {
        $stmt = $mysql->prepare("SELECT * FROM logindaten WHERE TOKEN = :token"); //Username überprüfen
        $stmt->bindParam(":token", $_GET["token"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count != 0) {
            if (isset($_POST["submit"])) {
                if ($_POST["pwd"] == $_POST["pwd2"]) {
                    $hash = password_hash($_POST["pwd"], PASSWORD_BCRYPT);
                    $stmt = $mysql->prepare("UPDATE logindaten SET PASSWORD = :pwd, TOKEN = null WHERE TOKEN = :token");
                    $stmt->bindParam(":pwd", $_POST["pwd"]);
                    $stmt->bindParam(":token", $_GET["token"]);
                    $stmt->execute();
                    echo "Password has been changed.";
                } else {
                    echo "Passwords do not match!";
                }
            }
        } else {
            echo "Token expired!";
        }
    } else {
        echo "Invalid Token!";
    }
    ?>
    </div>
</body>

</html>