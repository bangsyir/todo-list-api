<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTodoModalLabel">Add Todo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success d-none" id="addAlertSuccess">
          Hello
        </div>
        <div class="alert alert-danger d-none" id="limitAlertSuccess">
          Hello
        </div>
        <form method="POST" class="todoForm" id="addTodoForm">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="input title">
            <small id="title-error" class="text-danger d-none">error message</small>
          </div>
          <div>
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control" placeholder="input description" rows="5"></textarea>
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