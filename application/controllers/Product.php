<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
    function __construct(){ 
            parent::__construct(); 
            $this->load->model('Product_Model'); 
        } 

    public function index($category = "", $sortby = "view", $sorttype = "desc") {

        $this->load->library('pagination'); 
        // kiem tra ton tai
        if ($this->db->query("SELECT * FROM category WHERE category_link = '$category'")->num_rows() != 1) {
            redirect('/', 'refresh');
        }
        // if ($sub_category != "all") {

        //     //$r = $this->db->query("SELECT * FROM category WHERE category_url = '$category' AND category_level = 0")->result();
        //     if ($this->db->query("SELECT * FROM category WHERE category_url = '$sub_category' AND category_level = 1")->num_rows() != 1) {
        //         redirect('/', 'refresh');
        //     }
        // }

        $sql = "SELECT * FROM category WHERE category_link = '$category'";
        $result = $this->db->query($sql)->result();
        $data['category'] = $result[0];


        // $prev = $data['category']->category_id;
        // if ($sub_category != "all") {
        //     $sql = "SELECT * FROM category WHERE category_level = 1 AND category_url = '$sub_category'";
        //     $result = $this->db->query($sql)->result();
        //     $data['this_category'] = $result[0];
        // }
        // else {
        //     $data['this_category'] = $object = json_decode(json_encode(array('category_title' => "Tất cả", 'category_url' => "all")), FALSE);
        // }
        // $sql = "SELECT * FROM category WHERE category_level = 1 AND category_prev = $prev";
        // $data['sub_category'] = $this->db->query($sql)->result();
        // $data['this_sub_category'] = $sub_category;
        // $data['sort_by'] = $sortby;
        // $data['sort_type'] = $sorttype;

        // cấu hình phân trang 
            $config['base_url'] = base_url('/product/'.$category); // xác định trang phân trang 
            $config['total_rows'] = $this->Product_Model->count_all($data['category']->category_id); // xác định tổng số record 
            $config['per_page'] = 8; // xác định số record ở mỗi trang 
            // $config['uri_segment'] = 2; // xác định segment chứa page number 

            //chỉnh sửa giao diên
            // $config['num_links'] = 3;

            $config['full_tag_open'] = '<div class="pagination" style="width:100%"><ul>';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';

            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            ///////
            $this->pagination->initialize($config); 
            $data['book_info'] = $this->Product_Model->list_all($data['category']->category_id,$config['per_page'],$this->uri->segment(3)); 

        $this->load->view('product/index', $data);
    }

    public function details($product = '') {
        // $this->load->model('frontend/product_model');

        $sql = "SELECT *,category_link,category_name FROM category natural join book_info WHERE book_link = '$product'";
        $result = $this->db->query($sql)->result();
        $data['book'] = $result[0];
        $this->load->view('product/details', $data);
    }

    public function author($author_link){
        $sql = "SELECT author, id, image,price, name,category_name, category_id,book_link,category_link,quantity_in FROM book_info natural join category WHERE author_link = '$author_link'";
        $result = $this->db->query($sql)->result();
        $data['book'] = $result;

        $sql1 = "SELECT author FROM book_info WHERE author_link = '$author_link'";
        $data['author'] = $this->db->query($sql1)->row();

        $this->load->view('product/author', $data);
    }

    public function search() {
        $this->load->helper('string_helper');
        $this->load->helper('text');
        // $this->load->model('frontend/product_model');
        if (isset($_GET['key'])) {
            $value = string_short(convert_accented_characters(trim($_GET['key'])));
            $value_2 = trim($_GET['key']);
            $data['value'] = $value;
        }
        else {
            $value = $value_2 = "ESHOP";
        }
        $sql = "SELECT * FROM book_info natural join category WHERE book_link LIKE '%$value%' OR name LIKE '%$value_2%' ORDER BY view DESC LIMIT 10";
        $data['book'] = $this->db->query($sql)->result();
        $this->load->view('product/search', $data);
    }
}

/* End of file Product.php */

/* Location: ./application/controllers/Product.php */
