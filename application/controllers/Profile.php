<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent:: __construct();
        $this->load->library('session');
        $this->load->model('user_model'); 
    }

    function index() {

        $user_id = $this->session->userdata('id');

        $data['user'] = $this->user_model->get_user($user_id);

        $this->load->view('template/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('template/footer', $data);
    }


    function name_update_page() {
        
        $this->load->view('template/header');
        $this->load->view('name_update');
        $this->load->view('template/footer');

    }

    function update_name() {
        $update_name = $this->input->post('new_name');

        $user_id = $this->session->userdata('id');

        $query = $this->user_model->update_name($user_id, $update_name);

        redirect('profile');


    }
}


?>