<html>
    <body>
        <div class="container">
        <h1>Profile Page</h1>
            <ul class="list-inline">
                <li class="list-inline-item">
                    User Name: 
                </li>

                <li class="list-inline-item">
                <?php echo $user->name ?>
                </li>
                  
                <li class="list-inline-item">
                <a href="<?php echo base_url(); ?>profile/name_update_page" >change my name</a>
                </li> 
            </ul>

            <ul class="list-inline">
                <li class="list-inline-item">
                Email:
                </li>

                <li class="list-inline-item">
                <?php echo $user->email ?>
                </li>
                  
                <li class="list-inline-item">
                <a href=# >update email</a>
                </li> 
            </ul>


            

        </div>
    </body>