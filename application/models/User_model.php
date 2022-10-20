<!-- tutorial from https://www.youtube.com/watch?v=7k19ASx6frQ -->
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

    public function get_user($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('codeigniter_register');
        return $query->row();
    }


    public function update_name($id, $new_name) {
        $query=$this->db->query("UPDATE codeigniter_register 
        SET name='$new_name' 
        WHERE id='$id'");
    }

    public function update_password($id, $new_password) {
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $query = $this->db->query("UPDATE codeigniter_register 
        SET password='$hash' 
        WHERE id = '$id'");
    }
}
?>