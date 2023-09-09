
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable Ajax Pagintation with search and sort in ci4</title>

     <!-- Datatable CSS -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <!-- CSRF TOKEN -->
    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

    <!-- table  -->
    <table id="userTable" class="display dataTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>City</td>
            </tr>
        </thead>
    </table>
    <!-- script   -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#userTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax':{
                    'url': "<?= site_url('users/getUsers') ?>",
                    'data' :function(data){
                        //CSRF Hash
                        var csrfName = $('.txt_csrfname').attr('name');
                        var csrfHash = $('.txt_csrfname').val(); //CSRF hash

                        return {
                            data: data,
                            [csrfName] :csrfHash //csrftoken
                        };
                    },
                    dataSrc: function(data){

                        //Update token hash
                        $('.txt_csrfname').val(data.token);

                        //Datatable data

                        return data.aaData;
                    }
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'city'},
                ]
            });
        });
    </script>
</body>
</html>