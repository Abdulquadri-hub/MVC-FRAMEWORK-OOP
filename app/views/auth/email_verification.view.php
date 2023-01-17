<?php $this->view('includes/header')?>

    <div class="container-fluid">
        <form action="" method="post">
            <div class="p-3 mx-auto shadow rounded bg-light" style="margin-top:50px; width:100%;max-width:310px;">
                <h3 class="text-secondary">Email Verification</h3>

        <?php if(count($errors) > 0): ?>
        <div class="alert alert-warning alert-dismissible fade show p-2" role="alert">
        <strong>Errors:</strong>
        <?php foreach($errors as $error):?>
        <br> <?=$error?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <hr>

        <h6>
            Check your email, <br> You've been sent a code <br> This code is only valid for 1 minutes
        </h6>
        <hr>

        <input type="text" class="my-2 form-control" name="code" value="<?=old_value("email")?>" placeholder="Enter the code">



        <button class="my-2 btn btn-primary float-end">Verify</button>
        
            <a href="<?=ROOT_URL?>profile">
                <button type="button" class=" my-2 btn btn-danger" >Cancel</button>
            </a>
        </div>
        </form>
    </div>

<?php $this->view('includes/footer')?>
