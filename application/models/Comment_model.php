<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{

    function insert($data) {
        $this->db->insert('comment', $data); 
    }

    function get_comment() {
        $query = $this->db->get('comment');
        return $query->result();
    }

}
?>