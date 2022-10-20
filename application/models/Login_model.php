<!-- inspired by https://www.webslesson.info/2018/10/user-registration-and-login-system-in-codeigniter-3.html#comment-form -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model
{
 function can_login($email, $password)
 {
  $this->db->where('email', $email);
  $query = $this->db->get('codeigniter_register');
  if($query->num_rows() > 0)
  {
   foreach($query->result() as $row)
   {
    if($row->is_email_verified == 'yes')
    {
    //  $store_password = $this->encryption->decrypt($row->password);
    //  if($password == $store_password)
    $hash = password_hash($password, PASSWORD_DEFAULT);
    if(password_verify($password, $hash))
     {
      $this->session->set_userdata('id', $row->id);
     }
     else
     {
      return 'Wrong Password';
     }
    }
    else
    {
     return 'First verified your email address';
    }
   }
  }
  else
  {
   return 'Wrong Email Address';
  }
 }

    function ans_match($email, $ans) {
        $this->db->where('email', $email);
        $query = $this->db->get('codeigniter_register');
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                if($row->security_ans == $ans){
                    $id = $row->id;
                    $user_data = array(
                        'id' => $id
                    );
                    $this->session->set_userdata($user_data); // set user id in session
                    return "TRUE";
                }else {
                    return 'Wrong answer. Please try again';
                }
            }
        }
    }

}

?>