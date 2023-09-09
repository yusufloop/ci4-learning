<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jquery Ui auto complete in ci4</title>

    <!-- jQuery UI CSS -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- jQuery UI JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

</head>
<body>
    <!-- CSRF TOKEN  -->
    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

    <!-- autocomplete -->
    Search User: <input type="text" id="autocompleteuser">

    <br><br>
    Selected user id: <input type="text" id="userid" value='0'>
    
    
    <!-- script  -->
    <script type='text/javascript'>
        $(document).ready(function(){
            //initialise
            $("#autocompleteuser").autocomplete({

                source:function(request, response){
                    // csrf hash 
                    var csrfName = $('.txt_csrfname').attr('name'); // csrf token name
                    var csrfHash = $('.txt_csrfname').val(); ///csrf hash

                    //fetch data
                    $.ajax({
                        url:"<?= site_url('users/getUsers') ?>",
                        type:'post',
                        dataType: "json",
                        data:{
                            search: request.term,
                            [csrfName]: csrfHash // csrf token
                        },
                        success:function(data){
                            //Update CSRF tOKEN
                            $('.txt_csrfname').val(data.token);

                            response(data.data);
                        }
                    });
                },

                select:function(event,ui){
                    //Set selection 
                    $('#autocompleteuser').val(ui.item.label); //display the selected text
                    $("#userid").val(ui.item.value);
                    return false;
                },
                focus: function(event, ui){
                    $( "#autocompleteuser" ).val( ui.item.label );
                    $( "#userid" ).val( ui.item.value );
                    return false;
                },
            });
        });
    </script>
</body>
</html>