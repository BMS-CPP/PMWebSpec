<?php //echo $hostname;
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
		echo "Please Login";
	die();
	}
}

?>
<div class="main center">
	<div class="title-head">
		<fieldset>
			<center>
				<h3 align="center"> <b>Version:</b> 3.5 </h3><br/>
				<h3 align="center"><b>Date:</b>  29th April 2022 </h3><br/>
				<h3 align="center"><b>Host:</b> <?php  echo $hostname .""." via TCP/IP "; ?></h3><br/>
				<h3 align="center"><b>S3 bucket:</b> <?php  echo s3_bucket_path; ?></h3><br/>
			</center>
		</fieldset>
	</div>
</div>