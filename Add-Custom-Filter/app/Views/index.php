<!DOCTYPE html>
<html>
<head>
   <title>Add custom filter in DataTable AJAX pagination in CodeIgniter 4</title>

   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Datatable CSS -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>

   <!-- jQuery Library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

   <!-- Datatable JS -->
   <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

</head>
<body>

   	<!-- CSRF token --> 
   	<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

   	<!-- Custom Filter -->
   	<table>
     <tr>
       <td>
         <input type='text' id='searchByName' placeholder='Enter name'>
       </td>
       <td>
         <select id='searchByCity'>
           <option value=''>-- Select City--</option>
           <?php 
           foreach($citylists as $citylist){
           		echo "<option value='".$citylist['city']."' >".$citylist['city']."</option>";
           }
           ?>
         </select>
       </td>
     </tr>
   </table>

   <!-- Table -->
   <table id='empTable' class='display dataTable'>

     <thead>
       <tr>
         <th>Name</th>
         <th>Email</th>
         <th>City</th>
         <th>Gender</th>
       </tr>
     </thead>

   </table>

   <!-- Script -->
   <script type="text/javascript">
   $(document).ready(function(){
      var dataTable = $('#empTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'searching': true, // Remove default Search Control
         'ajax': {
            'url':"<?=site_url('/getEmployees')?>",
            'data': function(data){
               // CSRF Hash
               var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
               var csrfHash = $('.txt_csrfname').val(); // CSRF hash

               // Custom filter values
               var name = $('#searchByName').val();
               var city = $('#searchByCity').val();

               data.searchByName = name;
               data.searchByCity = city;
               return {
                  data: data,
                  [csrfName]: csrfHash // CSRF Token
               };
            },
            dataSrc: function(data){

              // Update token hash
              $('.txt_csrfname').val(data.token);

              // Datatable data
              return data.aaData;
            }
         },
         'columns': [
            { data: 'emp_name' },
            { data: 'email' },
            { data: 'city' },
            { data: 'gender' },
         ]
      });

      // Custom filter
      $('#searchByName').keyup(function(){
	    dataTable.draw();
	  });

	  $('#searchByCity').change(function(){
	    dataTable.draw();
	  });
   });
   </script>
</body>
</html>