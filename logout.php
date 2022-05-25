<?php
session_start();
session_destroy();
header("Location: W3S.php");
?>