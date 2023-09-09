<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Load content on page scroll using AJAX in CodeIgniter 4</title>

      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

      <style type="text/css">
      .card{
           margin: 0 auto;
           margin-top: 35px;
      }
      </style>
</head>
<body>

     <div class='container'>

          <!-- CSRF Token -->
          <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

          <?php 
          foreach($posts as $post){
               $id = $post['id'];
               $title = $post['title'];
               $description = $post['description'];
               $link = $post['link'];
          ?>

               <div class="card w-75 post">
                   <div class="card-body">
                       <h5 class="card-title"><?= $title ?></h5>
                      <p class="card-text"><?= $description ?></p>
                      <a href="<?= $link ?>" target="_blank" class="btn btn-primary">Read More</a>
                   </div>
               </div>
           <?php 
           }
           ?>

           <input type="hidden" id="start" value="0">
           <input type="hidden" id="rowPerPage" value="<?= $rowPerPage ?>">
           <input type="hidden" id="totalRecords" value="<?= $totalRecords; ?>">

     </div>

     <!-- Script -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script type="text/javascript">

     checkWindowSize();

     // Check if the page has enough content or not. If not then fetch records
     function checkWindowSize(){
           if($(window).height() >= $(document).height()){
                // Fetch records
                fetchData();
           }
       }

       // Fetch records
       function fetchData(){
            var start = Number($('#start').val());
            var allcount = Number($('#totalRecords').val());
            var rowPerPage = Number($('#rowPerPage').val());
            start = start + rowPerPage;
 
            if(start <= allcount){
                 $('#start').val(start);

                 // CSRF Hash 
                 var csrfName = $('.txt_csrfname').attr('name'); 
                 // CSRF Token name 
                 var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                 $.ajax({
                      url:"<?=site_url('getPosts')?>",
                      type: 'post',
                      data: {[csrfName]: csrfHash,start:start},
                      dataType: 'json',
                      success: function(response){

                            // Add
                            $(".post:last").after(response.html).show().fadeIn("slow");

                            // Update token
                            $('.txt_csrfname').val(response.token);

                            // Check if the page has enough content or not. If not then fetch records
                            checkWindowSize();
                       }
                  });
            }
       }
       $(document).on('touchmove', onScroll); // for mobile
       function onScroll(){ 

             if($(window).scrollTop() > $(document).height() - $(window).height()-100) {

                    fetchData(); 
             }
        }
       
       $(window).scroll(function(){

              var position = $(window).scrollTop();
              var bottom = $(document).height() - $(window).height();

              if( position == bottom ){
                    fetchData(); 
              }

       });
      
       </script>
</body>
</html>