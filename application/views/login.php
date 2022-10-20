<!-- inspired by https://www.webslesson.info/2018/10/user-registration-and-login-system-in-codeigniter-3.html#comment-form -->
<!-- inspired by https://www.youtube.com/watch?v=idR-kx8C7PI -->

<!DOCTYPE html>
<html>
<head>
    <title>Complete User Registration and Login System in Codeigniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">Login StudyBooth</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <?php
                if($this->session->flashdata('message'))
                {
                    echo '
                    <div class="alert alert-success">
                        '.$this->session->flashdata("message").'
                    </div>
                    ';
                }
                ?>
                <form method="post" action="<?php echo base_url(); ?>login/validation">
                    <div class="form-group">
                        <label>Enter Email Address</label>
                        <input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>" />
                        <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="user_password" class="form-control" value="<?php echo set_value('user_password'); ?>" />
                        <span class="text-danger"><?php echo form_error('user_password'); ?></span>
                    </div>
                    <div class="form-group">
                        <span id="Captcha-image"><?php echo $captcha_image; ?></span>
                        <button type="button" class="btn btn-primary" onclick="getNewCaptcha();"><i class="fa fa-refresh text-white"></i></button>
                        
                    </div>
                    <div class="form-group">
                        <label>Please enter the captcha</label>
                        <input type="text" name="captcha" class="form-control" value="<?php echo set_value('captcha'); ?>" />
                        <span class="text-danger"><?php echo form_error('captcha'); ?></span>
                    </div>
                    <div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
						<a href="<?php echo base_url(); ?>login/forgot_password_page" class="float-right">Forgot Password?</a>
					</div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-info" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>register">Register</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script type="text/javascript">
        function getNewCaptcha() {
            $.ajax({
                url:"<?php echo base_url();?>login/getNewCaptcha",
                success:function(response) 
                {
                    // alert(response);
                    $('#Captcha-image').html(response);
                    
                }
            });
        }
    </script>

    

</body>
</html>