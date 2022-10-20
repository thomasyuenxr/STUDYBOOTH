<!-- code from https://www.webslesson.info/2018/10/user-registration-and-login-system-in-codeigniter-3.html#comment-form -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->library('encryption');
  $this->load->library('session'); // enable session
  if($this->session->userdata('logged_in')) // if already login
  {
   redirect('private_area');
  }
  $this->load->library('form_validation');
  $this->load->library('encryption');
  $this->load->model('login_model');
  $this->load->model('user_model');


}

  

 function index()
 {

  $this->load->helper('captcha');
  $vals = array(
    // 'word'          => 'Random word',
    'img_path'      => './captcha-images/',
    'img_url'       => base_url().'/captcha-images/',
    'font_path'     => './path/to/fonts/texb.ttf',
    'img_width'     => '150',
    'img_height'    => 30,
    'expiration'    => 7200,
    'word_length'   => 4,
    'font_size'     => 16,
    'img_id'        => 'Imageid',
    'pool'          => '0123456789abdeghqrtABCDEFGHIJKLMNOPQRSTUVWXYZ',

    // White background and border, black text and red grid
    'colors'        => array(
            'background' => array(255, 255, 255),
            'border' => array(255, 255, 255),
            'text' => array(0, 0, 0),
            'grid' => array(255, 40, 40)
        )
    );

    $cap = create_captcha($vals);
    // print_r($cap);exit;
    $image = $cap['image'];
    $captcha_word = $cap['word'];
    $this->session->set_userdata('captcha_word', $captcha_word);
    // echo $cap['image'];



    $this->load->view('login', ['captcha_image'=>$image]);




  if (get_cookie('remember')) { // check if user activate the "remember me" feature  
    $user_email = get_cookie('user_email'); //get the user email from cookie
    //$password = get_cookie('user_password'); //get the password from cookie
    $password = $this->encryption->decrypt(get_cookie('user_password')); //get the username from cookie and decrypt it
    $result = $this->login_model->can_login($user_email, $password);
    if($result == '') {
        $user_data = array(
            'username' => $user_email,
            'logged_in' => true
        );
        $this->session->set_userdata($user_data); //set user status in session
        redirect('private_area');
    }
 }
}

 function validation()
 {
  $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email');
  $this->form_validation->set_rules('user_password', 'Password', 'required');
  $this->form_validation->set_rules('captcha', 'captcha', 'required');

  if($this->form_validation->run())
  {
      $user_email = $this->input->post('user_email');
      $password = $this->input->post('user_password');
    //   $hash = password_hash($password, PASSWORD_DEFAULT);

      $remember = $this->input->post('remember');

      $captcha_enter = $this->input->post('captcha');
      $captcha_word = $this->session->userdata('captcha_word');

    if ($captcha_enter == $captcha_word) {
        $result = $this->login_model->can_login($user_email, $password);
    

        if($result == '')
        {
            $user_data = array(
                'username' => $user_email,
                'logged_in' => true
            );
            $this->session->set_userdata($user_data); //set user status in session

            //    session_start();
            //    $_SESSION['logged_in'] = 'test';
            //    echo $_SESSION['logged_in'];

            if($remember) {
                echo $remember, 'cookies';
                set_cookie('user_email', $user_email, 3); //set cookie user email
                $encrypted_password = $this->encryption->encrypt($this->input->post('user_password')); // encrypt the user's password
                set_cookie('user_password', $encrypted_password, 3); //set cookie password
                set_cookie('remember', $remember, 3); //set cookie remember
            }
            
            redirect('private_area');
        }
        else //password is incorrect, login fail
        {
            $this->session->set_flashdata('message',$result);
            redirect('login');
        }
    }
    else // captcha is incorrect
    {
        $this->session->set_flashdata('message','captcha is incorrect, please try again');
        redirect('login');
    }
 }
  else
  {
   $this->index();
  }
}

 

 function logout()
	{
		// $this->session->unset_userdata('logged_in'); //delete login status
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value)
        {
        $this->session->unset_userdata($row);
        }
		redirect('login'); // redirect user back to login
	}

    function forgot_password_page() {
        $this->load->view('forgot_password');
    }

    function security_validate() {
        $user_email = $this->input->post('user_email');
        $ans = $this->input->post('security_ans');
        $result = $this->login_model->ans_match($user_email, $ans);
        if ($result == "TRUE") {
            redirect('login/reset_password_page');
        }
        else{
            $this->session->set_flashdata('message', $result);
            redirect('login/forgot_password_page');
            // echo 'Wrong ans';
        }
    }

    function reset_password_page() {
        $this->load->view('reset_password');
    }

    function reset_password() {
        $new_password = $this->input->post('new_password');

        $user_id = $this->session->userdata('id');

        $query = $this->user_model->update_password($user_id, $new_password);

        redirect('login');
 
    }

    public function getNewCaptcha() {
        $this->load->helper('captcha');
        $vals = array(
            // 'word'          => 'Random word',
            'img_path'      => './captcha-images/',
            'img_url'       => base_url().'/captcha-images/',
            'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 4,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abdeghqrtABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                )
            );

            $cap = create_captcha($vals);

            $image = $cap['image'];
            $captcha_word = $cap['word'];
            $this->session->set_userdata('captcha_word', $captcha_word);
            echo $image;


    }
}

?>
