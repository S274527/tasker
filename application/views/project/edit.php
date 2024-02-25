<section class="h-100 d-flex justify-content-center align-items-center">
  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-center text-white">
      <h2 class="text-center">Edit Project</h2>

      <form action="<?=base_url('project/edit/'.$project->project_id)?>" method="post" name="edit_project" id="edit_project" class="d-flex flex-column align-items-center gap-3">
        <span id="msg" class="w-100 text-center"></span>
        <div class="d-flex">
          <label class="col-4">Name:*</label>
          <input type="text" name="name" id="name" value="<?=isset($project->name) ? $project->name : '';?>">
        </div>
        <div class="d-flex">
          <label class="col-4">Desc:*</label>
          <textarea type="text" name="desc" id="desc"><?=isset($project->description) ? $project->description : ''?></textarea>
        </div>
        <span class="loader w-100 text-center" style="display: none;">Please wait...</span>
        <div class="d-flex gap-3">
          <input class="btn btn-primary" type="button" value="Submit" name="submit" onclick="editProject()">
          <a class="btn btn-danger" href="<?=base_url('project')?>">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>

<script>

  var valid = {
    name : "Please enter Name",
    desc : "Please enter Description"
  };

  const editProject = () => {

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

    var id = '<?=$project->project_id?>';

    if ($('.text-bg-danger').length <= 0) {
      $(".loader").show();
      $.post(
        $("#edit_project").attr("action"),
        $("#edit_project").serializeArray(),
        function (data) {

          $(".loader").hide();

          $("#msg").html(data.msg);
          $("#msg").addClass(data.class + " d-block");

          if (data.success) {

            setTimeout(function() {
              window.location.href = baseUrl + "project/edit/"+id
            }, 2000);

          }
        }
        );
    }

    return false;
  // });
}
</script>