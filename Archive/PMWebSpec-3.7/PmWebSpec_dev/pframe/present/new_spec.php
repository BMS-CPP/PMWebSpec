<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
$user_id_session =& get_instance();
$user_id_session->load->model('CIModSession');
$users_id = $user_id_session->CIModSession->checkIsSessionExist();

if ($users_id == 0) {
	echo "Please Login";
	die();
}
$user_name = $this->session->user_details;
$url = base_url();
if ($user_name[0]['user_id'] == NULL) {
	if (!(strpos($url, 'localhost') != 0)) {
		redirect(base_url('error/unauthorized'));
	}
}
?>
<style>
	.center {
		text-align: center;
	}
	.alert-success {
	background-color: #f1f9f7;
    border-color: #e0f1e9;
    color: #1d9d74;
}
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    line-height:2.5;
}
</style>
<br/>
<div class="main center">
	<div class="title-head">
		<fieldset>
			<legend><center><b>Please Select A Template: </b></center></legend>
			<form method="post" target="_blank" action="<?php echo base_url('/home/create/new'); ?>">
					<select id="SpecType" name="SpecType">
						<option value="">Please Select Template</option>
  						 <?php
  						 
							foreach($spec_types as $arr => $value) {
								if($value == "Blank Template") {
									$value = "Blank-Template";
								}
								$option = "option".$i++;
							echo '<option value='.$value.'>' . $value . '</option>';
							}
						?>
			</select>
			<br/><br/>
			<div id="SpecType">
			    <div id="PPK-standard">
			          <span class="alert alert-success">
				    <i class="fa fa-info-circle"></i>
			         Population pharmacokinetic analysis dataset specification - used for all other drugs.</span>
			        <br/><br/>
			    </div>
			    <div id="Blank-Template">
			          <span class="alert alert-success">
				    <i class="fa fa-info-circle"></i>
			        Create your own specification based on your needs.</span>
			        <br/><br/>
			    </div>
			    <div id="ER-ISOP-safety-efficacy">
			          <span class="alert alert-success">
				    <i class="fa fa-info-circle"></i>
			         Exposure-response safety and efficacy dataset specification - combination of ER-safety and ER-efficacy templates.</span>
			        <br/><br/>
			    </div>	   
			</div>

			<input class="button" type="submit" value="Select" name='submit1'>
			</form>

		</fieldset>
	</div>
	</div>
	</body>
</html>


<script type="text/javascript">
	$('#SpecType').change(refresh_inputs);
refresh_inputs();

function refresh_inputs() {
  var name = $('#SpecType').attr('name');
  var val = $('#SpecType').val();
  $('#' + name + ' div').hide();
  $('#' + val).show();
}

</script>