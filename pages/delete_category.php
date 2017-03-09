<?php
$conn = pg_connect("host=localhost port=5432 dbname=tiki user=postgres password=123456");
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $query = "DELETE FROM category where category_id='$id'";
    $result = pg_query($query);
    header('Location: category.php');
}
?>