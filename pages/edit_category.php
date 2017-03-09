<?php
$conn = pg_connect("host=localhost port=5432 dbname=tiki user=postgres password=123456");
if (isset($_POST["id"]) && isset($_POST['new_name'])) {
    $id = $_POST["id"];
    $name = $_POST['new_name'];
    $query = "UPDATE category SET category_name ='$name' where category_id='$id'";
    $result = pg_query($query);
}
?>

