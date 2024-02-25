<section class="h-100 d-flex justify-content-center align-items-center flex-fill">
  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-center text-white">
      <h2 class="text-center">Add Task</h2>
  
      <form action="<?=base_url('task/add')?>" method="post" name="add_task" id="add_task" class="px-md-5">
      <?php if(empty($projects)) { ?>
      <p class="d-flex text-info justify-content-center">You've been assigned with No projects yet. Please contact admin.</p>
      <?php } ?>
        <span id="msg" class="w-100 text-center"></span>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Select Project:*</label>
            <select name="project" id="project" class="form-select">
              <?php foreach($projects as $proj) { ?>
                <option value="<?=$proj->project_id?>"><?=$proj->name?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Title:*</label>
            <input type="text" name="title" id="title" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Description:*</label>
            <textarea name="desc" id="desc" class="form-control"></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Priority:*</label>
            <select name="priority" id="priority" class="form-select">
              <option value="">Select Priority</option>
              <option value="High">High</option>
              <option value="Low">Low</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Due Date:*</label>
            <input type="text" name="duedate" id="duedate" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Status:*</label>
            <select name="status" id="status" class="form-select">
              <option value="">Select Status</option>
              <option value="Comepleted">Completed</option>
              <option value="In Progress">In Progress</option>
              <option value="Pending">Pending</option>
            </select>
          </div>
        </div>
        <span class="loader w-100 text-center" style="display: none;">Please wait...</span>
        <div class="d-flex justify-content-center gap-3 mt-3">
          <input class="btn btn-primary" type="button" value="submit" name="submit" onclick="addTask()">
          <a class="btn btn-danger" href="<?=base_url('task')?>">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>

<script>

  var valid = {
    title : "Please enter Name",
    desc : "Please enter Description",
    duedate : "Please select Due Date",
    priority : "Please set Priority",
    status : "Please set Status"
  };

  const addTask = () => {

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
        $("#add_task").attr("action"),
        $("#add_task").serializeArray(),
        function (data) {

          $(".loader").hide();

          $("#msg").html(data.msg);
          $("#msg").addClass(data.class + " d-block");

          if (data.success) {

            setTimeout(function() {
              window.location.href = baseUrl + "task"
            }, 2000);

          }
        }
        );
    }

    return false;
  }

  $(document).ready(function() {

    $('#project').select2();

    $('.select2-search__field').attr('placeholder', 'Search...');

    $('#mySelect').on('change', function() {
      var searchVal = $(this).val();
      $('#mySelect').val(searchVal).trigger('change');
    });

    $('#duedate').datepicker({
      minDate: 0,
      dateFormat: 'yy-mm-dd', // Change the date format as needed
      onSelect: function(dateText) {
        // Set the selected date to the input box value
        $(this).val(dateText);
      }
    });
  });

</script>