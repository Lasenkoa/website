<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="mystyle.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="./images/favicon.ico" />
  <title>Login Webseite</title>
</head>

<header>
</header>

<body class="absolute-Center">

  <div>
    <h1 style="font-size: 60px;">Sign in</h1>
    <p><b>Sign in and start managing your candidates!</b></p><br>
    <form action="W3S.php" method="post">

      <!-- Beginn der Felder für die Anmeldung -->
      <input type="text" name="username" placeholder="   Username" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.35);" required><br><br><br> <!-- Input Username -->
      <input type="password" name="pwd" placeholder="   Password" required><br><br> <!-- Input Password-->

      <!-- Bereich für checkbox um Benutzernamen zu speichern -->
      <label class="container">
        <p style="font-size: 15px; float: left;">Remember me</p> <!-- Text zur Speicherung -->
        <input type="checkbox"><span class="checkmark"></span> <!-- Kästchen -->
      </label>

      <a href="forgotpw.php" style="margin-left: 30px; ">Forgot Password?</a><br><br> <!-- Passwort vergessen Link -->
      <button type="submit" name="submit" style="background-color: #20DF7F">Login</button><br><br> <!-- Absendebutton -->
      
      <?php
      if (isset($_POST["submit"])) { // wenn die Vermittlung mit type=submit getätigt wird
        require("mysql.php"); // mysql.php abfragen
        $stmt = $mysql->prepare("SELECT * FROM logindaten WHERE USERNAME = :user"); //Username überprüfen
        $stmt->bindParam(":user", $_POST["username"]); // Parameter username zu user festlegen, um Änderungen in der Datenbank zu vermeiden
        $stmt->execute(); // stmt ausführen
        $count = $stmt->rowCount();  // stmt-Reihen zählen
        if ($count == 1) { // Wenn Username übereinstimmen
          $row = $stmt->fetch(); // Daten aus der Datenbank einholen
          if (password_verify($_POST["pwd"], $row["PASSWORD"])) { // Passwörteingabe mit Eintrag in Datenbank vergleichen
            session_start();
            $_SESSION["username"] = $row["USERNAME"]; // Sitzung mit dem eingegebenen Usernamen führen
            header("Location: login.php"); // Weiterleiten an login.php
          } else {
            echo "Login failed. Wrong password!"; // Falsches Passwort
          }
        } else {
          echo "Login failed. User unknown!"; // Benutzer unbekannt
        }
      }
      ?>

      <p>Become a member!</p> <!-- Registrierung -->
      <a href="register.php" style="font-size: 20px;">Register</a> <!-- Link Registrierung -->

    </form>
  </div>
</body>

<footer>
</footer>

</html>