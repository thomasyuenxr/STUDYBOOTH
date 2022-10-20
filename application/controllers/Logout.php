<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct() {
        parent:: __construct();
        $this->load->library('session');
    }

    function index() {
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value)
        {
        $this->session->unset_userdata($row);
        }
		redirect('welcome'); // redirect user back to index
    }
}


?>