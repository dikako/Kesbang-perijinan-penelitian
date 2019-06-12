<div class='col-sm-4'>
    <label>Date Time Picker:</label>
    <div class="form-group">
        <div class='input-group date' id='datetimepicker'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
        </div>
    </div>

    <label>Date Picker:</label>
    <div class="form-group">
        <div class='input-group date' id='datepicker'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
        </div>
    </div>

    <label>Time Picker:</label>
    <div class="form-group">
        <div class='input-group date' id='timepicker'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY HH:mm',
        });

        $('#datepicker').datetimepicker({
            format: 'DD MMMM YYYY',
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
    });
</script>