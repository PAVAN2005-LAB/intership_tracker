// assets/js/admin.js
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('edit_intern_id').value = this.getAttribute('data-id');
            document.getElementById('edit_title').value = this.getAttribute('data-title');
            document.getElementById('edit_company').value = this.getAttribute('data-company');
            document.getElementById('edit_location').value = this.getAttribute('data-location');
            document.getElementById('edit_description').value = this.getAttribute('data-description');
        });
    });
});
