<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Codeigniter 4 Integration of Google Recaptcha v2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top:30px;">

        <div class="row">
            <div class="col-md-9">
                <h3>User Form</h3>
                <div class="error"><strong><?= session('msg') ?></strong></div>
                <br />
                <form method="post" action="<?= base_url('form-submit') ?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Name</label>
                        <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Please enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Id</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Please enter email id">
                    </div>
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Please enter mobile number" maxlength="10">
                    </div>
                    <div class="g-recaptcha" data-sitekey="<?= env('RECAPTCHAV2_SITEKEY') ?>"></div>
                    <br />
                    <div class="form-group">
                        <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>