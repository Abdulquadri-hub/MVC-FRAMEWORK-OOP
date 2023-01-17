<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

    <div class="container-fluid">
        <h4><i class="fa fa-plus"></i><?=APP ?> <br> <?=DESC?></h4>
        <?php show($rows) ?>
    </div>

<?php $this->view('includes/footer')?>
