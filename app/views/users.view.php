<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">

<!-- search -->
<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
    <div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search">&nbsp</i></span>
    <input type="text" class="form-control" placeholder="Search..." aria-label="Username" aria-describedby="basic-addon1" >
    </div>
    </form>
    <a href="<?=BASE?>signup">
        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
    </a>
</nav>

    <div class="card-group justify-content-center">

    <?php if($rows):?>
    <?php foreach($rows as $row):?> 

                <?php 
                    // $image = get_image($row->image);
                ?>

    <div class="card m-2 shadow" style="max-width: 14rem;min-width:14rem;">
    <div class="card-header">User Profile</div>
    <img src="<?=get_image("user.png")?>" alt="card-img-top" class="card-img-top" style=" ">
    <div class="card-body">
    <h5 class="card-title"><?=$row->username?></h5>
    <a href="<?=BASE?>profile/<?=$row->user_id?>" class="btn btn-primary">Profile</a>
    </div>
    </div>
    <?php endforeach;?>
    <?php else:?>
        <h6>No staff members were found at this time!</h6>
    <?php endif;?>
    </div>


    </div>

    <?php $this->view('includes/footer'); ?>