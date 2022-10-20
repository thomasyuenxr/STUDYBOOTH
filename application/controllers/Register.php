<!-- register feature inspired by https://www.webslesson.info/2018/10/user-registration-and-login-system-in-codeigniter-3.html#comment-form -->
<!-- reCaptcha inspired by https://www.webslesson.info/2020/10/how-to-implement-google-recaptcha-in-codeigniter.html -->

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  if($this->session->userdata('id'))
  {
   redirect('private_area');
  }
  $this->load->library('form_validation');
  $this->load->library('encryption');
  $this->load->model('register_model');
 }

 function index()
 {
  $this->load->view('register');
 }

 function validation()
 {
    
  $this->form_validation->set_rules('user_name', 'Name', 'required|trim|is_unique[codeigniter_register.name]');
  $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[codeigniter_register.email]');
  $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[8]|max_length[25]');
  $this->form_validation->set_rules('security_ans', 'Security quention', 'required|min_length[2]');

  
  

  if($this->form_validation->run())
  {
    $captcha_response = trim($this->input->post('g-recaptcha-response'));
    if($captcha_response != '') 
    {
        $keySecret = '6Le4oQwgAAAAADjm75aKffOpKqqxgfh6ky9mkIuk';

        $check = array(
            'secret'		=>	$keySecret,
            'response'		=>	$this->input->post('g-recaptcha-response')
        );

        $startProcess = curl_init();

		curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

		curl_setopt($startProcess, CURLOPT_POST, true);

		curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

		curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

		$receiveData = curl_exec($startProcess);

		$finalResponse = json_decode($receiveData, true);

        if($finalResponse['success'])
        {
            $verification_key = md5(rand());
            // $encrypted_password = $this->encryption->encrypt($this->input->post('user_password'));

            $password = $this->input->post('user_password');
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            $data = array(
                'name'  => $this->input->post('user_name'),
                'email'  => $this->input->post('user_email'),
                //'password'  => $this->input->post('user_password'),
                'password' => $encrypted_password,
                'security_ans' => $this->input->post('security_ans'),
                'verification_key' => $verification_key
            );
            $id = $this->register_model->insert($data);
            if($id > 0)
            {
    
                $subject = "Please verify email for login";
                $message = "
                <p>Hi ".$this->input->post('user_name')."</p>
                <p>This is email verification mail from StudyBooth Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
                <p>Once you click this link your email will be verified and you can login into system.</p>
                <p>Thanks.</p>
                ";
                $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'mailhub.eait.uq.edu.au',
                'smtp_port' => 25,
                //'smtp_user'  => 'xxxxxxx', 
                //'smtp_pass'  => 'xxxxxxx', 
                'mailtype'  => 'html',
                'charset'    => 'iso-8859-1',
                    'wordwrap'   => TRUE
                    //'starttls' => true
                );
                // $this->load->library('email', $config);
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from('studybooth@uq.edu.au', 'cs');
                // $this->email->to($this->input->post('user_email'));
                $this->email->to($data['email']);
                $this->email->subject($subject);
                $this->email->message($message);
                if($this->email->send())
                {
                    $this->session->set_flashdata('message', 'Check in your email for email verification mail');
                    redirect('register');
                }
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'Validation Fail Try Again');
			redirect('register');
        }


    }
    else
    {
        $this->session->set_flashdata('message', 'Validation Fail Try Again');
        redirect('register');
    }

   
  }
  else
  {
   $this->index();
  }
 }

 function verify_email()
 {
  if($this->uri->segment(3))
  {
   $verification_key = $this->uri->segment(3);
   if($this->register_model->verify_email($verification_key))
   {
    $data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
   }
   else
   {
    $data['message'] = '<h1 align="center">Invalid Link</h1>';
   }
   $this->load->view('email_verification', $data);
  }
 }

}

?>
