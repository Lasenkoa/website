<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/favicon.ico" />
    <title>Document</title>
</head>

<body class="absolute-Center">
    <div>
    <form action="forgotpw.php" method="post">
        <h1>Create new password</h1>
        <input type="text" name="email" placeholder="   E-Mail" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.35);" required><br><br>
        <button type="submit" name="submit" style="background-color: #20DF7F">Reset Password</button><br><br>
        <a href="W3S.php" style="font-size: 15px;">Return to Homepage</a>
    </form><br>

    <?php
    if (isset($_POST["submit"])) {
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM logindaten WHERE EMAIL = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count != 0) {
            $token = generateRandomString(25);
            $stmt = $mysql->prepare("UPDATE logindaten SET TOKEN = :token WHERE EMAIL = :email");
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            mail($_POST["email"], "Reset Password", "localhost/setpw.php?token" . $token);
            echo "Email sent.";
        } else {
            echo "Email does not exist.";
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>
</div>
</body>

</html>