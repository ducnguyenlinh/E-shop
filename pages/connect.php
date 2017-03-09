<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}
$conn = pg_connect("host=localhost port=5432 dbname=tiki user=postgres password=123456");
?>