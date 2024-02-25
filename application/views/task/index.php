<section class="flex-grow-1 overflow-auto">
    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-center text-white">
            <h2 class="text-center">Task List:</h2>
            <div class="border-bottom border-primary mb-2"></div>
            <div class="d-flex flex-column flex-md-row justify-content-between mb-2">
                <div class="d-flex gap-3 align-items-center flex-column flex-md-row">
                    <a class="btn btn-primary me-0 me-md-3 mb-2 mb-md-0" href="<?=base_url('task/add')?>">Add Task</a>
                    <h5 class="text-center text-md-start m-0">Total Tasks: <?=$total?></h5>
                </div>
                <div class="d-block d-md-none border-bottom border-primary my-2"></div>
                <form action="" method="post" class="d-flex flex-column gap-2 align-items-center flex-md-row">
                    <label for="search_name">Search Task</label>
                    <input type="text" name="search_title" id="search_title" value="<?=!empty($this->session->userdata('search')) ? $this->session->userdata('search') : ''; $this->session->unset_userdata('search');?>">
                    <input type="submit" name="submit" value="Search">
                </form>
            </div>
        </div>
        <span id="msg" class="mb-2 text-center"></span>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead class="table-primary text-primary">
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Created At</th>
                        <?php if($this->session->userdata('role_id') == 1) { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($tasks)) { 
                        foreach($tasks as $task) {
                            $dt = new DateTime($task['created_at']);
                            $dt = $dt->format('m-d-Y');

                            $udt = new DateTime($task['due_date']);
                            $udt = $udt->format('m-d-Y');

                            $statusCls = "";
                            if(!empty($task['status']) && $task['status'] == 'Completed') {
                                $statusCls = "text-success";
                            } else if(!empty($task['status']) && $task['status'] == 'In Progress') {
                                $statusCls = "text-info";
                            } else {
                                $statusCls = "text-danger";
                            }
                            ?>
                            <tr>
                                <td>#<?=!empty($task['task_id']) ? $task['task_id'] : ''; ?></td>
                                <td><?=!empty($task['name']) ? $task['name'] : ''; ?></td>
                                <td><?=!empty($task['title']) ? $task['title'] : ''; ?></td>
                                <td><?=!empty($task['taskDesc']) ? $task['taskDesc'] : ''; ?></td>
                                <td><?=!empty($task['priority']) ? $task['priority'] : ''; ?></td>
                                <td class="<?=$statusCls;?>"><?=!empty($task['status']) ? $task['status'] : ''; ?></td>
                                <td><?=$udt; ?></td>
                                <td><?=$dt?></td>
                                <?php if($this->session->userdata('role_id') == 1) { ?>
                                    <td>
                                        <a href="<?=base_url('task/edit/'.$task['task_id'])?>">Edit</a> |
                                        <a onclick="confirmDelete('<?=base_url('task/delete')?>', '<?=$task['task_id']?>')" href="javascript:void(0);">Delete</a>
                                    </td>
                                <?php } ?>
                            </tr>

                        <?php } 
                    } else {
                        echo "<td colspan='6' class='text-center'>No Records</td>";
                    }?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <div id="pagination" class="d-flex justify-content-center mb-2">
                <?php echo $this->pagination->create_links();; ?>
            </div>
        </div>
    </div>
</section>