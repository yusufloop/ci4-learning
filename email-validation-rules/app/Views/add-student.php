<?php 
//to print error message
if(isset($validation)){
    echo $validation->listErrors();
}
?>

<form action="<?= base_url('add-student')?>" method="post">
    <p>
       Name: <input type="text" name="name" placeholder="Enter name"/>
   </p>

   <p>
       Email: <input type="email" name="email" placeholder="Enter email" class="<?= ($validation->hasError('email')) ? 'is-error' : '' ?>"/>
        <?php 
        if ($validation->hasError('email')){
  
            echo $validation->getError('email'); // $validation is sent from controller
        }
        ?>
    </p>

   <p>
       Mobile: <input type="text" name="mobile" placeholder="Enter mobile"/>
   </p>

   <p>
     <button type="submit">Submit</button>
   </p>
</form>