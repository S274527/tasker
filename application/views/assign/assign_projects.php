<section class="h-100 d-flex justify-content-center align-items-center flex-fill">
  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-center text-white">
      <h2 class="text-center">Assign Projects to: <?=$user[0]->full_name?></h2>

      <form action="<?=base_url('assign/assign_projects/'.$user[0]->user_id)?>" method="post" name="assign_project" id="assign_project" class="d-flex flex-column align-items-center gap-3">
        <span id="msg" class="w-100 text-center"></span>
        <div class="row">
            <div class="col-12">
                <label class="form-label">Select Project:</label>
                <select id="projects" name="projects[]" multiple class="form-select w-100">
                    <?php foreach($projects as $proj) { ?>
                        <option value="<?=$proj->project_id?>" <?=(in_array($proj->project_id, $user_projects)) ? 'selected' : '';?>><?=$proj->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <span class="loader w-100 text-center" style="display: none;">Please wait...</span>
        <div class="d-flex justify-content-center gap-3 mt-3">
          <input class="btn btn-primary" type="button" value="Submit" name="submit" onclick="assignProject()">
          <a class="btn btn-danger" href="<?=base_url('assign')?>">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>

<style type="text/css">
    .select2 {
    min-width: 200px;
}

.select2-container--default .select2-selection--multiple .select2-selection__clear {
    padding: 1px 5px;
    color: var(--bs-danger);
    border: 1px solid var(--bs-danger);
}

.select2-container .select2-search--inline {
    width: 100%;
    border: 1px solid var(--bs-blue);
    margin: 6px 2px 2px 0px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: var(--bs-white);
    border: 1px solid var(--bs-primary);
    color: var(--bs-primary);
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: var(--bs-danger);
}
</style>

<script>
  $(document).ready(function() {
    // Initialize Select2
    $('#projects').select2({
      placeholder: "Select projects",
      allowClear: true
    });
  });

    const assignProject = () => {

    $("#msg").html('');

    var selectedValue = $('#projects').val();
    var userid = '<?=$user[0]->user_id?>';
    console.log(userid);
    console.log(selectedValue);
    // if(selectedValue && selectedValue.length <= 0) {
    //     $('#projects').addClass('text-bg-danger');
    // }

    // if ($('.text-bg-danger').length <= 0) {
    $(".loader").show();
    $.post(
        $("#assign_project").attr("action"),
        // $("#assign_project").serializeArray(),
        {id: userid, projects: selectedValue},
        function (data) {
        $(".loader").hide();
        
        $("#msg").html(data.msg);
        $("#msg").addClass(data.class + " d-block");

        if (data.success) {
            
            setTimeout(function() {
            window.location.href = baseUrl + "assign"
            }, 2000);
        
        }
        }
    );
    
    // }

    return false;
    }

</script>