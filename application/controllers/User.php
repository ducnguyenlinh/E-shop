<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($value='')
    {
        # code...
    }

    public function signup() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $passconfirm = $_POST['passconfirm'];

        $created_at=date('Y-m-d');
       $tmp = "INSERT INTO user_info(user_name,user_pass,user_email,user_created) VALUES ('$name','$pass','$email','$created_at')";
        // $insert_data = pg_query($conn,$tmp);
       $this->db->query($tmp);
        echo "success";
    }

    public function checklogin() {
        if($this->input->post('mail')==null)
            echo "email";
        else if (!filter_var($this->input->post('mail'), FILTER_VALIDATE_EMAIL))
            echo 'email_error';
        else if($this->input->post('pass')==null)
            echo "pass";
        else{
                $email = $this->input->post('mail');
                $pass = $this->input->post('pass');
                $sql = "SELECT * FROM user_info where user_email = '$email' AND user_pass = '$pass'";
                $result = $this->db->query($sql)->row();
                if ($result) {
                    $this->session->set_userdata('login',$result);
                    echo $result->user_id;
                }else
                    echo "null";
            }

    }

    public function logout() {
       unset($_SESSION['login']);
       // unset($_SESSION['cart']);
       $this->load->view('home/index');
    }

    public function profile($value = '') {
        
    }
    
    public function checkemail() {
        $email = $this->input->post('email');
        $sql = "SELECT user_email FROM user_info WHERE user_email = '$email'";
        $result = $this->db->query($sql)->result();
        if(count($result) > 0) echo "false";
        else echo "true";
    }
    

    public function account() {
        // if ($this->session->has_userdata('login')) {
        //     redirect('user/profile','refresh');
        // }
        // else {
            $this->load->view('user/login');
        // }
    }


}

/* End of file User.php */

/* Location: ./application/controllers/User.php */
