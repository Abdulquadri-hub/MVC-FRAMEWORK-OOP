<form action="" method="post">
            <div class="p-3 mx-auto shadow rounded bg-light" style="margin-top:50px; width:100%;max-width:310px;">
                <h3 class="text-secondary">Forgot Password</h3>
            <hr>
        <?php  include(views_path('errors')); ?>

        <h6>
            Check your email, <br> You've been sent a code <br> This code is only valid for 1 minutes
        </h6>

        <input type="text" class="my-2 form-control" name="code" value="<?=old_value("code")?>" placeholder="Enter your valid code">

        <button type="submit" class=" my-2 btn btn-danger" style="width:100%;" >
            Next
        </button>

        <a href="<?=ROOT_URL?>login">
            <h4>Login</h4>
        </a>
        </div>
        </form>