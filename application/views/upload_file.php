<!DOCTYPE html>
<html>
<head>
    <!-- Add DropzoneJS CSS & JS library -->


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    

    <!-- Default stylesheet -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
</head>

<body>
    <div class="container">
        <h1>Drag & Drop Multiple Files Upload in STUDYBOOTH</h1>


        <!-- Files upload form -->
        <div class="upload-div">
            <form action="<?php echo base_url('upload_file/dragDropUpload'); ?>" class="dropzone"></form>
        </div>

        <!-- Display uploaded files -->
        <div class="gallery">
            <h3>Uploaded Files:</h3>

            <?php
                if(!empty($files)){ foreach($files as $row){ 
                    $filePath = 'uploads/'.$row["file_name"]; 
                    $fileMime = mime_content_type($filePath); 
                    ?>
                    <embed src="<?php echo base_url('uploads/'.$row["file_name"]); ?>" type="<?php echo $fileMime; ?>" width="350px" height="240px" /> 
            <?php 
            } }else{ 
            ?> 
            <p>No file(s) found...</p> 
            <?php 
            } 
            ?>

        </div>
    </div>
</body>

</html>