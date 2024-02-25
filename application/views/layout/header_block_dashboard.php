<nav class="navbar fixed-top bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img class="img-fluid" src="<?=base_url('assets/img/logo/logo_300x119.png')?>">
    </a>
    <div class="d-none d-md-block">
      <h5 class="text-white m-0">Hi, <?= ucfirst($user_data[0]->full_name);?></h5>
    </div>
    <div>
      <a class="me-3 me-lg-5 text-decoration-none btn btn-outline-light" href="<?=base_url('user/logout'); ?>">Logout</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Tasker</h5>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="d-block d-md-none">
          <h3 class="text-white">Hi, <?= $user_data[0]->full_name?></h3>
        </div>
        <?php if ( $user_data[0]->role_id == 1) { ?>
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?=base_url('dashboard')?>">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url('user')?>">Manage User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url('project')?>">Manage Project</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url('task')?>">Manage Task</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url('assign')?>">Assign Projects</a>
            </li>
          </ul>
        <?php }elseif ( $user_data[0]->role_id == 2 ) { ?>
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" href="<?=base_url('task')?>">Manage Task</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url('profile/'.$user_data[0]->user_id)?>">My Profile</a>
            </li>
          </ul>
        <?php } ?>
      </div>
      <div class="offcanvas-footer">
        <div class="d-flex justify-content-center sidebar_logo mb-3">
          <img class="img-fluid" src="<?=base_url('assets/img/logo/logo_300x300.png')?>">
        </div>
      </div>
    </div>
  </div>
</nav>