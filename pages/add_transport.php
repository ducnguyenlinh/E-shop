<?php 
	if(isset($_POST['order_id']))
		sendOrder($_POST['order_id']);
function sendOrder($order_id){
		$conn = pg_connect("host=localhost port=5432 dbname=tiki user=postgres password=123456");

		$sql = "UPDATE order_info set status=2 where order_id=$order_id";
		$result2 = pg_query($conn, $sql);
		echo "success";
}
 ?>