<div class="container">
    <h1 class="display-4 m-3 text-center">Welcome to The School</h1>
    <div class="dropdown-divider mb-4"></div>
    <div class="row">
        <div class="col-md-6">
            <?php include 'mvc/view/templates/main_page/general_info_tpl.html';?>
        </div>
        <div class="col-md-6">
            <p class="lead">File structure view:</h4>
            <ul>
                <li><span class="text-success">The School</span>
                    <ul>
                    <?=$this->treePrint($this->directoryStucture, 0)?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>