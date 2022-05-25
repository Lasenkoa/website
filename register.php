<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/favicon.ico" />
    <title>Registrierung</title>
</head>

<header>

</header>

<body class="absolute-Center">
    <div>
        <h1 style="font-size: 60px">Become a Member</h1>
        <p><b>Register and use all advantages!</b></p><br>

        <form class="absolute-Center;" action="register.php" method="post">
            <input type="text" name="username" placeholder="   Username" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.35);" required><br><br>
            <input type="text" name="email" placeholder="   E-MAIL" required><br><br>
            <input type="password" name="pwd" placeholder="   Password" required><br><br>
            <input type="password" name="pwd2" placeholder="   Repeat Password" required><br><br>
            <button type="submit" name="submit" style="background-color: #20DF7F">Create Account</button><br><br>
            <a href="W3S.php" style="font-size: 15px;">Already registered?</a>
        </form><br>

        <?php
        if (isset($_POST["submit"])) {
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM logindaten WHERE USERNAME = :user"); //Username überprüfen
            $stmt->bindParam(":user", $_POST["username"]);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 0) {
                // Username ist frei
                $stmt = $mysql->prepare("SELECT * FROM logindaten WHERE EMAIL = :email"); //Username überprüfen
                $stmt->bindParam(":email", $_POST["email"]);
                $stmt->execute();
                $count = $stmt->rowCount();
                if ($count == 0) {
                    if ($_POST["pwd"] == $_POST["pwd2"]) {
                        // User anlegen
                        $stmt = $mysql->prepare("INSERT INTO logindaten (USERNAME, PASSWORD, EMAIL, TOKEN) VALUES (:username, :pwd, :email, null)");
                        $stmt->bindParam(":username", $_POST["username"]);
                        $hash = password_hash($_POST["pwd"], PASSWORD_BCRYPT);
                        $stmt->bindParam(":pwd", $hash);
                        $stmt->bindParam(":email", $_POST["email"]);
                        $stmt->execute();
                        echo "Registration successfull!";
                    } else {
                        echo "Passwords do not match!";
                    }
                }  else {
                    echo "Email already taken!";
                }
            } else {
                echo "Username already taken!";
            }
        }
        ?>

    </div>


</body>


<footer>
</footer>

</html>