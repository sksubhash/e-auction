<?php
session_start();

unset($_SESSION['ID']);
unset($_SESSION['TYPE']);

header("location:../index.php");
?>