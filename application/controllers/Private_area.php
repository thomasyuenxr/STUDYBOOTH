<!-- code from https://www.webslesson.info/2018/10/user-registration-and-login-system-in-codeigniter-3.html#comment-form -->


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Private_area extends CI_Controller {
 public function __construct()
 {
  parent::__construct();
  if(!$this->session->userdata('id'))
  {
   redirect('login');
  }
 }

    function index()
    {
     $this->load->view('template/header');
//   echo '<br /><br /><br /><h1 align="center">Welcome User</h1>';
//   echo '<p align="center"><a href="'.base_url().'private_area/logout">Logout</a></p>';

        $this->load->view('course');
        
 




    
        $this->load->view('template/footer');


    }

 function logout()
 {
  $data = $this->session->all_userdata();
  foreach($data as $row => $rows_value)
  {
   $this->session->unset_userdata($row);
  }
  redirect('login');
 }
}

?>