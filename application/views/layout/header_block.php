<!-- header -->
<nav id="mainMenu" class="navbar navbar-expand-lg bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url();?>">
    	<img class="img-fluid" src="<?=base_url('assets/img/logo/logo_300x114.png')?>">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-5">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?=base_url()?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('user/login')?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('user/signup')?>">Sign Up</a>
          </li>
        </ul>
      </div>
      <div class="offcanvas-footer d-md-none d-block">
        <div class="d-flex justify-content-center sidebar_logo mb-3">
          <img class="img-fluid" src="<?=base_url('assets/img/logo/logo_blue_300x300.png')?>">
        </div>
      </div>
    </div>
  </div>
</nav>