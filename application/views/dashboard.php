<?php if ($user_data[0]->role_id == 1) {?>

	<section class="pt-md-5 pt-4 d-flex flex-fill">
		<div class="container-fluid">
			<div class="d-flex gap-3 justify-content-center flex-column flex-md-row">
				<div class="card col-md-3 bg-danger text-center">
					<a class="text-black text-decoration-none" href="<?=base_url('user')?>">
						<div class="card-body">
							<div>
								<h4>Total Users</h4>
							</div>
							<div>
								<h5><?= ($users_total-1) ?></h5>
							</div>
						</div>
					</a>
				</div>
				<div class="card col-md-3 bg-success text-center">
					<a class="text-black text-decoration-none" href="<?=base_url('project')?>">
						<div class="card-body">
							<div>
								<h4>Total Projects</h4>
							</div>
							<div>
								<h5><?= $projects_total ?></h5>
							</div>
						</div>
					</a>
				</div>
				<div class="card col-md-3 bg-warning text-center">
					<a class="text-black text-decoration-none" href="<?=base_url('task')?>">
						<div class="card-body">
							<div>
								<h4>Total Tasks</h4>
							</div>
							<div>
								<h5><?= $tasks_total ?></h5>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

<?php } 
else if ($user_data[0]->role_id == 2) {?>

	<section class="pt-md-5 pt-4">
		<div class="container-fluid">
			<div class="d-flex gap-3 justify-content-center flex-column flex-md-row">
				<div class="card col-md-3 bg-success text-center">
					<a class="text-black text-decoration-none" href="<?=base_url('project')?>">
						<div class="card-body">
							<div>
								<h4>Total Projects</h4>
							</div>
							<div>
								<h5><?= $projects_total ?></h5>
							</div>
						</div>
					</a>
				</div>
				<div class="card col-md-3 bg-warning text-center">
					<a class="text-black text-decoration-none" href="<?=base_url('task')?>">
						<div class="card-body">
							<div>
								<h4>Total Tasks</h4>
							</div>
							<div>
								<h5><?= $tasks_total ?></h5>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

<?php } ?>