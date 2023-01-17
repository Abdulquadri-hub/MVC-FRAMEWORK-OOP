        <form action="" method="post">
            <div class="p-3 mx-auto shadow rounded bg-light" style="margin-top:50px; width:100%;max-width:310px;">
                <h3 class="text-secondary">Forgot Password</h3>
            <hr>
        <?php  include(views_path('errors')); ?>

        <input type="text" class="my-2 form-control" name="email" value="<?=old_value("email")?>" placeholder="Enter your valid email">

        <button type="submit" class=" my-2 btn btn-success" style="width:100%;" >
            Confirm
        </button>

        <a href="<?=ROOT_URL?>login">
            <h4>Login</h4>
        </a>
        </div>
        </form>