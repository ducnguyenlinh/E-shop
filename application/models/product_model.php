<?php 
    class Product_Model extends CI_Model{ 
        // lấy dữ liệu theo từng phần 
        function list_all($id,$number, $offset){ 
            // $query =  $this->db->get('category',$number,$offset); 
            $query =  $this->db->get_where('book_info', array('category_id' => $id), $number, $offset);
            return $query->result(); 
        } 
         
        // đếm tổng số record trong table book 
        function count_all($id){ 
            return $this->db->get_where('book_info', array('category_id' => $id))->num_rows(); 
        } 
    } 
?>