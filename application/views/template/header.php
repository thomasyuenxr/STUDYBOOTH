<html>
    <head>  
                <title>STUDY BOOTH</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo base_url(); ?>welcome">STUDY BOOTH</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>welcome"> Home </a>
                        <a href="<?php echo base_url(); ?>private_area"> Dashboard </a>
                        <a href="<?php echo base_url(); ?>upload_file"> Upload </a>
                    </li>
                </ul>

                

                <ul class="navbar-nav my-lg-0">
                    <?php if(!$this->session->userdata('logged_in')) : ?>
                        <li class="nav-item">
                                <a href="<?php echo base_url(); ?>login"> LOGIN  </a>
                                <a href="<?php echo base_url(); ?>register"> REGISTER </a>
                        </li>
                        
                    <?php endif; ?>
                    
                    <?php if($this->session->userdata('logged_in')) : ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>profile"> PROFILE </a>
                            <a href="<?php echo base_url(); ?>cart"> CART </a>
                            <a href="<?php echo base_url(); ?>logout"> LOGOUT </a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
            
        </nav>
        
    </body>

