
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteConfirmationTitle">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Are you sure you want to delete this <?=ucfirst(substr($this_type_name, 0, -1));?> : <span class="font-weight-bold"><?=$this_type_info['name']?></span>?
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
                <a href="<?=str_replace('edit', 'deleteentity', "index.php?{$_SERVER['QUERY_STRING']}")?>" class="btn btn-outline-danger">Yes - Delete!</a>
    </div>
  </div>
</div>
