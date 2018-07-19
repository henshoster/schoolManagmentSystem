
<div class="my-5 card shadow" id="edit_tpl">
    <form action="<?=str_replace('newentityform', 'save', "index.php?{$_SERVER['QUERY_STRING']}")?>" class="needs-validation" method="post" novalidate enctype="multipart/form-data">
    <input type="hidden" name="last_action" value="<?=$_GET['action']?>">
    <div class="row  mx-3 mt-3">
        <div class="col lead">
            New <?=ucfirst(substr($_GET['type'], 0, -1))?>
        </div>
        <div class="col lead text-right">
            <button id="save_btn" class="btn btn-outline-primary">Add</button>
        </div>
    </div>
    <div class="dropdown-divider mb-4"></div>
    <?php
foreach ($type_columns_names as $value) {
    if ($value == 'image_src') {?>
        <div class="row m-3">
            <div class="col-4">
                <img id="editDisplayImage" class="mw-100" src="<?=$_GET['type'] == 'students' ? 'images/user.png' : 'images/course.png'?>">
                <input type="hidden" name="<?=$value?>" value="<?=$_GET['type'] == 'students' ? 'images/user.png' : 'images/course.png'?>">
            </div>
            <div class="form-group  col m-auto">
                <label for="fileToUpload">Change image</label>
                <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
            </div>
            <div id="clientSideImageValidation" class="alert alert-warning alert-dismissible fade show my-1 mx-auto d-none" role="alert">
                    <strong>Warning!</strong><br> Maximum size for upload is 500KB!<br>Please change the image!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <?php if (isset($_GET['upload_error'])) {?>
            <div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
                <strong>Error: </strong> <?=$_GET['upload_error']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php }?>
        </div>
    <?php } else {
        ?>
        <div class="form-group col-8 mx-auto">
            <input id="<?=$value?>" name="<?=$value?>" class="form-control" type="text" required>
            <label class="form-control-placeholder" for="<?=$value?>"><?=ucfirst($value)?></label>
            <div class="invalid-feedback">
                Please choose a <?=$value?>.
            </div>
        </div>
<?php }}?>
        <div class="row m-2">
            <?php if ($_GET['type'] == 'students') {?>
            <div class="col-3 text-right lead">
                Courses:
            </div>
            <div class="col">
            <div class="row m-1">
    <?php $i = 0;foreach ($courses as $row) {
    if ($i % 2 == 0 && $i != 0) {?>
            </div>
            <div class="row m-1">
         <?php }?>
            <div class="custom-control custom-checkbox col-4">
                <input type="checkbox" class="custom-control-input" name="courses[]" id="<?=$row['id']?>" value="<?=$row['id']?>">
                <label class="custom-control-label" for="<?=$row['id']?>"><?=$row['name']?></label>
            </div>
   <?php $i++;}?>
            </div>
            <?php }?>
        </div>
    </form>
</div>
