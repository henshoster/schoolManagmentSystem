<?php
require_once "main_page/dirView.php";
require_once "main_page/dirModel.php";
$dirTree = new dirView(new dirModel);
if (isset($_POST['reset_owner'])) {
    $ownerPassword = password_hash('admin', PASSWORD_DEFAULT);
    $ownerColumns = ['id', 'name', 'role', 'phone', 'email', 'password', 'image_src'];
    $ownerValues = [null, 'Bill Gates', 'owner', '050-1234567', 'admin@theschool.com', "$ownerPassword", 'images/user.png'];
    $this->model->update('administrators', $ownerColumns, $ownerValues, "id='1'");
    echo "<script type='text/javascript'>alert('Owner Password has been reset');</script>";
}

?>
<div class="container">
    <h1 class="display-4 m-3 text-center">Welcome to The School</h1>
    <div class="alert alert-danger text-center" role="alert">
        This is a demo site of the service to allow everyone to experiment with the system.
        We ask you not to upload offensive content to the site.<br>
        <span class="lead">Owner-Email: admin@theschool.com | Owner-Password: admin</span>
        <hr>
        <form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>">
        Please do not edit Owner email or password, in case someone did it anyway <button name="reset_owner" type="submit" class="btn btn-danger">Click here</button> for reset
        </form>
    </div>
    <div class="dropdown-divider mb-4"></div>
    <div class="row">
        <div class="col-md-8">
            <?php include 'main_page/general_info_tpl.html';?>
        </div>
        <div class="col-md-4">
        <p>
            <span class="lead">File structure view:</span> <br>
            <small>Contains all the folders and files from the root folder, excluding folders starting with '.' (dot)</small>
        </p>
            <ul>
                <li><span class="text-success">The School</span>
                    <ul>
                    <?=$dirTree->treePrint()?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>