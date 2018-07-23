
<div class="my-5 card shadow">
    <div class="row  mx-3 mt-3">
        <div class="col lead">
            <?=ucfirst(substr($this->this_type_name, 0, -1))?>
        </div>
        <?php
//Prevents from admin type of 'Sales' to edit courses.
if (!($this->model->getClassification() < 2) || ($_GET['type'] != 'courses')) {?>
            <div class="col lead text-right">
            <a href="<?=str_replace('showdetails', 'editentity', "index.php?{$_SERVER['QUERY_STRING']}")?>" class="btn btn-outline-primary">Edit</a>
        </div>
        <?php }?>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row m-3">
        <div class="col-4"  id="details_img">
            <img src="<?=$this->selected_entity_info['image_src']?>">
        </div>
        <div class="col">
            <div class="navbar-text align-middle">
                <h5 class="card-title"><?=$this->selected_entity_info['name']?>
                <?php if ($_GET['type'] == 'courses') {
    $sumStudents = count($this->connected_type_info);
    echo " ,$sumStudents Student" . ($sumStudents != 1 ? "s" : "");}?>
                </h5>
                <?php
unset($this->selected_entity_info['image_src']);
unset($this->selected_entity_info['name']);
unset($this->selected_entity_info['id']);
foreach ($this->selected_entity_info as $value) {?>
                <div>
                    <?=$value?>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
    <h5 class="mx-3"><u><?=$this->connected_type_name?>:</u></h5>
    <?php foreach ($this->connected_type_info as $row) {?>
    <div class="row m-1">
        <div class="col-2">
            <img class="mw-100" src="<?=$row['image_src']?>">
        </div>
        <div class="col lead navbar-text align-middle"><?=$row['name']?></div>
    </div>
    <?php }?>

</div>
