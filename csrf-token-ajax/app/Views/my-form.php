<!doctype html>
  
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Codeigniter 4 CSRF Token with Ajax Request Tutorial - Online Web Tutor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  
  <script>
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';  
  </script>
  
</head>

<body>
  <div class="container">

    <h2>CodeIgniter 4 CSRF Token with Ajax Request</h2>

    <form method="post" action="javascript:void(0)" id="frm-my-form">
      <p>
        Name: <input type="text" name="name" id="name" placeholder="Enter name"/>
      </p>
      <p>
        Email: <input type="email" name="email" id="email" placeholder="Enter email"/>
      </p>
      <p>
        Mobile: <input type="text" name="mobile" id="mobile" placeholder="Enter mobile"/>
      </p>
      <p>
        <button type="submit">Submit</button>
      </p>
    </form>
          
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
          
  <script>
      $("#frm-my-form").on("submit", function(){
          var dataJson = { 
            [csrfName]: csrfHash, // adding csrf here
            name: $("#name").val(), 
            email: $("#email").val(),
            mobile: $("#mobile").val() 
          };

        $.ajax({
            url : "<?php echo base_url('submit-data'); ?>",
            type: 'post',
            data: dataJson, 
            dataType: "json",         
            success : function(data)
            {   
                console.log(data);
            }  
        });
      });    
  </script>        
          
</body>
          
</html>