
<nav id="header" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="./">The School</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if ($classification != 0) {?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?route=school">School</a>
                </li>
                <?php }if ($classification > 1) {?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?route=admin">Administration</a>
                </li>
                <?php }?>
            </ul>
            <?php if ($loggedInUser != null) {
    $name = ucfirst($loggedInUser['name']);
    $role = ucfirst($loggedInUser['role']);
    $image_src = $loggedInUser['image_src'];?>
            <div class="navbar-text">
                <span class="font-weight-bold">
                    <?=$name?>, <?=$role?>
                </span>
                <span class="d-block text-right">
                    <a href="index.php?action=logout" class="text-info">Logout</a>
                </span>
            </div>
            <div class="navbar-text">
                <img src="<?=$image_src?>" class="ml-3">
            </div>
            <?php } else {?>
            <div class="navbar-text">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#logInModal">Login</button>
            </div>
            <?php }?>
        </div>
    </div>
</nav>

