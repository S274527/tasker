<section class="h-100 d-flex justify-content-center align-items-center flex-fill">
  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-center text-white">
      <h2 class="text-center">Add User</h2>

      <form action="<?=base_url('user/admin_add_user')?>" method="post" name="add_user" id="add_user" class="d-flex flex-column align-items-center gap-3">
        <span id="msg" class="w-100 text-center"></span>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row">
          <label class="col-md-2">Full Name:*</label>
          <input class="col-md-4" type="text" name="name" id="name">
        </div>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row">
          <label class="col-md-2">Email:*</label>
          <input class="col-md-4" type="text" name="email" id="email">
        </div>
        <div class="d-flex justify-content-center col-md-8 flex-column flex-md-row">
          <label class="col-md-2">Password:*</label>
          <input class="col-md-4" type="text" name="password" id="password">
        </div>
        <span class="loader w-100 text-center" style="display: none;">Please wait...</span>
        <div class="d-flex gap-3">
          <input class="btn btn-primary" type="button" value="Submit" name="submit" onclick="addUser()">
          <a class="btn btn-danger" href="<?=base_url('user')?>">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>


<script>

    var valid = {
        name : "",
        email : "",
        password : ""
    };
  
  const addUser = () => {
    
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

    if ($('.text-bg-danger').length <= 0) {
      $(".loader").show();
      $.post(
        $("#add_user").attr("action"),
        $("#add_user").serializeArray(),
        function (data) {
          
          $(".loader").hide();
          
          $("#msg").html(data.msg);
          $("#msg").addClass(data.class + " d-block");

          if (data.success) {
            
            setTimeout(function() {
              window.location.href = baseUrl + "user"
              }, 2000);
          
          }
        }
      );
    }

    return false;
  // });
}
</script>