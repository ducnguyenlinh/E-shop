<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
       if(!$this->session->has_userdata('cart')){
		$this->session->set_userdata('cart', array());

		}
    }

    function index(){

    	$this->load->view('cart/index');
    }

 	function change_quantity_cart(){
 		$key = $this->input->post('key_quantity_cart');
    	$value = $this->input->post('quantity');
 		$tmp = "SELECT quantity_in FROM book_info Where id = '$key' ";
		$row =$this->db->query($tmp)->row();
		if ($this->checkValue($value))
			if ($row->quantity_in >= $value){
	 			if(!array_key_exists($key, $_SESSION['cart'])) {
	 				$_SESSION['cart'][$key] = $value;
	 				echo "success";
	 			} else
	 				if(($_SESSION['cart'][$key]+$value)>$row->quantity_in){
	 					$quantity = $row->quantity_in - $_SESSION['cart'][$key];
	 					echo "error|".$quantity;
	 					}
	 				else {
	 					$_SESSION['cart'][$key] = $_SESSION['cart'][$key]+ $value;
	 					echo "success";
	 				}	 	
	 		}
			else {
				if(!array_key_exists($key, $_SESSION['cart']))
					echo "error1|".$row->quantity_in;
				else{
					$quantity = $row->quantity_in - $_SESSION['cart'][$key];
					echo "error2|".$quantity;
					}
			}
		else echo "format";	
 	}

 	function change_quantity(){
 		$key = $this->input->post('key_quantity');
    	$value = $this->input->post('quantity');
  		$tmp = "SELECT quantity_in FROM book_info Where id = '$key' ";
		$row =$this->db->query($tmp)->row();

	 		if ($this->checkValue($value))
		 		if ($row->quantity_in >= $value){
		 			$_SESSION['cart'][$key] = $value;
		 		}
				else {
					echo "error|".$row->quantity_in;
					$_SESSION['cart'][$key] = $row->quantity_in;
				}
			else
				echo "format|".$_SESSION['cart'][$key];
	 }
 	function remove_cart($key){
 		$key = $this->input->post('remove_cart');
 		unset($_SESSION['cart'][$key]);
 	}
 	function add_cart(){
 		$key = $this->input->post('add_cart');
 		$tmp = "SELECT quantity_in FROM book_info Where id = '$key' ";
		$row =$this->db->query($tmp)->row();
		if ($row->quantity_in > $_SESSION['cart'][$key]){
 			$_SESSION['cart'][$key] = $_SESSION['cart'][$key]+1;
 		}
		else{
		 echo "error";
 		$_SESSION['cart'][$key] = $row->quantity_in;
 		}
 	}
 	function minus_cart(){
 		$key = $this->input->post('minus_cart');
 		if($_SESSION['cart'][$key]>1)
	 		$_SESSION['cart'][$key] = $_SESSION['cart'][$key]-1;
	 	else
	 		unset($_SESSION['cart'][$key]);
 	}
 	function addItem(){
 		$key = $this->input->post('add_item');
 		 $tmp = "SELECT quantity_in,name FROM book_info Where id = '$key' ";
 		$row =$this->db->query($tmp)->row();
		
	 	if(!array_key_exists($key, $this->session->userdata('cart'))){
			if($row->quantity_in==0)
				echo "error";
			else{
				$_SESSION['cart'][$key] = 1;
			  	echo $row->name;
			}
 		}else{
 			if ($row->quantity_in > $this->session->userdata('cart')[$key]){
	 			$_SESSION['cart'][$key] ++;
				 return $row->name;
	 		}
			else echo "error";
		}
 	}

 	function checkValue($value){
		if(ctype_digit($value))
		{
		    if (intval($value)>0)
		    	return true;
		    else
		    	return false;
		}
		else return false;
 	} 
}