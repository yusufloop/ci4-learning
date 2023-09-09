<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
   <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <style type="text/css">
    .dz-preview .dz-image img{
    width: 100% !important;
    height: 100% !important;
    object-fit: cover;
    }
</style>
</head>
<body>
    <!-- CSRF token --> 
   <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

<div class='content'>
   <!-- Dropzone -->
   <form action="<?=site_url('page/fileUpload')?>", class='dropzone' ></form> 
</div>

<!-- Script -->
<script>

Dropzone.autoDiscover = false;
var myDropzone = new Dropzone(".dropzone",{ 
   maxFilesize: 2, // 2 mb
   acceptedFiles: ".jpeg,.jpg,.png,.pdf",
   init: function() { 
      myDropzone = this;
      $.ajax({
         url: '<?=site_url('page/readFiles')?>',
         type: 'get',
         dataType: 'json',
         success: function(response){

            $.each(response, function(key,value) {
               var mockFile = { name: value.name, size: value.size };

               myDropzone.emit("addedfile", mockFile);
               myDropzone.emit("thumbnail", mockFile, value.path);
               myDropzone.emit("complete", mockFile);

            });

         }
      });
   }
});

myDropzone.on("sending", function(file, xhr, formData) {
   // CSRF Hash
   var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
   var csrfHash = $('.txt_csrfname').val(); // CSRF hash

   formData.append(csrfName, csrfHash);
}); 

myDropzone.on("success", function(file, response) {
   $('.txt_csrfname').val(response.token);
   if(response.success == 0){ // Error
      alert(response.error);
   }
   if(response.success == 2){
      alert(response.message);
   }

});
</script>
</body>
</html>