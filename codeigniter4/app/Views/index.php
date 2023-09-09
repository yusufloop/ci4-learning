<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>How to Send AJAX request with CSRF token in CodeIgniter 4</title>
</head>
<body>

   <!-- CSRF token --> 
   <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    
    <br>
    <p style='color: red;'>Select User name from the dropdown</p>
   <br>
   Select Username : <select id='sel_user'>
   <?php 
   foreach($users as $user){
   ?>
      <option value='<?= $user["username"]?>'><?= $user["name"] ?></option>
   <?php
   }
   ?>
   </select>

   <!-- User details -->
   <div >
     Username : <span id='suname'></span><br/>
     Name : <span id='sname'></span><br/>
     Email : <span id='semail'></span><br/>
   </div>

   <!-- Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script type='text/javascript'>
   $(document).ready(function(){

     $('#sel_user').change(function(){

       // CSRF Hash
       var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
       var csrfHash = $('.txt_csrfname').val(); // CSRF hash

       // Username
       var username = $(this).val();

       // AJAX request
       $.ajax({
            url: "<?=site_url('users/userDetails')?>",
            method: 'post',
            data: {username: username,[csrfName]: csrfHash },
            dataType: 'json',
            success: function(response){

                // Update CSRF hash
                $('.txt_csrfname').val(response.token);

                // Empty the elements
                $('#suname,#sname,#semail').text('');

                if(response.success == 1){
                    // Loop on response
                    $(response.user).each(function(key,value){

                        var uname = value.username;
                        var name = value.name;
                        var email = value.email;

                        $('#suname').text(uname);
                        $('#sname').text(name);
                        $('#semail').text(email);
                    });
                }else{
                    // Error
                    alert(response.error);
                }

            }
        });
     });
   });
   </script>
</body>
</html>