<div class="bgc-white p-20 bd">
    <div class="d-flex">
        <h3 class="c-grey-900">Create Task</h3>
    </div>
    <div class="mT-30">
        <form id="createTask" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title task ">
                </div>

                <div class="mb-3 col-md-8">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="summernote" class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-color">Save Task</button>
            <a href="<?php echo BASE_URL;?>" type="submit" class="btn btn-info btn-color">Back</a>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        //change textarea to summernote
        $('#summernote').summernote({
            placeholder: 'Descriptions your task',
            tabsize: 2,
            height: 320,
            callbacks: {
                onChange: function(contents, $editable) {
                    // Update hidden input field with Summernote content
                    $('#description').val(contents);
                }
            }
        });

        $('#createTask').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = new FormData(this);

            // request to create task
            $.ajax({
                url: '<?php echo BASE_URL;?>/save', 
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response.status);

                    if (response.status === 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500  
                        });
                        return;
                    }

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Task created successfully!',
                            showConfirmButton: false,
                            timer: 1500  
                        }).then(function() {
                            // Redirect to task list
                            window.location.href = '<?php echo BASE_URL;?>';
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    Swal.fire('Error creating task: ' + textStatus);
                }
            });

        });
    });
</script>