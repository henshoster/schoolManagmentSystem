
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
unset($this->administrators[0]['id']);
foreach ($this->administrators[0] as $key => $value) {
    if ($key == 'image_src') {?>
        <div class="row m-3">
            <?php if (isset($_GET['upload_error'])) {?>
            <div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
                <strong>Error: </strong> <?=$_GET['upload_error']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php }?>
            <div class="col-4">
                <img id="editDisplayImage" class="mw-100" src='images/user.png'>
                <input type="hidden" name="<?=$key?>" value='images/user.png'>
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
        </div>
        <?php } elseif ($key == 'role') {?>
        <div class="form-group col-8 mx-auto">
            <select class="custom-select" name='<?=$key?>' id='<?=$key?>' required>
                <option selected disabled value=""></option>
                <option value="sales">Sales</option>
                <option value="manager">Manager</option>
            </select>
            <label class="form-control-placeholder" for="<?=$key?>"><?=ucfirst($key)?></label>
            <div class="invalid-feedback">
                Please choose a <?=$key?>.
            </div>
        </div>
        <?php } else {?>
        <div class="form-group col-8 mx-auto">
            <?php if ($key == 'description') {?>
            <textarea id="<?=$key?>" name="<?=$key?>" class="form-control" cols="30" rows="4" required></textarea>
            <?php } else {?>
            <input id="<?=$key?>" name="<?=$key?>" class="form-control" type="<?=($key != 'email' && $key != 'password') ? 'text' : $key?>" required>
            <?php }?>
            <label class="form-control-placeholder" for="<?=$key?>"><?=ucfirst($key)?></label>
            <div class="invalid-feedback">
                Please choose a <?=$key?>.
            </div>
        </div>
<?php }}?>
    </form>
</div>
