<?php $this->view('includes/header')?>

<?php  
print_r(($errors));
?>
    <div class="container-fluid">
        <form action="" method="post">
            <div class="p-3 mx-auto shadow rounded bg-light" style="margin-top:50px; width:100%;max-width:310px;">
        <h2 class="text-center text-secondary">MVC FAMEWORK</h2>
        <h3 class="text-secondary">Signup</h3>
        <input type="username" class="my-2 form-control" name="username" value="<?=get_val("username")?>" placeholder="User Name">
        <input type="email" class="my-2 form-control" name="email" value="<?=get_val("email")?>" placeholder="E-mail">
        <input type="text" class="my-2 form-control" name="password" value="<?=get_val("username")?>" placeholder="Password">
        <button class="my-2 btn btn-primary float-end">Signup</button>
        <button type="button" class=" my-2 btn btn-danger" >Cancel</button>
        </div>
        </form>
    </div>

<?php $this->view('includes/footer')?>
