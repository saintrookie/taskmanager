<div class="bgc-white p-20 bd">
    <div class="d-flex">
        <h3 class="c-grey-900">View Task</h3>
    </div>
    <div class="mT-30">
        <form id="updateTask" method="POST" >
            <!-- get data from controller -->
            <input type="hidden" id="id" name="id" value="<?php echo $data['task']['id']; ?>">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title task " value="<?php echo $data['task']['title']; ?>">
                </div>

                <div class="mb-3 col-md-8">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="summernote" class="form-control" name="description"><?php echo $data['task']['description']; ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-color">Update Task</button>
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

        
        $('#updateTask').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var title = $('#title').val();
            var desc = $('#summernote').val();
            var id = $('#id').val();

            // request to update task
            $.ajax({
                url: '<?php echo BASE_URL;?>/update', 
                type: 'POST',
                data: { title: title, description: desc, id: id },
                success: function(response) {
                    //check response
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Update Task successfully!',
                            showConfirmButton: false,
                            timer: 1500  
                        }).then(function() {
                            // Redirect to task list
                            window.location.href = '<?php echo BASE_URL;?>';
                        });
                    } else {

                        Swal.fire('Error updating task: ' + response.message);
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    Swal.fire('Error updating task: ' + textStatus);
                }
            });

        });

    });
</script>