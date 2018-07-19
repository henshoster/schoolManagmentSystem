
<div class="my-5 card shadow" id="edit_tpl">
    <form action="<?=str_replace('edit', 'save', "index.php?{$_SERVER['QUERY_STRING']}")?>" class="needs-validation" method="post" novalidate enctype="multipart/form-data">
    <input type="hidden" name="last_action" value="<?=$_GET['action']?>">
    <div class="row  mx-3 mt-3">
        <div class="col lead">
            Edit <?=ucfirst(substr($this_type_name, 0, -1))?>
        </div>
        <div class="col lead text-right">
            <button id="save_btn" class="btn btn-outline-primary">Save</button>
            <?php if (!($this_type_name == 'courses' && count($connected_type_info) > 0)) {?>
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteConfirmationModal">Delete</button>
            <?php }?>
        </div>
    </div>
    <div class="dropdown-divider mb-4"></div>
    <?php
unset($this_type_info['id']);
foreach ($this_type_info as $key => $value) {
    if ($key == 'image_src') {?>
        <div class="row m-3">
            <div class="col-4">
                <img id="editDisplayImage" class="mw-100" src="<?=$value?>">
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
            <input id="<?=$key?>" name="<?=$key?>" class="form-control" type="text" value="<?=$value?>"  required>
            <label class="form-control-placeholder customclass" for="<?=$key?>"><?=ucfirst($key)?></label>
            <div class="invalid-feedback">
                Please choose a <?=$key?>.
            </div>
        </div>
<?php }}?>
        <div class="row m-2">
            <?php if ($this_type_name == 'students') {?>
            <div class="col-3 text-right lead">
                <?=ucfirst($connected_type_name) . ":"?>
            </div>
            <div class="col">
            <div class="row m-1">
    <?php $i = 0;foreach (${$connected_type_name} as $row) {
    if ($i % 2 == 0 && $i != 0) {?>
            </div>
            <div class="row m-1">
         <?php }?>
            <div class="custom-control custom-checkbox col-4">
                <input type="checkbox" class="custom-control-input" name="<?=$connected_type_name . "[]"?>" id="<?=$row['id']?>" value="<?=$row['id']?>" <?=isset($connected_type_info[$row['id']]) ? 'checked' : ''?>>
                <label class="custom-control-label" for="<?=$row['id']?>"><?=$row['name']?></label>
            </div>
   <?php $i++;}?>
            </div>
            <?php } else { $sumStudents = count($connected_type_info);?>
            <span class="m-auto">Total <?=$sumStudents?> Student<?=count($connected_type_info) != 1 ? "s" : ""?> taking this course</span>
            <?php }?>
        </div>
    </form>
</div>
