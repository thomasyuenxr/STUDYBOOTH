
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// code from https://www.webslesson.info/2018/07/autocomplete-search-box-using-typeahead-in-codeigniter.html

class Autocomplete extends CI_Controller {
 
 function index()
 {

 }
 function fetch()
 {
  $this->load->model('autocomplete_model');
  echo $this->autocomplete_model->fetch_data($this->uri->segment(3));
 }
}
?>



