<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File using ajax</title>

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style type="text/css">
     .displaynone{
          display: none;
     }
     </style>

</head>
<body>
    <div class="container">
        <!-- CSRF token -->
        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
        
        <div class="row">
            <div class="col-md-12">

            <!-- Response message -->
            <div class="alert displaynone" id="responseMsg"></div>

            <!-- FilePreview -->
            <div class="diplaynone" id="filepreview">
                <img src="" alt="" class="displaynone" with="200px" height="200px"> <br>
                <a href="#" class="displaynone">Click here</a>
            </div>

            <!-- file upload form -->
            <form action="<?= site_url('users/fileUpload') ?>" method="post" enctype="multipart/form-data">
                <div class="formgroup">
                    <label for="file">File:</label>

                    <input type="file" class="form-control" id="file" name="file">
                    <!-- error -->
                    <div class="alert alert-danger mt-2 d-none" id="err_file"></div>
                </div>

                <input type="button" class="btn btn-success" id="submit" value="Upload">
            </form>
            </div>
        </div>
    </div>

    <!-- script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#submit').click(function()
            {
                // CSRF hash
                var csrfName = $('.txt_csrfname').attr('name'); // csrf csrf_token
                var csrfHash = $('.txt_csrfname').val(); //csrf hash

                //get the selected file
                var files = $('#file')[0].files;

                if(files.length > 0)
                {
                    var fd = new FormData();

                    // append data 
                    fd.append('file',files[0]);
                    fd.append([csrfName], csrfHash);

                    // hide alert 
                    $('#responseMsg').hide();

                    // AJAX RESPONSE 
                    $.ajax({
                        url:"<?= site_url('users/fileUpload') ?>",
                        method: 'post',
                        data:fd,
                        contentType: false,
                        processData:false,
                        dataType:'json',
                        success: function(response){
                            // Update CSRF token 
                            $('.txt_csrfname'). val(response.token);
                            
                            // hide error container 
                            $('#err_file').removeClass('d-block');
                            $('#err_file').addClass('d-none');

                            if(response.success == 1) // Uploaded succesful
                            {
                                // response message 
                                $('#responseMsg').removeClass("alert-danger");
                                $('#responseMsg').addClass('alert-success');
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').show();

                                //File Preview
                                $('#filepreview').show();
                                $('#filepreview img, #filepreview a').hide();
                                if(response.extension == 'jpg' || response.extension == 'jpeg')
                                {
                                    $('#filepreview img').attr('src', response.filepath);
                                    $('#filepreview img').show(); 
                                } 
                                else
                                {
                                    $('#filepreview a').attr('href', response.filepath).show();
                                    $('filepreview a').show();
                                }

                            }
                            else if(response.success == 2) //file not uploaded
                            {
                                // response message 
                                $('#responseMsg').removeClass("alert-danger");
                                $('#responseMsg').addClass('alert-success');
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').show();
                            }
                            else
                            {
                                // display error 
                                $('#err_file').text(response.error);
                                $('#err_file').removeClass('d-none');
                                 $('#err_file').addClass('d-block');
                            }
                        },
                        error:function(response)
                        {
                            console.log("error :" + JSON.stringify(response));
                        }
                    });
                }
                else
                {
                    alert("Please select a file");
                }
            });
        });
    </script>
</body>
</html>