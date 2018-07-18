
<div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="logInModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logInModalTitle">Log in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
if (!empty($_GET['loginerror'])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>error!</strong> <?=$_GET['loginerror']?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
    </div>
    <?php
}
?>
        <form action="index.php?action=logIn" method="post">
            <div class="row pt-1">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="user_name_login" name="user_name_login" class="form-control" type="text" required>
                        <label class="form-control-placeholder" for="user_name_login">User name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="password_login" name="password_login" class="form-control" type="password" required>
                        <label class="form-control-placeholder" for="password_login">Password</label>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button name="log_in" type="submit" class="btn btn-outline-primary">Log-in</button>
        </form>
      </div>
    </div>
  </div>
</div>