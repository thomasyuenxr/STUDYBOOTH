<?php
class Autocomplete_model extends CI_Model

// code from https://www.webslesson.info/2018/07/autocomplete-search-box-using-typeahead-in-codeigniter.html

{
 function fetch_data($query)
 {
  $this->db->like('course_name', $query);
  $query = $this->db->get('search_auto');
  if($query->num_rows() > 0)
  {
   foreach($query->result_array() as $row)
   {
    $output[] = array(
     'name'  => $row["course_name"],
    );
   }
   echo json_encode($output);
  }
 }
}

?>
