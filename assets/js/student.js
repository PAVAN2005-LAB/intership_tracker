// assets/js/student.js
$(document).ready(function() {
    // 1. Fetch Internships on page load
    fetchInternships();

    function fetchInternships() {
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: { action: 'fetch' },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    let container = $('#internshipsContainer');
                    container.empty();
                    
                    if(response.data.length === 0) {
                        container.append('<div class="col-12"><div class="alert alert-info">No internships found.</div></div>');
                        return;
                    }

                    $.each(response.data, function(index, intern) {
                        let btnHtml = '';
                        if(intern.has_applied) {
                            btnHtml = `<button class="btn btn-secondary w-100 mt-3" disabled>Already Applied</button>`;
                        } else {
                            btnHtml = `<button class="btn btn-success w-100 mt-3 apply-btn" data-id="${intern.id}">Apply Now</button>`;
                        }

                        let card = `
                        <div class="col-md-4 mb-4 intern-card">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title intern-title">${intern.title}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted intern-company">${intern.company}</h6>
                                    <p class="card-text mb-1"><small class="text-muted intern-location">📍 ${intern.location}</small></p>
                                    <p class="card-text mt-2">${intern.description}</p>
                                </div>
                                <div class="card-footer bg-white border-top-0">
                                    ${btnHtml}
                                </div>
                            </div>
                        </div>
                        `;
                        container.append(card);
                    });
                }
            },
            error: function() {
                alert("Failed to fetch internships.");
            }
        });
    }

    // 2. Search Functionality via keyup
    $('#searchInput').keyup(function() {
        let val = $(this).val().toLowerCase();
        $('.intern-card').filter(function() {
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(val) > -1);
        });
    });

    // 3. Open Apply Modal Instance
    let currentInternBtn = null;
    let applyModal = new bootstrap.Modal(document.getElementById('applyModal'));

    $(document).on('click', '.apply-btn', function() {
        currentInternBtn = $(this);
        // Map the Hidden ID payload
        $('#modal_intern_id').val(currentInternBtn.data('id'));
        applyModal.show();
    });

    // 4. Capture Form Submit and Transmit using FormData
    $('#applyForm').on('submit', function(e) {
        e.preventDefault();
        let btn = $('#confirmApplyBtn');
        btn.prop('disabled', true).text('Uploading...');

        let formData = new FormData(this);

        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: formData,
            processData: false, // Core req for file uploads
            contentType: false, // Core req for file uploads
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    alert(response.message);
                    applyModal.hide();
                    
                    // Update frontend button states seamlessly
                    currentInternBtn.removeClass('apply-btn btn-success').addClass('btn-secondary').text('Already Applied');
                    btn.prop('disabled', false).text('Submit Application');
                    
                    // Force a rapid reload to update the $_SESSION/PHP layout logic so future clicks show the layout acknowledging they now have a resume
                    window.location.reload();
                } else {
                    alert(response.message);
                    btn.prop('disabled', false).text('Submit Application');
                }
            },
            error: function() {
                alert('An error occurred whilst pushing your application constraints.');
                btn.prop('disabled', false).text('Submit Application');
            }
        });
    });
});
