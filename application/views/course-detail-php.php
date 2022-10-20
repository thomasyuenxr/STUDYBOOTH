<!-- inspired from https://www.webslesson.info/2018/07/autocomplete-search-box-using-typeahead-in-codeigniter.html -->

<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">

<!-- auto complete -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <!-- <link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />  -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
 <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
 <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>


<body>

  <!-- search box  -->
  <div class="container">
    <div class="row">
      <div id="prefetch" style="margin-right:5px;">
        <input type="text" name="search_box" id="search_box" class="form-control input-lg typeahead" placeholder="Search Here" style="margin-right:10px;"/>
      </div> 
      <br>
      <a href=# class="btn btn-primary">Search</a> 
    </div>            
  </div>

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Course Details</h2>
        <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <img src="<?php echo base_url(); ?>assets/img/php-pic.jpg" class="img-fluid" alt="">
            <h3>Web Information System</h3>
            <p>
              Qui et explicabo voluptatem et ab qui vero et voluptas. Sint voluptates temporibus quam autem. Atque nostrum voluptatum laudantium a doloremque enim et ut dicta. Nostrum ducimus est iure minima totam doloribus nisi ullam deserunt. Corporis aut officiis sit nihil est. Labore aut sapiente aperiam.
              Qui voluptas qui vero ipsum ea voluptatem. Omnis et est. Voluptatem officia voluptatem adipisci et iusto provident doloremque consequatur. Quia et porro est. Et qui corrupti laudantium ipsa.
              Eum quasi saepe aperiam qui delectus quaerat in. Vitae mollitia ipsa quam. Ipsa aut qui numquam eum iste est dolorum. Rem voluptas ut sit ut.
            </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Trainer</h5>
              <p><a href="#">Walter White</a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Course Fee</h5>
              <p>$165</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Teaching Tools</h5>
              <p>ZOOM</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Schedule</h5>
              <p>5.00 pm - 7.00 pm</p>
            </div>

            <!-- comment board -->

            <div>
              <!-- load comments -->
              <?php 
                foreach ($all_comment as $single_comment)
                {
                  echo '<h3 style="color:#6c757d">'.$single_comment->username.'</h3>';
                  echo '<h4>'.$single_comment->comment_content.'</h4>';
                  echo '<p style="color:gray">'.$single_comment->date_of_time.'</p>';

                };
              ?>
            </div>

            <br>

            <form method="post" action="<?php echo base_url(); ?>course/add_comment">
              <div class="form-group">
                <label>Leave your comment here:</label>
                <textarea type="text" name="comment" class="form-control" cols ="8" value="<?php echo set_value('comment_content'); ?>" ></textarea>
                <br>
                <input type="submit" name="comment-submit" value="Submit" class="btn btn-info" />

              </div>
            </form>

          </div>
        </div>

        

      </div>
    </section><!-- End Cource Details Section -->
</body>


</html>


<script>
$(document).ready(function(){
  var sample_data = new Bloodhound({
   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
   queryTokenizer: Bloodhound.tokenizers.whitespace,
   prefetch:'<?php echo base_url(); ?>autocomplete/fetch',
   remote:{
    url:'<?php echo base_url(); ?>autocomplete/fetch/%QUERY',
    wildcard:'%QUERY'
   }
  });
  

  $('#prefetch .typeahead').typeahead(null, {
   name: 'sample_data',
   display: 'name',
   source:sample_data,
   limit:10,
   templates:{
    suggestion:Handlebars.compile('<div class="dropdown-item" style="padding-right:5px; padding-left:5px; background-color:white;" >{{name}}</div>')
   }
  });
});
</script>


