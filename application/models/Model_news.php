<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_news extends CI_Model 
{
    public function get_news_data()
    {
        $query = $this->db->query("SELECT * from tbl_news ORDER BY news_id DESC");
        return $query->result_array();
    }

    public function get_news_data_order_by_heading()
    {
        $query = $this->db->query("SELECT * from tbl_news ORDER BY heading ASC");
        return $query->result_array();
    }

    public function get_news_detail($id) {
    	$sql = 'SELECT * FROM tbl_news WHERE news_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    public function get_total_news()
    {
        $sql = "SELECT * FROM tbl_news ORDER BY news_id DESC";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    public function fetch_books($limit, $start) {
        $this->db->select('*');
        $this->db->from('tbl_news');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_news_category()
    {
        $query = $this->db->query("SELECT * from tbl_news_category ORDER BY category_name ASC");
        return $query->result_array();
    }
}