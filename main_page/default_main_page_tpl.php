<?php
require_once "main_page/dirView.php";
require_once "main_page/dirModel.php";
$dirTree = new dirView(new dirModel);
?>
<div class="container">
    <h1 class="display-4 m-3 text-center">Welcome to The School</h1>
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