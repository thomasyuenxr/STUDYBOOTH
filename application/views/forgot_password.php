<html>

<title>Security Validate</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">



<body>
    <div class="container">
            <h3 align="center">Security Validate</h1>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Validate security question</div>
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
                    <form method="post" action="<?php echo base_url(); ?>login/security_validate">
                        <div class="form-group">
                            <label>Enter Your Registered Email Address</label>
                            <input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>" />
                            <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>What is your favourite animal?</lable>
                            <input type="text" name="security_ans" class="form-control" value="<?php echo set_value('security_ans'); ?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="check_ans" value="submit" class="btn btn-primary" />
                        </div>
                </div>
                </form>
            </div>
    </div> 
</body>