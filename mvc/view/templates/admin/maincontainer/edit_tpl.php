
<div class="my-5 card shadow" id="edit_tpl">
    <form action="<?=str_replace('edit', 'save', "index.php?{$_SERVER['QUERY_STRING']}")?>" class="needs-validation" method="post" novalidate enctype="multipart/form-data">
    <input type="hidden" name="last_action" value="<?=$_GET['action']?>">
    <div class="row  mx-3 mt-3">
        <div class="col lead">
            Edit <strong><?=ucfirst($selected_admin_info['name'])?> (<?=ucfirst($selected_admin_info['role'])?>)</strong>
        </div>
        <div class="col lead text-right">
            <button id="save_btn" class="btn btn-outline-primary">Save</button>
            <?php if ($selected_admin_info['role'] != 'owner') {?>
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteConfirmationModal">Delete</button>
            <?php }?>

        </div>
    </div>
    <div class="dropdown-divider mb-4"></div>
    <?php
unset($selected_admin_info['id']);
foreach ($selected_admin_info as $key => $value) {
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
        <?php } elseif ($key == 'role') {?>
        <div class="form-group col-8 mx-auto">
            <select class="custom-select" name='<?=$key?>' id='<?=$key?>' required>
                <?php if ($value == 'owner') {?>
                <option value="owner" selected disabled>Owner (Cannot be modified)</option>
                <?php } else {?>
                <option value="sales" <?=$value == 'sales' ? 'selected' : ''?>>Sales</option>
                <option value="manager" <?=$value == 'manager' ? 'selected' : ''?>>Manager</option>
                <?php }?>
            </select>
            <label class="form-control-placeholder customclass" for="<?=$key?>"><?=ucfirst($key)?></label>
            <div class="invalid-feedback">
                Please choose a <?=$key?>.
            </div>
        </div>
        <?php } else {?>
        <div class="form-group col-8 mx-auto">
            <?php if ($key != 'password') {?>
                <input id="<?=$key?>" name="<?=$key?>" class="form-control" type="<?=$key != 'email' ? 'text' : $key?>" value="<?=$value?>"  required>
                <label class="form-control-placeholder customclass" for="<?=$key?>"><?=ucfirst($key)?></label>
            <?php } else {?>
                <input id="<?=$key?>" name="<?=$key?>" class="form-control" type="password">
                <label class="form-control-placeholder" for="<?=$key?>">Change Password (Optional)</label>
            <?php }?>

            <div class="invalid-feedback">
                Please choose a <?=$key?>.
            </div>
        </div>
<?php }}?>

    </form>
</div>
