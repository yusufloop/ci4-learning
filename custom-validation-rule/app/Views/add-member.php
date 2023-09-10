<!DOCTYPE html>
<html lang="en">

<head>
    <title>CodeIgniter 4 Form Validation Example Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        p.error{
            color:red;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Add Member</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">Add Member</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url('add-member'); ?>">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            <?php
                            if (isset($validation) && $validation->hasError('name')){
                                ?>
                            <p class="error"><?php echo $validation->getError('name'); ?></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            <?php
                            if (isset($validation) && $validation->hasError('email')){
                                ?>
                            <p class="error"><?php echo $validation->getError('email'); ?></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mobile">Mobile:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                placeholder="Enter mobile">
                            <?php
                            if (isset($validation) && $validation->hasError('mobile')){
                                ?>
                            <p class="error"><?php echo $validation->getError('mobile'); ?></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>