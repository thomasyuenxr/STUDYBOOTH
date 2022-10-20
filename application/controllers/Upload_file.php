<!-- inspired by https://www.codexworld.com/codeigniter-drag-and-drop-file-upload-with-dropzone/ -->

<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Upload_File extends CI_Controller { 
    function  __construct() { 
        parent::__construct(); 
        $this->load->library('session'); // enable session
        // $this->load->library('upload');
         
        // Load file model 
        $this->load->model('file_model'); 
    } 
     
    function index(){ 

        if ($this->session->userdata('logged_in'))
        {
            $uid = $this->session->userdata('id');


            $data = array(); 

            
         
            // Get files data from the database 
            $data['files'] = $this->file_model->getRows($uid); 

         
            // Pass the files data to view 
            $this->load->view('template/header', $data);
            $this->load->view('upload_file', $data); 
        }
        else 
        {
            redirect('login');
        }






        
    } 
     
    function dragDropUpload(){ 
        if(!empty($_FILES)){ 


            // File upload configuration 
            $uploadPath = 'uploads/'; 
            $config['upload_path'] = $uploadPath; 
            $config['allowed_types'] = '*'; 
             
            // Load and initialize upload library 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
             
            // Upload file to the server 
            if($this->upload->do_upload('file')){ 

                $uid = $this->session->userdata('id');

                $fileData = $this->upload->data(); 
                $uploadData['file_name'] = $fileData['file_name']; 
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s"); 
                $uploadData['uid'] = $uid;
                 
                // Insert files info into the database 
                $insert = $this->file_model->insert($uploadData); 
            } 
        } 
    } 
}