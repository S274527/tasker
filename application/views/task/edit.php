<section class="h-100 d-flex justify-content-center align-items-center flex-fill">
  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-center text-white">
      <h2 class="text-center">Edit Task</h2>

      <form action="<?=base_url('task/edit/'.$task->task_id)?>" method="post" name="edit_task" id="edit_task" class="px-md-5">
        <span id="msg" class="text-center"></span>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Select Project:*</label>
            <select name="project" id="project" class="form-select">
              <?php foreach($projects as $proj) { ?>
                <option <?= (($proj->project_id) == ($task->project_id)) ? 'selected="selected"' : '' ?> value="<?=$proj->project_id?>"><?=$proj->name?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Title:*</label>
            <input type="text" name="title" id="title" class="form-control" value="<?=isset($task->title) ? $task->title : '';?>">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Description:*</label>
            <textarea name="desc" id="desc" class="form-control"><?=isset($task->description) ? $task->description : '';?></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Priority:*</label>
            <select name="priority" id="priority" class="form-select">
              <option value="">Select Priority</option>
              <option value="High" <?=($task->priority == 'High') ? 'selected' : ''; ?>>High</option>
              <option value="Low" <?=($task->priority == 'Low') ? 'selected' : ''; ?>>Low</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label">Due Date:*</label>
            <input type="text" name="duedate" id="duedate" class="form-control" value="<?=isset($task->due_date) ? $task->due_date : '';?>">
          </div>
          <div class="col-md-6">
            <label class="form-label">Status:*</label>
            <select name="status" id="status" class="form-select">
              <option value="">Select Status</option>
              <option value="Completed" <?=($task->status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
              <option value="In Progress" <?=($task->status == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
              <option value="Pending" <?=($task->status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            </select>
          </div>
        </div>
        <span class="loader w-100 text-center" style="display: none;">Please wait...</span>
        <div class="d-flex justify-content-center gap-3 mt-3">
          <input class="btn btn-primary" type="button" value="submit" name="submit" onclick="editTask()">
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

  const editTask = () => {

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

    var id = '<?=$task->task_id?>';

    if ($('.text-bg-danger').length <= 0) {
      $(".loader").show();
      $.post(
        $("#edit_task").attr("action"),
        $("#edit_task").serializeArray(),
        function (data) {

          $(".loader").hide();

          $("#msg").html(data.msg);
          $("#msg").addClass(data.class + " d-block");

          if (data.success) {

            setTimeout(function() {
              window.location.href = baseUrl + "task/edit/"+id
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