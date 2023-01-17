<?php $this->view('includes/header')?>

    <div class="container-fluid">
        <form action="" method="post">
            <div class="p-3 mx-auto shadow rounded bg-light" style="margin-top:50px; width:100%;max-width:310px;">
        <h3 class="text-secondary">Signup</h3>

        <?php if(count($errors) > 0): ?>
        <div class="alert alert-warning alert-dismissible fade show p-2" role="alert">
        <strong>Errors:</strong>
        <?php foreach($errors as $error):?>
        <br> <?=$error?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <input type="username" class="my-2 form-control" name="username" value="<?=old_value("username")?>" placeholder="User Name">
        <input type="email" class="my-2 form-control" name="email" value="<?=old_value("email")?>" placeholder="E-mail">
        <input type="text" class="my-2 form-control" name="password" value="<?=old_value("password")?>" placeholder="Password">
        <button class="my-2 btn btn-primary float-end">Signup</button>
        <button type="button" class=" my-2 btn btn-danger" >Cancel</button>
        </div>
        </form>
    </div>

<?php $this->view('includes/footer')?>
