<section class="flex-grow-1 overflow-auto">
    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-center text-white">
            <h2 class="text-center">User List:</h2>
            <div class="border-bottom border-primary mb-2"></div>
            <div class="d-flex flex-column flex-md-row justify-content-between mb-2">
                <div class="d-flex gap-3 align-items-center flex-column flex-md-row">
                    <a class="btn btn-primary me-0 me-md-3 mb-2 mb-md-0" href="<?=base_url('user/admin_add_user')?>">Add User</a>
                    <h5 class="text-center text-md-start m-0">Total Users: <?=($total-1)?></h5>
                </div>
                <div class="d-block d-md-none border-bottom border-primary my-2"></div>
                <form action="" method="post" class="d-flex flex-column gap-2 align-items-center flex-md-row">
                    <label for="search_name">Search Project</label>
                    <input type="text" name="search_email" id="search_email" value="<?=!empty($this->session->userdata('search')) ? $this->session->userdata('search') : ''; $this->session->unset_userdata('search');?>">
                    <input type="submit" name="submit" value="Search">
                </form>
            </div>
            <span id="msg" class="mb-2 text-center"></span>
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead class="table-primary text-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)) { 
                            foreach($users as $user) {
                                $dt = new DateTime($user['created_at']);
                                $dt = $dt->format('m-d-Y')
                                ?>
                                <tr>
                                    <td>#<?=!empty($user['user_id']) ? $user['user_id'] : ''; ?></td>
                                    <td><?=!empty($user['full_name']) ? $user['full_name'] : ''; ?></td>
                                    <td><?=!empty($user['email']) ? $user['email'] : ''; ?></td>
                                    <td><?=$dt?></td>
                                    <td>
                                        <a href="<?=base_url('user/admin_edit_user/'.$user['user_id'])?>">Edit</a> |
                                        <a onclick="confirmDelete('<?=base_url('user/admin_delete_user')?>', '<?=$user['user_id']?>')" href="javascript:void(0);">Delete</a>
                                    </td>
                                </tr>

                            <?php }
                        } else {
                            echo "<td colspan='5'>No Records</td>";
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
    </div>
</section>