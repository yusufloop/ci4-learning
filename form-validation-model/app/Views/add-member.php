<!DOCTYPE html>
<html lang="en">

<head>
    <title>CodeIgniter 4 Form Validation Using Model Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top:50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Form</div>
            <div class="panel-body">

                <?php
                // To print success flash message
                if (session()->get("success")) {
                ?>
                    <div class="alert alert-success">
                        <?= session()->get("success") ?>
                    </div>
                    <?php
                }
                ?>

                <?php
                // To print error messages
                if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                    <?php endforeach ?>
                </div>
                <?php endif ?>

                <form action="<?= base_url('add-member') ?>" method="post">
                    <p>
                        Name: <input type="text" class="form-control" name="name" placeholder="Enter name" />
                    </p>

                    <p>
                        Email: <input type="email" class="form-control" name="email" placeholder="Enter email" />
                    </p>

                    <p>
                        Mobile: <input type="text" class="form-control" name="mobile" placeholder="Enter mobile" />
                    </p>

                    <p>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>