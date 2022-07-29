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

$user_name = $this->session->user_details;
//print_r(expression)
$full_name = $user_name[0]['first_name']." ".$user_name[0]['last_name'];

?>
	<style type="text/css">
        .col-60 {
            float: left;
            width: 50%;
            margin-top: 6px;
            clear: both;
        }

        .col-40 {
            float: right;
            width: 50%;
            margin-top: 6px;
        }

        .title-info {
            width: 85%;
            margin: 0 auto;
            padding-left: 25px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 25px;
            overflow-x: auto;
        }

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }
        
        .container12 {
        	border-radius: 5px;
        	background-color: rgba(254,220,202,0.8);
        	padding: 20px;
        }
    </style>

	<script type="text/javascript" src=<?php echo base_url('assets/js/disable_field.js') ?>></script>
    <script type="text/javascript">
        $(function () {
            $("#yesModels").change(function () {
                if ($(this).val() == "Yes") {
                    $("#group").removeAttr("disabled");
                    $("#group").focus();
                    $("#users").removeAttr("disabled");
                } else {
                    $("#group").attr("disabled", "disabled");
                    $("#users").attr("disabled", "disabled");
                }
            });
        });
    </script>

	<div class="title-info">
		<?php 
            // echo $msg;die;
    		if(isset($msg) && !empty($msg)) {
                echo "<div class='container12'><p>".$msg."</p></div><br/>";
    		}
		?>
		<form method="post" action="<?php echo base_url('admin/directory/setup/request'); ?>" enctype="multipart/form-data">
			<fieldset>
				<legend>Drive Path Directory Structure Request Form</legend>

				<div class="col-60 required"><label>Level 1</label></div>
                <div class="col-40"><input id="level1" type="text" name="level1"  required="required" value="<?php if (isset($level1) && $msg['level1'] != '') {echo $level1;} ?>" /></div>

				

				<div class="col-60 required">
					<label>Level 2 </label>
               		
				</div>

               	<div class="col-40"><input id="level2" type="text" name="level2" required="required" value="<?php if (isset($level2) && $msg['level2'] != '') {echo $level2;} ?>" /></div>

               	<div class="col-60 required">
               		<label>Level 3</label>
               	</div>

               	<div class="col-40">
                  <input type="text" id="level3" name="level3" required="required" value="<?php if (isset($level3) && $msg['level3'] != '') {echo $level3;} ?>" />
                </div>

                 

               	<div class="col-60 required">
               		<label>Level 4</label>
               		
               	</div>

               	<div class="col-40">
               		<input id="level4" type="text" name="level4" required="required" value="<?php if (isset($level4) && $msg['level4'] != '') {echo $level4;} ?>" />
               	</div>

               	
         	</fieldset>
			
			<br/>
			
			<input class="button" type="submit" value="Create Form" name="submitform" />
			<input class="button" type="reset" value="Clear Form" name="submitform" />
		</form>
	</div>



