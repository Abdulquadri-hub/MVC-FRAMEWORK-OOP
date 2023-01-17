<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<?php if((new Email_verification_model())->Check_if_verified()): ?>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width:500px;">
        <?= Session::getemail() ?> <br> <?= Session::get('message') ?>
    </div>
<?php else:?>
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 500px;">
        You need to verify your email to have access to your profile <br> <hr>
        <a href="<?=ROOT_URL?>email_verification">
            <button class="btn btn-sm btn-primary">Click here verify your email</button>
        </a>
    </div>
<?php endif ;?>
    <?php $this->view('includes/footer'); ?>