<section class="h-100 d-flex justify-content-center align-items-center flex-fill">
  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-center text-white">
      <h2 class="text-center"><?=($user->role_id == 1) ? 'Edit User' : 'My Profile';?></h2>

      <form action="<?=base_url('user/admin_edit_user/'.$user->user_id)?>" method="post" name="edit_user" id="edit_user" class="d-flex flex-column align-items-center gap-3">
        <span id="msg" class="w-100 text-center"></span>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row">
          <label class="col-md-2">Full Name:*</label>
          <input class="col-md-4" type="text" name="name" id="name" value="<?=isset($user->full_name) ? $user->full_name : '';?>">
        </div>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row">
          <label class="col-md-2">Email:*</label>
          <input class="col-md-4" type="text" name="email" id="email" value="<?=isset($user->email) ? $user->email : ''?>">
        </div>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row">
          <label class="col-md-2">Password:*</label>
          <input class="col-md-4" type="text" name="password" id="password" value="">
        </div>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row col-6">(Enter password to update otherwise leave blank)</div>
        <span class="loader w-100 text-center" style="display: none;">Please wait...</span>
        <div class="d-flex gap-3">
          <input class="btn btn-primary" type="button" value="Submit" name="submit" onclick="editUser()">
          <a class="btn btn-danger" href="<?=base_url('user')?>">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>

<script>

    var valid = {
        name : "",
        email : ""
    };
  
  const editUser = () => {
    
    $("#msg").html('');

    var error = false;

    $.each(valid, function (e, value) {
      var idname = "#" + e;
      if ($.trim($(idname).val()) == "") {
        error = true;
        $(idname).addClass('text-bg-danger');
      }
      else {
        $(idname).removeClass('text-bg-danger');
      }
    });

    var id = '<?=$user->user_id?>';

    if ($('.text-bg-danger').length <= 0) {
      $(".loader").show();
      $.post(
        $("#edit_user").attr("action"),
        $("#edit_user").serializeArray(),
        function (data) {
          
          $(".loader").hide();
          
          $("#msg").html(data.msg);
          $("#msg").addClass(data.class + " d-block");

          if (data.success) {
            
            if(!(data.redirect)) {
              setTimeout(function() {
                window.location.href = baseUrl + "user/admin_edit_user/"+id
                }, 2000);
            } else {

              setTimeout(function() {
                window.location.href = baseUrl + data.redirect
                }, 2000);
            }
          
          }
        }
      );
    }

    return false;
  // });
}
</script>