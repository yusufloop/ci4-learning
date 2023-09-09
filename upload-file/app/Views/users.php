<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload image</title>

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <?php 
                //display response
                if(session()->has('message'))
                {
            ?>
                <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php 
                }
            ?>

            <?php 
                   // File preview
                   if(session()->has('filepath')){ ?>
            
            <?php 
                if(session()->getFlashdata('extension') == 'jpg' || session()->getFlashdata('extension') == 'jpeg'|| session()->getFlashdata('extension') == 'png')
                {
            ?>
                <img src="<?= session()->getFlashdata('filepath') ?>" alt="image" width="200px" height="200px"> <br>\
            <?php 
                }
                else
                {
            ?>
                    <a href="<?= session()->getFlashdata('filepath') ?>">Click Here</a>
            <?php 
                }
            }
            ?>

            <?php $validation = \Config\Services::validation(); ?>

            <form action="<?= site_url('users/fileUpload') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="file">File:</label>

                    <input type="file" class="form-control" id="file" name="file">
                    <!-- Error -->

                    <?php if($validation->getError('file')) {?>

                    <div class="alert alert-danger mt-2">
                         <?= $validation->getError('file'); ?>
                    </div>

                    <?php } ?>
                </div>

                <input type="submit" class="btn btn-success" name="submit" value="Upload">
            </form>
            
            
        </div>
    </div>
</body>
</html>