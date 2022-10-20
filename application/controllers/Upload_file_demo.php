<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Upload_File_demo extends CI_Controller { 
    function  __construct() { 
        parent::__construct(); 
         
        // Load file model 
        $this->load->model('file'); 
    } 
     
    function index(){ 
        $data = array(); 
         
        // Get files data from the database 
        $data['files'] = $this->file->getRows(); 
         
        // Pass the files data to view 
        $this->load->view('upload_file', $data); 
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
                $fileData = $this->upload->data(); 
                $uploadData['file_name'] = $fileData['file_name']; 
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s"); 
                 
                // Insert files info into the database 
                $insert = $this->file->insert($uploadData); 
            } 
        } 
    } 
}