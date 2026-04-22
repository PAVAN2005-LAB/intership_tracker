<?php // includes/admin_modals.php ?>
<!-- Create Internship Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="admin.php">
          <div class="modal-header">
            <h5 class="modal-title">Create Internship</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
             <input type="hidden" name="action" value="create_internship">
             <div class="mb-3">
                 <label>Title</label>
                 <input type="text" name="title" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label>Company</label>
                 <input type="text" name="company" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label>Location</label>
                 <input type="text" name="location" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label>Description</label>
                 <textarea name="description" class="form-control" rows="3" required></textarea>
             </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Internship Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="admin.php">
          <div class="modal-header">
            <h5 class="modal-title">Edit Internship</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
             <input type="hidden" name="action" value="edit_internship">
             <input type="hidden" name="intern_id" id="edit_intern_id">
             <div class="mb-3">
                 <label>Title</label>
                 <input type="text" name="title" id="edit_title" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label>Company</label>
                 <input type="text" name="company" id="edit_company" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label>Location</label>
                 <input type="text" name="location" id="edit_location" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label>Description</label>
                 <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
             </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
      </form>
    </div>
  </div>
</div>
