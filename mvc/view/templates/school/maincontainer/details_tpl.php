
<div class="my-5 card shadow">
    <div class="row  mx-3 mt-3">
        <div class="col lead">
            <?=ucfirst(substr($this_type_name, 0, -1))?>
        </div>
        <div class="col lead text-right">
            <a href="<?=str_replace('showdetails', 'edit', "index.php?{$_SERVER['QUERY_STRING']}")?>" class="btn btn-outline-primary">Edit</a>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row m-3">
        <div class="col-4"  id="details_img">
            <img src="<?=$this_type_info['image_src']?>">
        </div>
        <div class="col">
            <div class="navbar-text align-middle">
                <h5 class="card-title"><?=$this_type_info['name']?>
                <?php if ($_GET['type'] == 'courses') {
    $sumStudents = count($connected_type_info);
    echo " ,$sumStudents Student" . ($sumStudents != 1 ? "s" : "");}?>
                </h5>
                <?php
unset($this_type_info['image_src']);
unset($this_type_info['name']);
unset($this_type_info['id']);
foreach ($this_type_info as $value) {?>
                <div>
                    <?=$value?>
                </div>
                <?php }?>
            </div>
        </div>
    </div>

    <?php foreach ($connected_type_info as $row) {?>
    <div class="row m-1">
        <div class="col-2">
            <img class="mw-100" src="<?=$row['image_src']?>">
        </div>
        <div class="col lead navbar-text align-middle"><?=$row['name']?></div>
    </div>
    <?php }?>

</div>
