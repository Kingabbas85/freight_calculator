<?php
	include_once("includes/session.php");
	include_once('database/database.php');
	
	if(isset($_POST["getNewRow"])) {
		
		$counter = $_POST["count"];
?>
		<tr class="readonly_class">
			<td class="text-left">
				<div class="counter" style="padding-top: 1px;"> <?php echo $counter; ?> </div>
				<input type="hidden" name="countervalue" class="countervalue" value="0">
			</td>
			<td>
				<input type="text" id="description" name="description[]"  class="form-control form-control-sm description" placeholder="Key board" maxlength="80" readonly>
			</td>
			<td> <input type="text" id="specification" name="specification[]" class="form-control form-control-sm specification" placeholder="A4 Tech" maxlength="200" readonly> </td>
			<td> <input type="text" id="qty" name="qty[]" class="form-control form-control-sm qty" placeholder="1" maxlength="12" readonly> </td>
			<td>
				<input type="hidden" id="uom" name="uom[]" class="uom">
				<select id="unit_of_measurement" class="form-control form-control-sm unit_of_measurement" name="unit_of_measurement" readonly>
					<option value="" disabled selected hidden> Choose </option>
					<?php
						$query11 = "Select * FROM uom ORDER By unit_name ASC";
						$result11 = mysqli_query($connection, $query11);
						if(mysqli_num_rows($result11) > 0) {
							while( $row11 = mysqli_fetch_assoc($result11) ){
								$uom_value = $row11['unit_name'];
								echo '<option value="'.$uom_value.'"> '.$uom_value.' </option>';
							}
						}
					?>
				</select>
			</td>
			<td> <input type="text" id="unit_price" name="unit_price[]" class="form-control form-control-sm unit_price" placeholder="100.0" maxlength="18" readonly> </td>
			<td> <input type="text" id="total" name="total[]" class="form-control form-control-sm total" placeholder="100.0" readonly> </td>
			<td> <input type="text" id="additional_note" name="additional_note[]" class="form-control form-control-sm additional_note" placeholder="A4 Tech" maxlength="150" readonly> </td>

			<td class="mt-2 text-center" style="width: 30px">
				<a href="javascript:void(0)" id="remove_row" class="fa fa-times remove_row" style="margin-top: 12px; color: red; font-weight: lighter; text-decoration: none; font-size: 14px; margin-top: -4px;" title="Remove row"></a>
				
				<input type="hidden" id="product_id" name="product_id[]" class="product_id" value="">
			</td>
		</tr>

		<script type="text/javascript">
		  	counter = <?php echo $counter; ?>;
		  	if (counter == 1) {
		  		$(".remove_row").css("pointer-events", "none");
		  	} else {
		  		$(".remove_row").css("pointer-events", "auto");
		  	}

		  	$(".readonly_class").hover(function() {
			  	$(this).css("pointer-events", "none");
			}, function(){
			  	// $(this).css("pointer-events", "none");
			});
		</script>
<?php
	}
?>