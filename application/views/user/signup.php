
<img class="register-bg" src="<?=base_url('assets/img/body_bg.jpg'); ?>">
    <main class="register-main d-flex flex-column h-100 align-items-center justify-content-center">
      <div class="register-form card">
        <h5 class="text-center mb-0 mt-2 <?= $class ?>">
            <?php  
            if($this->session->userdata('success_msg')) {
                echo $this->session->userdata('success_msg');
                $this->session->unset_userdata('success_msg');
            } else if(!empty($success_msg)){ 
                echo $success_msg; 
            } else if(!empty($error_msg)){ 
                echo $error_msg; 
            } 
            ?>
        </h5>
        <form action="" method="post" name="signup" class="card-body flex-column d-flex">
          <h3 class="h3 mb-3 fw-normal text-center">Please sign up</h3>

          <?php echo form_error('full_name','<p class="m-0 '.$class.'">','</p>'); ?>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingFirstName" placeholder="John Doe" name="full_name">
              <label for="floatingInput">Full Name</label>
            </div>
            <span class="input-group-text">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>

          <?php echo form_error('email','<p class="m-0 '.$class.'">','</p>'); ?>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email">
              <label for="floatingInput">Email address</label>
            </div>
            <span class="input-group-text">
              <i class="fa-solid fa-at"></i>
            </span>
          </div>

          <?php echo form_error('password','<p class="m-0 '.$class.'">','</p>'); ?>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
              <label for="floatingPassword">Password</label>
            </div>
            <span class="input-group-text">
              <i class="fa-solid fa-key"></i>
            </span>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit" value="signup" name="signup">Sign Up</button>
        </form>
        <div class="pb-3 d-flex justify-content-center">
          <a href="<?=base_url('user/login')?>">Sign In</a>
        </div>
      </div>
    </main>