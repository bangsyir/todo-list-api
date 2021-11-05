<div class="modal fade" id="reminderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Set Todo Reminder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success d-none" id="reminderAlertSuccess"></div>
        <form method="POST" class="updateReminder" id="updateReminderForm">
          <input type="hidden" name="id" id="reminder-id">
          <div class="form-group">
            <label for="reminer">Date</label>
            <input type="date" name="reminder" id="update-remainder" class="form-control">
          </div>
          <div class="float-right pt-2">
            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>