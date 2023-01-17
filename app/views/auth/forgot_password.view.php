<?php $this->view('includes/header')?>

    <div class="container-fluid">

    <?php    
        switch ($mode) {
            case 'email':
                include(views_path('enter-email'));
                break;
            case 'code':
                if(isset($_SESSION['APP']['email'])){
                    include(views_path('enter-code'));
                }
                else {
                    include(views_path('enter-email'));
                }
                break;
            case 'password':
                if(isset($_SESSION['APP']['email']) && isset($_SESSION['APP']['code'])){
                    include(views_path('enter-password'));
                }else {
                    include(views_path('enter-email'));
                }
                break;
            
            default:
                # code...
                break;
        }
    ?>

    </div>

<?php $this->view('includes/footer')?>
