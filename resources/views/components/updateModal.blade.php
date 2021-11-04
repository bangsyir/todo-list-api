<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateTodoModalLabel">Update Todo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success d-none" id="updateAlertSuccess">
          Hello
        </div>
        <form method="POST" class="todoForm" id="updateTodoForm">
          <input type="hidden" name="id" id="update-id">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="update-title" class="form-control" placeholder="input title">
            <small id="title-error" class="text-danger d-none">error message</small>
          </div>
          <div>
            <label for="description">description</label>
            <textarea name="description" id="update-description" class="form-control" placeholder="input description" rows="5"></textarea>
            <small id="description-error" class="text-danger d-none">error message</small>
          </div>
          <div class="float-right pt-2">
            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>