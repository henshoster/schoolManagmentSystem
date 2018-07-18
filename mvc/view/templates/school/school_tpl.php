<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Courses <a href="index.php?route=school&action=newentityform&type=courses"><img src="images/plus.png"  class="float-right"></a></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($courses as $course) {?>
                    <tr>
                        <td>
                            <a href="index.php?route=school&action=showdetails&type=courses&id=<?=$course['id']?>">
                            <div class="navbar-text align-middle">
                                <span class="lead"><?=$course['name']?></span>
                                <span class="d-block truncate"><?=$course['description']?></span>
                            </div>
                            <div class="navbar-text align-middle float-right">
                                <img src="<?=$course['image_src']?>">
                            </div>
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Students <a href="index.php?route=school&action=newentityform&type=students"><img src="images/plus.png"  class="float-right"></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) {?>
                    <tr>
                        <td>
                            <a href="index.php?route=school&action=showdetails&type=students&id=<?=$student['id']?>">
                            <div class="navbar-text align-middle">
                                <span class="lead"><?=$student['name']?></span>
                                <span class="d-block"><?=$student['phone']?></span>
                            </div>
                            <div class="navbar-text align-middle float-right">
                                <img src="<?=$student['image_src']?>">
                            </div>
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 align-top mx-auto">
            <?php include $main_container_tpl?>
        </div>
    </div>
</div>
