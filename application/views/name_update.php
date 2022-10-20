
<html>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">



<body>
    <div class="container">
            <h3 align="center">Update the name</h1>
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Update Name</div>
                <div class="panel-body">
                    <form method="post" action="<?php echo base_url(); ?>profile/update_name">
                        <div class="form-group">
                            <label>Enter your new name here:</lable>
                            <input type="text" name="new_name" class="form-control" value="<?php echo set_value('user_name'); ?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="name_update" value="update" class="btn btn-primary btn-lg" />
                        </div>
                </div>
                </form>
            </div>
    </div> 
</body>