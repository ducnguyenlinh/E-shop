<?php
$conn = pg_connect("host=localhost port=5432 dbname=tiki user=postgres password=123456");
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $result = pg_query($conn, "SELECT category_id FROM category ORDER BY category_id DESC LIMIT 1");
    $row = pg_fetch_assoc($result);
    $id = $row['category_id'];
    $id = $id + 1;
    $result = pg_query($conn, "INSERT INTO category(category_id,category_name) 
                  VALUES('$id','$name');");
}
?>