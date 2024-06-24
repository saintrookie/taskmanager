<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="c-grey-900 mT-10 mB-30">Task List</h3>
        <!-- Create Task -->
        <a href="<?php echo BASE_URL;?>/create" class="btn btn-primary btn-sm">Create Task</a>
    </div>
    
    <div class="mb-3 d-flex flex-column">

        <div class="">
            <!-- Filters -->
            <form id="filterTask" action="<?php echo BASE_URL;?>" method="GET">
                <div class="row g-2 align-items-center">
                    
                    <div class="col-auto">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Search tasks..." value="<?php if(isset($_GET['title'])) echo($_GET['title']) ?>">
                    </div>
                    
                    <div class="col-auto">
                        <select id="status" name="status" class="form-control">
                            <option value="">-- Select Status --</option>
                            <option value="Pending" <?php if(isset($_GET['status'])) echo $_GET['status'] == 'Pending' ? 'selected' : ''?>>Pending</option>
                            <option value="Completed" <?php if(isset($_GET['status'])) echo $_GET['status'] == 'Completed' ? 'selected' : ''?>>Completed</option>
                            <option value="In Progress" <?php if(isset($_GET['status'])) echo $_GET['status'] == 'In Progress' ? 'selected' : ''?>>In Progress</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm text-white">Apply Filters</button>
                        <button id="resetFilters" class="btn btn-primary btn-sm text-white">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

     <!-- Data -->
    <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Create At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <!-- Task Data -->
                    <tbody>
                        <?php if (!empty($data['tasks'])) { foreach ($data['tasks'] as $task) { ?>
                            <tr>
                                <td><?php echo $task['title']; ?></td>
                                <td><?php echo $task['description']; ?></td>
                                <td>
                                     <!-- Task Data Status -->
                                    <?php if($task['status'] === 'Pending') { ?>
                                    <span class="badge text-bg-warning text-black-50">
                                        <?php echo $task['status']; ?>
                                    </span>
                                    <?php } else if($task['status'] === 'In Progress') { ?>
                                    <span class="badge text-bg-info text-black-50">
                                        <?php echo $task['status']; ?>
                                    </span>
                                    <?php } else if($task['status'] === 'Completed') { ?>
                                    <span class="badge text-bg-success text-black-50">
                                        <?php echo $task['status']; ?>
                                    </span>
                                    <?php } ?>
                                </td>
                                 <!-- Function Time From controllers/baseController.php -->
                                <td><?php echo $this->formatDate($task['created_at']); ?></td>
                                <td><?php echo $this->formatDate($task['updated_at']); ?></td>
                                <td>
                                    <div class="row">
                                        <div class="d-grid gap-3">
                                            <?php if($task['status'] === 'Pending') { ?>
                                                <div data-id="<?php echo $task['id']; ?>" data-status="In Progress" class="btn btn-info btn-sm text-white updateStatus">In Progress</div>
                                            <?php } else if($task['status'] === 'In Progress') { ?>
                                                <div data-id="<?php echo $task['id']; ?>" data-status="Completed" class="btn btn-success btn-sm text-white updateStatus">Completed</div>
                                            <?php } else {} ?>
                                            <a href="/taskmanager/index.php/view?id=<?php echo $task['id']; ?>" class="btn btn-success btn-sm">View</a>
                                            <div data-id="<?php echo $task['id']; ?>" class="btn btn-danger btn-sm text-white deleteTask">Remove</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }  } else { ?>
                            <tr>
                                <td colspan="6" class="text-center">No tasks found.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($data['total_pages'] > 1) {
                            for ($i = 1; $i <= $data['total_pages']; $i++) { ?>
                                <li class="page-item <?php echo $data['current_page'] == $i ? 'active' : ''; ?>">
                                    <a class="page-link text-dark <?php echo $data['current_page'] == $i ? 'text-white' : ''; ?>" href="<?php echo BASE_URL;?>?page=<?php echo $i . (isset($_GET['keyword']) ? '&keyword=' . $_GET['keyword'] : ''); ?>"><?php echo $i; ?></a>
                                </li>
                        <?php } } ?>
                    </ul>
                </nav>
                <script>
                    // Update status
                    $(document).ready(function() {
                        $('.updateStatus').on('click', function() {
                            var id = $(this).data('id');
                            var status = $(this).data('status');
                            
                            $.ajax({
                                url: '<?php echo BASE_URL;?>/updateStatus',
                                type: 'POST',
                                data: { id: id, status: status },
                                success: function(response) {

                                    if(response.status === 'success') {
                                         Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: 'Update status task successfully!',
                                            showConfirmButton: false,
                                            timer: 1500  
                                        }).then(function() {
                                            // Reload the page
                                            window.location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Something went wrong!',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        return;
                                    }
                                   
                                }
                            });
                        });

                        // Delete Task
                        $('.deleteTask').on('click', function() {
                            var id = $(this).data('id');    

                            // Confirm delete
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // AJAX request to delete task
                                    $.ajax({
                                        url: '<?php echo BASE_URL;?>/deleteTask',
                                        type: 'GET',
                                        data: { id: id },
                                        success: function(response) {
                                            // Check if task was deleted
                                            if(response.status === 'success') {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success!',
                                                    text: 'Task deleted successfully!',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {
                                                    // Reload the page
                                                    window.location.reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error!',
                                                    text: 'Something went wrong!',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                return;
                                            }
                                           
                                        }           

                                    });
                                }
                            });
                        });

                        // Reset filters
                        $('#resetFilters').on('click', function() {
                            // Reset filters form fields
                            $('#title').val('');
                            $('#status').val('');
                            
                            // Remove URL filters parameters for title and status
                            var url = new URL(window.location.href);
                            url.searchParams.delete('title');
                            url.searchParams.delete('status');
                            
                            // Redirect to updated URL without parameters
                            window.location.href = url.toString();
                        });
                                                                
                    });
                </script>
            </div>
        </div>
    </div>
</div>
