<?php
$conn = pg_connect("host=localhost port=5432 dbname=tiki user=postgres password=123456");
if (isset($_POST["id"]) && isset($_POST['status'])) {
    $id = $_POST["id"];
    $status = $_POST['status'];

    if ($status == "1") {
        $query = "UPDATE order_info SET status = 2 where order_id='$id'";
        $result = pg_query($query);
    }
    if ($status == "2") {
        $query = "UPDATE order_info SET status = 1 where order_id='$id'";
        $result = pg_query($query);
    }
}
?>

