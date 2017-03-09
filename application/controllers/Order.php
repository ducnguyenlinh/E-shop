<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

   function history($id=""){
        $sql = "select * from order_info where user_id = '$id'";
        $data['user'] = $this->db->query($sql)->result();
        $this->load->view('order/order-lists',$data);
    }
    function details($id=""){
        $sql = "select * from order_info where order_id = '$id'";
        $data['user'] = $this->db->query($sql)->row();

        $city_id = $data['user']->city;
        $sql = "select * from city where id = '$city_id'";
        $data['city'] = $this->db->query($sql)->row();

        $district_id = $data['user']->district;
        $sql = "select * from district where id = '$district_id'";
        $data['district'] = $this->db->query($sql)->row();

        $this->load->view('order/order-details',$data);
    }
    function delete(){
        $id = $this->input->post('order');
        $sql = "delete from order_item where order_id='$id'";
        $result = $this->db->query($sql);
        echo $this->session->userdata('login')->user_id;
    }
    function checkout(){
        $this->load->view('order/checkout');
    }
    function buy(){
    $city = $this->input->post('city');
    $district = isset($_POST['district'])? $_POST['district'] : 0;
    $address = $this->input->post('address');
    $receiver = $this->input->post('receiver');
    $phone = $this->input->post('phone');
    $total = $_SESSION['sum'];

    $_SESSION['city'] = $city;
    $_SESSION['district'] = $district;
    $_SESSION['address'] = $address;
    $_SESSION['receiver'] = $receiver;
    $_SESSION['phone'] = $phone;

    if(empty($_SESSION['cart'])){
        echo "null";
    }
    else if(!isset($_SESSION['login']))
        echo "login";
    else if($_POST['city']=="-----")
        echo "city";
    else if($_POST['district']=="0")
        echo "district";
    else if($_POST['address']==null)
        echo "address";
    else if($_POST['receiver']==null)
        echo "receiver";
    else if($_POST['phone']==null)
        echo "phone";
    else
        {
            $id = $this->session->userdata('login')->user_id;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $created_at=date('Y-m-d');

            $check = true;

            foreach ($_SESSION['cart'] as $key => $value) {
                $tmp = "SELECT quantity_in, name FROM book_info Where id = '$key' ";
                $row = $this->db->query($tmp)->row();
                if ($row->quantity_in < $value){
                    echo "error|".$row->name."|".$row->quantity_in;
                    $check = false;
                    break;
                }
            }

            if ($check){
                $tmp = "INSERT INTO order_info(user_id, order_created, city, district, address, receiver, phone,status,total) VALUES ('$id','$created_at','$city','$district','$address','$receiver','$phone',1,'$total')";
                $insert = $this->db->query($tmp);

                $tmp1 = "select order_id from order_info order by order_id desc limit 1";
                $row = $this->db->query($tmp1)->row();

                $order_id = $row->order_id;
                foreach ($_SESSION['cart'] as $key => $value) {
                        $tmp2 = "INSERT INTO order_item(order_id, item_id, quantity) VALUES ('$order_id','$key', '$value')";
                        $insert_data = $this->db->query($tmp2);

                }
                unset($_SESSION['cart']);
                echo $order_id;
                unset($_SESSION['city']);
                unset($_SESSION['district']);
                unset($_SESSION['address']);
                unset($_SESSION['receiver']);
                unset($_SESSION['phone']);
            }
        }
    }

    function quan(){

    $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : 0;

    $command = isset($_POST['get']) ? $_POST['get'] : "";

    switch ($command) {
        case 'city':
            $statement = "SELECT id, ten FROM city";
            break;
            
        case 'district':
            $statement = "SELECT id, ten FROM district WHERE id_city='$cityId'";
            break;

        default:
            break;
    }
    $result = $this->db->query($statement)->result();

    echo json_encode($result);
    exit();
    }
}