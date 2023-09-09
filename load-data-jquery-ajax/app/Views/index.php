<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOAD DATA USIGN JQUERY AJAX</title>

   

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body>
    <!-- csrf token  -->
    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

    <!-- select element  -->
    <select name="" id="selUser" style="width: 200px;">
        <option value="0">--Select User --</option>
    </select>

    <!-- script  -->
    <script type="text/javascript">
        $(document).ready(function(){
             // initialise select2
             $("#selUser").select2({
                ajax:{
                    url: "<?= site_url('users/getUsers') ?>",
                    type: "post",
                    dataType: 'json',
                    delay:250,
                    data:function(params){
                        // csrf hash 
                        var csrfName = $('.txt_csrfname').attr('name');
                        var csrfHash = $('.txt_csrfname').val();

                        return {
                            searchTerm: params.term, //SEARCH TOKEN
                            [csrfName]: csrfHash, //CSRF TOKEN
                        };
                    },
                    processResults: function(response)
                    {
                        //Update csrf Token
                        $('.txt_csrfname').val(response.token);

                        return{
                            results:response.data 
                        };
                    },
                    cache:true
                }
             });
        });
    </script>
</body>
</html>