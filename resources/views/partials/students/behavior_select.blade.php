<select name='bh-select[{{$quarter}}][{{$id}}]' class="form-control" data-id="{{$id}}">
	<option value=""></option>
	<option value="AO" <?php echo ($value == "AO") ? 'selected' : '' ?>>Always Observed</option>
	<option value="SO" <?php echo ($value == "SO") ? 'selected' : '' ?>>Sometimes Observed</option>
	<option value="RO" <?php echo ($value == "RO") ? 'selected' : '' ?>>Rarely Observed</option>
	<option value="NO" <?php echo ($value == "NO") ? 'selected' : '' ?>>Not Observed</option>
</select>