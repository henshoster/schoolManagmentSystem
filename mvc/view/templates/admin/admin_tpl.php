
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Administrators <a href="index.php?route=admin&action=newentityform&type=administrators"><img src="images/plus.png"  class="float-right"></a></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($administrators as $admin) {?>
                    <tr>
                        <td>
                            <a href="index.php?route=admin&action=edit&type=administrators&id=<?=$admin['id']?>">
                            <div class="d-inline-block align-middle">
                                <span class="lead"><?=$admin['name']?>, <?=ucfirst($admin['role'])?></span>
                                <small class="d-block text-muted"><?=$admin['phone']?></small>
                                <small class="d-block text-muted"><?=$admin['email']?></small>
                            </div>
                            <div class="navbar-text align-middle float-right">
                                <img src="<?=$admin['image_src']?>">
                            </div>
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-8 align-top mx-auto">
            <?php include $main_container_tpl?>
        </div>
    </div>
</div>
