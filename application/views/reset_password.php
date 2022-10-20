<html>
<title>Reset Password</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">



<body>
    <div class="container">
            <h3 align="center">Reset password</h1>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Reset password</div>
                <div class="panel-body">
                    <form method="post" action="<?php echo base_url(); ?>login/reset_password">
                        <div class="form-group">
                            <label>Enter your new password here:</lable>
                            <input type="password" name="new_password" class="form-control" value="<?php echo set_value('user_password'); ?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="password_update" value="update" class="btn btn-primary btn-lg" />
                        </div>
                </div>
                </form>
            </div>
    </div> 
</body>