<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

  public function __construct()
 {
    parent::__construct();
    $this->load->library('session'); // enable session
    $this->load->model('comment_model');

//   $this->load->model('user_model');


  }

  

 function index()
 {
    // $this->load->view('template/header');

 }



 function course_detail($page='course-detail-php'){

    $data['all_comment'] = $this->comment_model->get_comment();

     $this->load->view('template/header');

     $this->load->view($page, $data);

     $this->load->view('template/footer');
 }


 function add_comment($comment='') {
   $username = $this->session->userdata('username');
   $comment = $this->input->post('comment');
   if ($comment != '') {

    $data = array(
      'username'  => $username,
      'comment_content'  => $comment,
      'date_of_time'  => date("Y-m-d H:i:s")
    );

      $this->comment_model->insert($data);

      redirect('course/course_detail');

   }
 }




}