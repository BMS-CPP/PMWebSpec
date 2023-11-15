<!--start-->

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



<style>
body {
    color: #404E67;
    background: #F5F7FA;
    font-family: 'Open Sans', sans-serif;
}
.table-wrapper {
    width: 700px;
    margin: 30px auto;
    background: #fff;
    padding: 20px;	
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
}
.table-title h2 {
    margin: 6px 0 0;
    font-size: 22px;
}
.table-title .add-new {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
}
.table-title .add-new i {
    margin-right: 4px;
}
table.table {
    table-layout: fixed;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table th:last-child {
    width: 100px;
}
table.table td a {
    cursor: pointer;
    display: inline-block;
    margin: 0 5px;
    min-width: 24px;
}    
table.table td a.add {
    color: #27C46B;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}
table.table td a.add i {
    font-size: 24px;
    margin-right: -1px;
    position: relative;
    top: 3px;
}    
table.table .form-control {
    height: 32px;
    line-height: 32px;
    box-shadow: none;
    border-radius: 2px;
}
table.table .form-control.error {
    border-color: #f50000;
}
table.table td .add {
    display: none;
}


</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(document).on("click", ".add", function(){
    	var data = [];
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
				data.push($(this).val());
			});	
			//console.log(data);	exit();
			var base_url = $('#baseurl').val();	
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
			
			data[1] = data[1].replace("+", "/*/");

			window.location.href = base_url + "CIAdmin/formula_update?field="+data[0]+"&algorithm="+data[1]+"&id="+data[2];
		}		
    });

	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
});

 function remove(el) {
 	var base_url = $('#baseurl').val();
  		var delete_no = el;
  		//alert(base_url);
 	 	if(confirm("Do you want to delete the formula?")) {
			//$url = 
			window.location.href = base_url + "CIAdmin/formula_delete?id="+delete_no;
			
		}
	}
</script>


<!--end-->
<?php
$user_id_session =& get_instance();
$user_id_session->load->model('CIModSession');
$users_id = $user_id_session->CIModSession->checkIsSessionExist();

if($users_id == 0) {
	echo "Please Login";
	die();
}
$user_name = $this->session->user_details;
//print_r();exit;
$url = base_url();
if ($user_name[0]['user_id'] == NULL) {
	if(!(strpos($url, 'localhost') != 0)){
		redirect(base_url('error/unauthorized'));
	}
}

?>
<input type="hidden" value="<?php echo base_url(); ?>" id="baseurl"/>
<style type="text/css">
	/*.active {*/
    /*background: red;*/
}

    .center {
    	text-align: center;
    margin: auto;
    width: 80%;
    padding: 10px;
    }
    .odd {
    	background-color: gray;
    	color:white;
    }

	.button {
		background-color: #2874A6; /* Green */
		border: none;
		color: white;
		padding: 12px 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
	}



	.main input[type=text], input[type=email], select {
		width: 60%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		resize: vertical;
	}

	.main textarea {
		width: 60%;

	}

	.main-role {
		align-items: left;
		font-family: Avenir, Helvetica, sans-serif;
		font-size: 18px;
		margin-left: 0px;
		width:80%;
	}

	.main-role input[type=text] {
		width: 20%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		resize: vertical;
	}

	.main-role select {
		width: 25%;
		height: 25%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		resize: vertical;
	}

</style>

<!--Start Teamplte Modification-->
<?php
		
	//add user
if(isset($_POST['usertoadd']) && !empty($_POST['usertoadd'])) 
{
	// echo '<pre>';print_r($_POST);die;
	$usertoadd = $_POST["usertoadd"];
	exec("java LdapConnect $usertoadd", $output);   

	$s=sizeof($output);
	if($s>1){
		$email_add = $output[2];     
		$fname_add = $output[0];
		$lname_add = $output[1];
		$checkinput = 'valid';
	} else {
		$checkinput = 'valid';
	}
}

	$rolevsscreen_info =& get_instance();
	$rolevsscreen_info->load->model('CIModUser');
	$rolevsscreen = $rolevsscreen_info->CIModUser->getRolevsScreen();
?>

<script language="JavaScript" type="text/JavaScript">

			//display associated screens
			function selectForm()
			{ 
				//clear existing options
				var sel = document.getElementById('rolescreens');
				sel.options.length = 0;

				var assigned = <?php echo json_encode($rolevsscreen['mapping']); ?>;

				var assignednew = {};
				for(var i=0; i<assigned.length; i++) {
					var obj = assigned[i];
					for(var key in obj) assignednew[key] = obj[key];
				}
console.log(assignednew);
				var selObj = document.getElementById('roleslist').value;
				var newoptions = assignednew[selObj];
				for(var i = 0; i < newoptions.length; i++) {
				    var opt = document.createElement('option');				    
				    opt.innerHTML = newoptions[i];
				    opt.value = newoptions[i];
				    sel.appendChild(opt);
				}

				var rolearray = <?php echo json_encode($rolevsscreen['roles']); ?>;
				
				for(var i = 0; i < rolearray.length; i++) {
					// alert(rolearray[i]);
				    var role = rolearray[i];	
				    if(role['role_name']==selObj) {
				    	document.getElementById("rolename").value = selObj;
						document.getElementById("roledescribe").value = role['role_description'];
				    }		    
				}				
			}


			//Function to move values from Assigned Screens to All Screens select box or vise versa
			function addValues() {
				moveOption('screens','rolescreens', 'add');
			}

			function removeValues() {
				moveOption('rolescreens','screens', 'remove');
			}

			function moveOption(aFrom, aTo, aButton) {
   				var fromSelect = document.getElementById(aFrom);
   				var selOption = fromSelect.selectedIndex;
   				var fromSelectVal = fromSelect.value;
   				var toSelect = document.getElementById(aTo);
				var flag;

   				// Check for a select source.
			    if (selOption == -1) {
				   	if(aButton == 'add'){
				    	alert("Please select a Screen for Assignment"); 
					} else {				       	
				       	alert("Please select an Assigned Screen"); 
				    }
			      	return false;
			    }
                else {	
      			    var newOption = fromSelect[selOption].cloneNode(true);
      			    var count = toSelect.options.length;

      			    if(aButton=="remove") {
	      			    var flag = 1;

	      			    for(var i=0; i<count; i++) {
	      			    	var toTxt = toSelect.options[i].value;
	      			    	if (fromSelectVal == toTxt) {
	      			    		fromSelect.removeChild(fromSelect[selOption]);
	      			    		flag = 0;
	      			    	}
	      			    }

	      			    if (flag==1) {
	      			    	toSelect.appendChild(newOption);
	      			    }     			    	
      			    } else if (aButton=="add") {
 	      			    var flag = 1;

	      			    for(var i=0; i<count; i++) {
	      			    	var toTxt = toSelect.options[i].value;
	      			    	if (fromSelectVal == toTxt) {
	      			    		flag = 0;
	      			    	}
	      			    }

	      			    if (flag==1) {
	      			    	toSelect.appendChild(newOption);
	      			    }       			    	
      			    }

  	    		}
	  		}

	  		//Function the clear the fields
	  		function clearField() {
	  			document.getElementById("rolename").value = null;
	  			document.getElementById("roledescribe").value = null;
				document.getElementById('rolescreens').options.length = 0;
	  		}

	  		var clicked;
			//Function to check new role
			function checkFieldNew() {
				var roleVal = document.getElementById("rolename").value;
				var rolearray = <?php echo json_encode($rolevsscreen['roles']); ?>;
				clicked = "new";
				//check if the role already exist
				for(var i = 0; i < rolearray.length; i++) {
				    var role = rolearray[i];
				    if(role['role_name'].toUpperCase()==roleVal.toUpperCase()) {
				    	return false;
				    }		    
				}	

				var rolescreens = document.getElementById('rolescreens');
				rolescreens.multiple = true;
				for(i=0;i<rolescreens.options.length;i++) {
				  	rolescreens.options[i].selected = false;
			    }
			    for(i=0;i<rolescreens.options.length;i++) {
			     	if(rolescreens.options[i].value!='') {		  
			 	   		rolescreens.options[i].selected =true;
				 	}
			    }
			    return true;
			}

			//Function to check new role
			function checkFieldUpdate() {
				var roleVal = document.getElementById("rolename").value;
				var rolearray = <?php echo json_encode($rolevsscreen['roles']); ?>;
				var same = false;
				clicked = "update";

				//check if the role already exist
				for(var i = 0; i < rolearray.length; i++) {
				    var role = rolearray[i];
				    if(role['role_name']==roleVal) {
				    	same = true;
				    }		    
				}	

				var rolescreens = document.getElementById('rolescreens');
				rolescreens.multiple = true;
				for(i=0;i<rolescreens.options.length;i++) {
				  	rolescreens.options[i].selected = false;
			    }
			    for(i=0;i<rolescreens.options.length;i++) {
			     	if(rolescreens.options[i].value!='') {		  
			 	   		rolescreens.options[i].selected =true;
				 	}
			    }

			    return same;
		    
			}

			//validate the form before submission
			function validateForm() {
				var valid=true;
				var roleVal = document.getElementById("rolename").value;
				var roleDesc = document.getElementById("roledescribe").value;
				var rolescreens = document.getElementById("rolescreens");
				if(roleVal == "") {
					alert("Please Enter the Role Name");
					valid=false;
				}

				if(roleDesc == "") {
					alert("Please Enter the Role Description");
					valid=false;
				}

				if(rolescreens.options.length==0) {
					alert("Please Assign the Screens for the New Role");	
					valid=false;			
				}

				if(clicked=="new") {
					if(checkFieldNew()==false) {
						alert("The role name already exists, please update the existing role or use a different name!");
						valid = checkFieldNew();
					}					
				} else if(clicked=="update"){
					if(checkFieldUpdate()==false) {
						alert("The role name does not exist, please make sure the case matches the existing role. If you want to create a new role, click the Reset button and enter new role name!");
						valid = checkFieldUpdate();
					}
				}
				return valid;
			}

			//validate input before submitting the form
			function validateModify() {
				var valid=true;
				var label = document.getElementById("varlabel").value;
				var unit = document.getElementById("varunit").value;

				if(unit=='NA'){
					if(label.length>40){
						alert("Variable label cannot exceed 40 characters!");
						valid=false;
					}
				} else {
					var labellength = label.length + 2 + unit.length;
					if(labellength>40){
						alert("Variable label and unit combined cannot exceed 40 characters!");
						valid=false;
					}

				}

				return valid;
			}

			
		</script>
<!--Mapping End-->
<div class="button-container" style="height: auto;">
		<form method="post" id="myDIV" action="<?php echo base_url('admin/manage/users'); ?>">
			<br/><br/><br/>

				<input class="button tab" type="submit" name="manage" value="Add user" /></li>
				<input class="button tab" type="submit" name="manage" value="Update user" /></li>
				<input class="button tab" type="submit" name="manage" value="Remove user" /></li>
				<input class="button tab" type="submit" name="manage" value="Role vs. Screen" />
				<input class="button tab" type="submit" name="manage" value="Remove Spec" />
				<input class="button tab" type="submit" name="manage" value="Unapprove Spec" />
				<input class="button tab" type="submit" name="manage" value="Modify Template" />
				<input class="button tab" type="submit" name="manage" value="New Template" />
				<input class="button tab" type="submit" name="manage" value="Update Derivations" />
				<input class="button tab" type="submit" name="manage" value="User Reports" />
				<input class="button tab" type="submit" name="manage" value="Locked Spec" />
		</form>
	</div>

	<div class="display">
		<?php
		if($param == NULL) {?>
		<div class="main center">
		<div class="title-head">
			<fieldset>
				<center>
				<legend><b>Manage Section</b></legend>
				<p>Welcome Admin!</p>
				<p>Now Your can Add User's/Roles and Spec with the help of this window</p>
				<p>Please use the left hand side tab to update/Add/Remove Role/Spec.</p>
				</center>
			</fieldset>
		</div>
		</div>

		<?php } ?>
			<?php
			if(isset($param) && $param=='adduser') {

				echo '<br/>';
		        echo '<div class="main mainshort center">';
		        echo '<fieldset>';
		        echo '<legend>Add user/role</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/add/user').'">';
				echo '<p>Domain User Id  <input type="text" id="userid" name="usertoadd"/></p>';
				echo '<span id="username_result"></span>';
				echo '<p><input class="button" type="submit" name="chooseUser" value="Add" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			}  else if (isset($param) && $param=='updateuser') {
				$user_details =& get_instance();
				$user_details->load->model('CIModUser');
				$users_info = $user_details->CIModUser->getUserId();
				//print_r($users_info);exit;
				echo '<br/>';
		        echo '<div class="main mainshort">';
		        echo '<fieldset>';
		        echo '<legend>Select User</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/update/user').'">';
				echo '<p>Domain User Id <select name="usertoupdate">';
				echo '<option></option>';

 				foreach($users_info as $arr) {
 					echo '<option  value='.$arr['user_id'].'>' . $arr['user_id'] . '</option>';
 				}

				echo '</select></p>';

				echo '';
				echo '<p><input class="button" type="submit" name="chooseUser" value="Select" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			} elseif (isset($param) && $param=='removeuser') {
				echo '<br/>';
				$user_details =& get_instance();
				$user_details->load->model('CIModUser');
				$users_info = $user_details->CIModUser->getUserId();
				echo '<div class="main mainshort">';
				echo '<fieldset>';
		        echo '<legend>Remove User</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/remove/user').'">';
				echo '<p>Domain User Id  <select name="usertoremove">';
				echo '<option></option>';

 				foreach($users_info as $arr) {
 					echo '<option  value='.$arr['user_id'].'>' . $arr['user_id'] . '</option>';
 				}

				echo '</select></p>';
				echo '<p><input class="button" type="submit" name="chooseUser" value="Remove" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			} elseif (isset($param) && $param=='rolevsscreen') {
				
				echo '<br/>';
				echo '<div class="main mainshort">';
				echo '<fieldset>';
				echo '<legend><b>Role Information</b></legend>';
				echo '<form method="post" name="roleForm" action="'.base_url("admin/manage/role/add").'" onsubmit="return validateForm();">';
				echo '<p>Role Name <input type="text" id="rolename" name="rolename" /></p>';
				echo '<p>Role Description <input type="text" id="roledescribe" name="roledescribe" /></p>';

				echo '<table width="100%" border="0">';
				
				echo '<tr><td width="" valign="top">
			 		  <table>
                        <tr>
                            <td>
                            <fieldset>
                               	<legend><b>Existing Roles</b></legend>
                                <select name="roleslist" size="10" style="overflow: auto; width: 300px; height: 200px;" onchange="javascript:selectForm();" id="roleslist">';
               
                     			 	foreach($rolevsscreen['roles'] as $value) {
                     			 		echo '<option style="padding:1%;" '.(($c = !$c)?' class="odd"':'').">" . $value['role_name'] . '</option>';
                     			 	}

			    echo '</select></td></tr></table></fieldset></td>';

			    echo '<td width="32%" valign="top" align="center">
				      <table><tr><td>
					  <fieldset>
                               	<legend><b>Assigned Screens</b></legend>
				      <select name="rolescreens[]" size="10" style="overflow:auto; width:300px; height:200px;" id="rolescreens">';

				echo '</select></fieldset></td></tr></table></td>';

                echo '<td width="10%" class = "center">
                    	  <input type="button" name="add" value="&lt;&lt;" onClick="addValues();" style="background-color: #1aea99;padding: 5px;">
                          <input type="button" name="remove" value="&gt;&gt;" onClick="removeValues();"  style="background-color: #1aea99;padding: 5px;">
					  </td>

			 		  <td width="30%">
				      <table width="100%" border="0"><tr><td>
				      <fieldset>
				      <legend><b>All Screens</b></legend>
     		          <select name="screens" size="10" style="overflow:auto; width:300px; height:200px;" id="screens">';
     		          	$c = true;
              			foreach($rolevsscreen['screens'] as $value) {
             			 		echo '<option style="padding:1%;" '.(($c = !$c)?' class="odd"':'').">" . $value['screen_name'] . '</option>';
             			 	}			   

				echo '</select></td></tr></table>';	
				echo '</fieldset></td></tr></table>';
				echo '<br/>';
				echo '<div class = "center">';	
				echo '<div class="button-section">';
				echo '<input class="button" type="submit" id="submitNewRole" name="submitRole" value="Create New" onClick="checkFieldNew();" />';
				echo '<input class="button" type="submit" id="submitUpdateRole" name="submitRole" value="Update" onClick="checkFieldUpdate();" />';
				echo '<input class="button" type="button" name="resetRole" value="Reset" onClick="clearField();" style="background-color: #2874A6;border: none;color: white;padding: 12px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 25px;"/>';
				echo '</div>';
				echo '</div>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			} elseif (isset($param) && $param=='removespec') {
				echo '<br/>';
		        echo '<div class="main mainshort">';
		        echo '<fieldset>';
		        echo '<legend>Remove Specification</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/remove/spec').'">';
				echo '<p>Specification Id : <input type="text" id="specid" name="spectoremove" /></p>';
				echo '<p><input class="button" type="submit" name="chooseSpec" value="Continue" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			} elseif (isset($param) && $param=='unapprovespec') {
				echo '<br/>';
		        echo '<div class="main">';
		        echo '<fieldset>';
		        echo '<legend>Unapprove Specification</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/unapprove/spec').'">';
				echo '<p>Specification Id : <input type="text" id="specid" name="spectounapprove"/></p>';
				echo '<p><input class="button" type="submit" name="chooseSpec" value="Continue" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			} elseif (isset($param) && $param=='modifytemplate') {
				$temp =& get_instance();
				$temp->load->model('CIModUser');
				$temp_info = $temp->CIModUser->getTeamplate();

				echo '<br/>';
		        echo '<div class="main">';
		        echo '<fieldset>';
		        echo '<legend>Select Template To Modify</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/modify/template').'">';
				echo '<p>Template : <select name="temptomodify" required>';
				echo '<option></option>';

 				foreach($temp_info['temp'] as $arr => $value) {
 					echo '<option>' . $value . '</option>';
 				}

				echo '</select></p>';
				echo '<br />';
				echo '<div class="row">';
                echo '<div class="col col-md-2 pull-left">';
				echo '<input class="button" type="submit" name="choose_temp" value="Add Variable" />';
				echo '</div>';
				echo '<div class="col col-md-2 pull-left">';
				echo '<input class="button" type="submit" name="choose_temp" value="Remove Variable" />';
				echo '</div>';
				echo '<div class="col col-md-2 pull-left">';
				echo '<input class="button" type="submit" name="choose_temp" value="Modify Variable" />';
				echo '</div>';
				echo '<div class="col col-md-2 pull-left">';
				echo '<input class="button" type="submit" name="choose_temp" value="Add Flag" />';
				echo '</div>';
				echo '<div class="col col-md-2 pull-left">';
				echo '<input class="button" type="submit" name="choose_temp" value="Remove Flag" />';
				echo '</div>';
				echo '<div class="col col-md-2 pull-left">';
				echo '<input class="button" type="submit" name="choose_temp" value="Modify Flag" />';
				echo '</div>';
				echo '</div>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			} else if(isset($param) && $param=='userinformation') {

				$user_details =& get_instance();
				$user_details->load->model('CIModUser');
				$users_count = $user_details->CIModUser->getUserinformation();
				//echo "Total Number of user : "+$users_count;

				echo '<br/>';
 			        echo '<div class="main">';
 			        echo '<fieldset>';
 			        echo '<legend>User Information</legend>';
 			        echo "<br/>";
 			        //echo '<form method="post" action="'.base_url('admin/manage/view/add/user').'">';
 			        echo "Total Number of Users : ". $users_count ;
					echo "<br/><br/>";
 			       // echo '<fieldset>';
 			        echo '<legend>Select date to get records</legend>'; 
 			        echo '<form method="post" action="'.base_url('admin/manage/view/userdate').'">';
 					echo '<p>Start Date  <input type="date" id="start_date" name="start_date" required /></p>';
 					echo '<p>End Date  <input type="date" id="end_date" name="end_date" required /></p>';
					echo '<p><input class="button" type="submit" name="chooseUser" value="Submit" /></p>';
 					echo '</form>';
 					//echo '</fieldset>'; 
 					
 					echo '</fieldset>';
 					echo '</div>';
			} else if(isset($param) && $param=='updatederivations') {

				echo '<div class="main">';
					echo '<fieldset>';
			        //echo '<legend>Welcome</legend>';

			        echo ' <div class="row">
                    <div class="col-sm-4"><h2>Update <b>Derivation</b></h2></div>
                   
                </div>';
                $formula_details =& get_instance();
				$formula_details->load->model('CIModUser');
				$formula_list = $formula_details->CIModUser->getFormula();
				//print_r($formula_list);exit;
			        echo '<table class="table table-bordered">
                <thead>
                    <tr>
                    
                        <th style="width: 10%;">Field</th>
                        <th>Algorithm</th>
                       
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($formula_list as $value) {
                	$dollar = '$';
                
                    echo '<tr>
                        <td>'.$value['field'].'</td>
                        <td hidden>
							 	<textarea id="algo_'.$value["sr_no"].'" style="width:100%" class="struct">'.$value["algorithm"].'</textarea>
						</td>
						<td hidden>
							 	<textarea id="field_'.$value["sr_no"].'" style="width:100%" class="struct">'.$value["field"].'</textarea>
						</td>
                       	<td>'.$value['algorithm'].'</td>
                       	<td hidden>'.$value['sr_no'].'</td>
            
                        <td>
                           <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>

                           <a onclick="abc('.$value['sr_no'].');" class="edit1" title="Edit"><i class="material-icons">&#xE254;</i></a>

                            <a style="display:none;" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            

                            <button class="delete" id="delete_formula" title="Delete" onclick= "remove('.$value['sr_no'].')"><i class="material-icons">&#xE872;</i></button>
                        </td>
                    </tr>';
                    }
                echo '</tbody>
            </table>';
            		 echo '
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New</button>
                        
                    ';

                    echo '<div class="modal fade" id="myModal" role="dialog">
					    <div class="modal-dialog">
					    
					      <!-- Modal content-->
					      <div class="modal-content">
					        <div class="modal-header">
					        <h4 class="modal-title">Add Derivation</h4>
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          
					        </div>
					        <div class="modal-body">
					          <form class="w3-container" action= '.base_url('admin/manage/add_formula').'  method="post">
						        <div class="w3-section">
						          <label><b>Field</b></label>
						          <input style="width:100%" class="w3-input w3-border" type="text" placeholder="Ex: BMI" name="field" required><br/>
						          <label><b>Algorithm</b></label>
						          <textarea style="width:100%" required class="w3-input w3-border" name="algorithm"></textarea>
						          <br/>
						          

						          <input  class="w3-button w3-block w3-green w3-section w3-padding" value="Add Derivation" type="submit">
						         
						        </div>
						      </form>
					        </div>
					      
					      </div>
					      
					    </div>
					  </div>
					';

					echo '<div class="modal fade" id="updatederivation" role="dialog">
					    <div class="modal-dialog">
					    
					      <!-- Modal content-->
					      <div class="modal-content">
					        <div class="modal-header">
					        <h4 class="modal-title">Update Derivation</h4>
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          
					        </div>
					        <div class="modal-body">
					          <form class="w3-container" action= '.base_url('admin/manage/update_formula').'  method="post">
						        <div class="w3-section">
						       
						          <input style="width:100%;" class="w3-input w3-border" type="hidden" readonly id="srnoupdate" name="srnoupdate" required><br/>

						          <label><b>Field</b></label>
						          <input style="width:100%" class="w3-input w3-border" type="text" placeholder="Ex: BMI" id="fieldupdate" name="fieldupdate" required><br/>
						          <label><b>Algorithm</b></label>
						          <textarea id="algorithmupdate" style="width:100%" required class="w3-input w3-border" name="algorithmupdate"></textarea>
<br/>
						         
						          <input  class="w3-button w3-block w3-green w3-section w3-padding" value="Update Derivation" type="submit">
						         
						        </div>
						      </form>
					        </div>
					      
					      </div>
					      
					    </div>
					  </div>
					';

			        echo '</fieldset>';
					echo '</div>';
			} 
			else if(isset($param) && $param=='userreports') 
			{
				echo '<div class="main">';

					echo '<fieldset>';
			        echo ' <div class="row">
                    <div class="col-sm-4"><h2><b>User Reports</b></h2></div>
                </div>';
                ?>
                <div class="container">
					  <h2>Please select filter</h2>
					  <form method="post" action="#">
					    <div class="form-group">
					      <label for="email">From Date:</label>
					      <input type="date" class="form-control" id="fromdate" placeholder="Enter email" name="fromdate">
					    </div>
					    <div class="form-group">
					      <label for="email">To Date:</label>
					      <input type="date" class="form-control" id="todate" placeholder="Enter to date" name="todate">
					    </div>
					    <div class="form-group">
					      <label for="email">Status:</label>
					      <select class="form-control" name="status" id="status" style="width: 30%;">
					      	<option value="1">Active</option>
					      	<option value="0">De-active</option>
					      </select>
					      <!-- <input type="email" class="form-control" id="email" placeholder="Enter Status" name="email"> -->
					    </div>					    
					    <button type="button" class="btn btn-default button" onclick="getuserresponse();">Submit</button>
					  </form>
                </div>
				 
				<?php
                $formula_details =& get_instance();
				$formula_details->load->model('CIModUser');
				$userdata = $formula_details->CIModUser->getusercount();

				echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th  style="width: 30%;">Total Number of Users</th>
                        <th  style="width: 30%;">Active Users</th>
                        <th>Deactivated Users</th>
                    </tr>
                </thead>
                <tbody id="user_resultcount" class="user_resultcount">';
                    echo '<tr>
                        <td>'.$userdata['All'].'</td>
                        <td>'.$userdata['activeuser'].'</td>
                        <td>'.$userdata['deactiveuser'].'</td>
                    </tr>';
                echo '</tbody>
            	</table>';

			    echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Created/Deactivated On</th>
                        <th>Last Modified By</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="user_result" class="user_result">';

                // foreach ($formula_list as $value) 
                // {
                    echo '<tr>
                        <td>Please select filter to see result</td>
                    </tr>';
                    // }
                echo '</tbody>
            </table>';
			}
			else if(isset($param) && $param=='lockedspec') 
			{
				echo '<div class="main">';

					echo '<fieldset>';
			        echo ' <div class="row">
                    <div class="col-sm-4"><h2><b>Locked Spec</b></h2></div>
                </div>';
                ?>
				<?php
                $formula_details =& get_instance();
				$formula_details->load->model('CIModUser');
				$getlockedspec = $formula_details->CIModUser->getlockedspec();

				

			    echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Spec ID</th>
                        <th>version_id</th>
                        <th>lockedby</th>
                        <th>Locked date</th>
                        <th>Status</th>	
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="user_result" class="user_result">';

                if(empty($getlockedspec))
                {
                	 echo '<tr>
                        <td>Result Not Found!</td>
                    </tr>';
                }
                else
                {
	               	foreach ($getlockedspec as $value) 
	                {
	                    echo '<tr>
	                        <td>'. $value->spec_id . '</td>
	                        <td>'. $value->version_id . '</td>
	                        <td>'. $value->lockedby . '</td>
	                        <td>'. $value->modification_date . '</td>
	                        <td>In-Process</td>
	                        <td><a href="'. base_url()."home/discardchangemanage/".$value->spec_id . '">Discard Change</a></td>
	                    </tr>';
	                }
                }
                echo '</tbody>
            </table>';
			}
			else if(isset($param) && $param=='newtemplate') { 
				echo '<br/>';
 			        echo '<div class="main">';
 			        echo '<fieldset>';
 			        echo '<legend>Add New Template </legend>';
 			        echo '<div style=color:red>(Note* - Take backup of table ‘dsstruct’ in database)</div>';
 			        echo '<br/>';
 			        echo '<legend>Enter database details</legend>'; 
 			        echo '<form method="post" action="'.base_url('admin/manage/add_template').'">';
 					echo '<p>Enter the Host Name:  <input type="text" id="hostname" name="hostname" required /></p>';
 					echo '<p>Enter the User Name:  <input type="text" id="username" name="username" required /></p>';
 					echo '<p>Enter the Password:  <input type="text" id="pwd" name="pwd" /></p>';
 					echo '<p>Enter the Database:  <input type="text" id="db" name="db" required /></p>';
 					echo '<p>Import Excel File:  <input type="file" id="file" name="file" required /></p>';
					echo '<p><input class="button" type="submit" name="chooseUser" value="Submit" /></p>';
 					echo '</form>';
 					echo '</fieldset>';
 					echo '</div>';

			}

			// View Add User 
			if(isset($param) && $param=='viewadduser') {
				// echo $checkinput;die;
				$user_id = $_POST['usertoadd'];

				$user_details =& get_instance();
				$user_details->load->model('CIModUser');
				$users_info = $user_details->CIModUser->getUserDetailsToAddUserId();
				//print_r($users_info['roles']);exit;
				$data = "";
 				if($checkinput=='valid') {
					echo '<br/>';
					echo '<div class="main">';
					echo '<fieldset>';
			        echo '<legend>Add user</legend>';
			        echo '<form method="post" action='.base_url('admin/manage/view/add/useradd').'>';
					echo '<p>Domain User Id  <input type="text" id="userid" name="userid" value="' .$usertoadd. '"  readonly/></p>';
					echo '<p>First Name  <input type="text" id="fname" name="fname" value="' . $fname_add. '" required /></p>';
					echo '<p>Last Name  <input type="text" id="lname" name="lname" value="'. $lname_add.'" required /></p>';
					echo '<p>Email address  <input type="text" id="email" name="email" value="'. $email_add . '" required /></p>';
					echo '<p>Role  <select name="role" required >';
					

					foreach($users_info['roles'] as $arr) {
						echo '<option value="'. $arr['role_name'] . '">' . $arr['role_name'] . '</option>';
 					}

					echo '</select></p>';
					echo '<p><input class="button" type="submit" name="submitUser" value="Add" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';					
 				} else {
 					echo '<br/>';
 			        echo '<div class="main">';
 			        echo '<fieldset>';
 			        echo '<legend>Add User/Role</legend>';
 			        echo '<form method="post" action="'.base_url('admin/manage/view/add/user').'">';
 			        echo 'The Domain userid is invalid. Please try again!';
 					echo '<p>Domain User Id  <input type="text" id="userid" name="usertoadd" required /></p>';
					echo '<p><input class="button" type="submit" name="chooseUser" value="Add" /></p>';
 					echo '</form>';
 					echo '</fieldset>';
 					echo '</div>';
 				}
			}
			if(isset($param) && $param=='viewupdateuser') {
				$user_details =& get_instance();
				$user_details->load->model('CIModUser');
				$user_id = $_POST['usertoupdate'];
				$users_info = $user_details->CIModUser->getUserDetailsToUpdateUserId($user_id);
				//print_r($users_info);exit;
				echo '<br/>';
				echo '<div class="main">';
				echo '<fieldset>';
		        echo '<legend>Update user</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/add/user/update').'">';
				echo '<p>Domain User Id  <input type="text" id="userid" name="userid" value="' . $user_id . '" readonly /></p>';
				echo '<p>First Name  <input type="text" id="fname" name="fname" value="' . $users_info['first_name']. '" required /></p>';
				echo '<p>Last Name  <input type="text" id="lname" name="lname" value="' . $users_info['last_name'] . '" required /></p>';
				echo '<p>Email address  <input type="email" id="email" name="email" value="' . $users_info['email_address']. '" required /></p>';

				echo '<p>Select the Role you want to change <select name="existing_role" required>';
				echo '<option></option>';
				
 				foreach($users_info['role'] as $value) {
 					echo '<option value= "'. $value['role_name'].'">' . $value['role_name'] . '</option>';
 				}

				echo '</select></p>';
				echo '<p>Select the New Role you want to assign <select name="new_role" required>';
				echo '<option></option>';

 				foreach($users_info['roles'] as $value) {
 					echo '<option value="'. $value['role_name'] . '">' . $value['role_name'] . '</option>';
 				}

				echo '</select></p>';
				echo '<p><input class="button" type="submit" name="userupdate" value="Update" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			}

			if(isset($param) && $param=='viewremoveuser') {
				//print_r($data);exit;
				$user_details =& get_instance();
				$user_details->load->model('CIModUser');
				$user_id = $_POST['usertoremove'];
				$users_info = $user_details->CIModUser->removeUserData($user_id);
				//print_r($users_info);exit;
				echo '<br>';
				echo '<div class="main">';
				echo '<fieldset>';
		        echo '<legend>Remove user</legend>';
		        echo '<form method="post" action="'.base_url('admin/manage/view/remove/user_role').'">';
				echo '<p>Domain User Id  <input type="text" id="userid" name="useridrm" value="' . $user_id  . '" readonly /></p>';
				echo '<label>Select the Role you want to remove </label><br/>';
				echo '<select style = "width:50%" name="existing_role[]" size="5" multiple required >';
				//print_r($users_info['role']);exit;
				foreach($users_info['role'] as $value) {
					echo '<option>' . $value['role_name'] . '</option>';
				}

				echo '</select>';
				echo '<p><input class="button" type="submit" name="submitUser" value="Remove" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			}

			if(isset($param) && $param=='viewremovespec') {

				$spec_details =& get_instance();
				$spec_details->load->model('CIModUser');
				$spec_id = $_POST['spectoremove'];
				$spec_info = $spec_details->CIModUser->getSpecDetailsToRemove($spec_id);
				//print_r($spec_info);exit;
				if(!empty($spec_info)) {
					echo '<br/>';
					echo '<div class="main">';
					echo '<fieldset>';
			        echo '<legend>Remove specification</legend>';
			        echo '<form method="post" action="'.base_url("admin/manage/spec/remove").'">';
					echo '<p>Specification id <input type="text" id="specid2" name="specid2" value="' . $spec_id  . '" readonly /></p>';
					echo '<p>Created by  <input type="text" id="createdby" name="createdby" value="'  . $spec_info->created_by.'" required readonly /></p>';
					echo '<p>Compound <input type="text" id="compound" name="compound" value="'. $spec_info->compound. '" required readonly /></p>';
					echo '<p>Indication  <input type="text" id="indication" name="indication" value="'. $spec_info->indication.'" required readonly /></p>';
					echo '<p>Spec type  <input type="text" id="stype" name="stype" value="'. $spec_info->type. '" required readonly /></p>';
					echo '<p>Create date  <input type="text" id="cdate" name="cdate" value="'. $spec_info->creation_date. '" required readonly /></p>';
					echo '<p><input class="button" type="submit" name="submitSpec" value="Remove" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';					
				} else {
					echo '<br/>';
			        echo '<div class="main">';
			        echo '<fieldset>';
			        echo '<legend>Remove specification</legend>';
			        echo '<form method="post" action="">';
			        echo 'The specification id is invalid. Please try again!';
					echo '<p>specification id <input type="text" id="specid" name="spectoremove" required /></p>';
					echo '<p><input class="button" type="submit" name="chooseSpec" value="Continue" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';
				}
			}

			if(isset($param) && $param=='viewunapprovespec') {
				$spec_details =& get_instance();
				$spec_details->load->model('CIModUser');
				$spec_id = $_POST['spectounapprove'];
				$spec_info = $spec_details->CIModUser->getSpecDetailsToUnapprove($spec_id);
 				if($spec_info) {
					echo '<br/>';
					echo '<div class="main">';
					echo '<fieldset>';
			        echo '<legend>Unapprove specification</legend>';
			        echo '<form method="post" action="'.base_url("admin/manage/spec/unapprove").'">';
					echo '<p>Specification id <input type="text" id="specid2" name="specid2" value="' . $spec_id . '" readonly /></p>';
					echo '<p>Created by  <input type="text" id="createdby" name="createdby" value="' . $spec_info->created_by . '" required readonly /></p>';
					echo '<p>Compound <input type="text" id="compound" name="compound" value="' . $spec_info->compound. '" required readonly /></p>';
					echo '<p>Indication  <input type="text" id="indication" name="indication" value="' . $spec_info->indication . '" required readonly /></p>';
					echo '<p>Spec type  <input type="text" id="stype" name="stype" value="' . $spec_info->type. '" required readonly /></p>';
					echo '<p>Create date  <input type="text" id="cdate" name="cdate" value="' . $spec_info->creation_date. '" required readonly /></p>';
					echo '<p><input class="button" type="submit" name="submitSpec" value="Unapprove" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';					
				} else {
					echo '<br/>';
			        echo '<div class="main">';
			        echo '<fieldset>';
			        echo '<legend>Unapprove specification</legend>';
			        echo '<form method="post" action="">';
			        echo 'The specification id is invalid. Please try again!';
					echo '<p>specification id <input type="text" id="specid" name="spectounapprove" required /></p>';
					echo '<p><input class="button" type="submit" name="chooseSpec" value="Continue" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';
				}
			}

			if(isset($param) && $param=='viewmodifytemplate') {
				//echo $action_type;exit;
			if($action_type == 'removevariable') {
				
				$temptomodify = $_POST['temptomodify'];

				$remove_var =& get_instance();
				$remove_var->load->model('CIModTempManagement');
				$vars = $remove_var->CIModTempManagement->getList('dsstruct',$temptomodify);
				if(in_array($temptomodify, erother)) {
					$vars2 = $remove_var->CIModTempManagement->getListother('dsstruct',$temptomodify);
				} else {
					$vars2 = $vars;
				}

				echo '<div class="main mainshort">';
				echo '<fieldset>';
				echo '<legend>Remove Variable</legend>';
				echo '<form method="post" action="'.base_url('admin/manage/view/remove/removevariable').'" >';
				echo '<p><input type="text" name="temptomodify2" value="' . $temptomodify . '" readonly /></p>';
				echo '<p><select name="removevariable" required>';
				echo '<option value=""">--Select Variable--</option>';
				foreach($vars as $value) {
					echo '<option>' . $value['var_name'] . '</option>';
				}
				echo '</select></p>';
				echo '<p><input class="button" type="submit" value="Remove" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			}

			if($action_type == 'removeflag') {
				$temptomodify = $_POST['temptomodify'];
				$remove_flag =& get_instance();
				$remove_flag->load->model('CIModUser');
				$all_flags = $remove_flag->CIModUser->getFlags($temptomodify);

				echo '<div class="main mainshort">';
				echo '<fieldset>';
				echo '<legend>Remove Flag</legend>';
				echo '<form method="post" action="'.base_url('admin/manage/view/remove/removeflag').'" >';
				echo '<p><input type="text" name="temptomodify2" value="' . $temptomodify . '" readonly /></p>';
				echo '<p><select name="removeflag" required>';
				echo '<option value=""">--Select Flag--</option>';
				foreach($all_flags['flag'] as $value) {
					echo '<option>' . $value. '</option>';
				}
				echo '</select></p>';
				echo '<p><input class="button" type="submit" value="Remove" /></p>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			}

				if($action_type == 'addvariable') {
					$temptomodify = $_POST['temptomodify'];
					$temp_var =& get_instance();
					$temp_var->load->model('CIModUser');
					$all_vars = $temp_var->CIModUser->getVariables($temptomodify);?>
					<script>
						function validateVar() {
							var valid=true;
							var varVal = document.getElementById("vartoadd").value.toUpperCase();
							var vararray = <?php echo json_encode($all_vars['var']); ?>;
							for(var i = 0; i < vararray.length; i++) {
							    if(vararray[i]==varVal) {
							    	valid = false;
							    	alert("This variable already exists, please use another name!");
							    	break;
							    }		    
							}	
							return valid;
						}
					</script><?php
					echo '<br />';
					echo '<div class="main mainshort">';
					echo '<fieldset>';
			        echo '<legend>Add variable</legend>';
			        echo '<form method="post" action="" onsubmit="return validateVar();">';
			        echo '<p><input type="text" name="temptomodify2" value="'. $temptomodify  .'" readonly /></p>';
			        echo '<p>Variable Name: <input type="text" id="vartoadd" name="vartoadd" value="" pattern="^[A-Za-z_]+[0-9]*" maxlength="8" style="text-transform:uppercase" required /></p>';
					echo '<p><input class="button" type="submit" name="modifydb" value="Continue" /></p>';
			        echo '</form>';
			        echo '</fieldset>';
					echo '</div>';
				} elseif($action_type == 'modifyvariable') {
					$temptomodify = $this->input->post('temptomodify');
					$temp_var =& get_instance();
					$temp_var->load->model('CIModTempManagement');
					$vars = $temp_var->CIModTempManagement->getList('dsstruct',$temptomodify);
					//print_r($ppk);exit;
					if(in_array($temptomodify, erother)) {
						$vars2 = $temp_var->CIModTempManagement->getListother('dsstruct',$temptomodify);
					} else {
						$vars2 = $vars;
					}
					
					echo '<br/>';
			        echo '<div class="main mainshort">';
			        echo '<fieldset>';
			        echo '<legend>Select Variable To Update</legend>';
			        echo '<form method="post" action="">';
			        echo '<p><input type="text" name="temptomodify2" value="' . $temptomodify .'" readonly /></p>';
					echo '<p>Select variable <select name="vartoupdate" required>';
					echo '<option></option>';

					foreach($vars as $value) {
						echo '<option>' . $value['var_name'] . '</option>';
					}

					echo '</select></p>';
					echo '<p><input class="button" type="submit" name="modifydb" value="Select variable" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';
				} elseif ($action_type == 'addflag') {
					$temptomodify = $_POST['temptomodify'];
					$temp_var =& get_instance();
					$temp_var->load->model('CIModUser');
					$all_flags = $temp_var->CIModUser->getFlags($temptomodify);
					//print_r($all_flags);exit;
					?>
					<script>
						function validateFlag() {
						var valid=true;
						var varVal = document.getElementById("flagtoadd").value.toUpperCase();
						var vararray = <?php echo json_encode($all_flags['flag']); ?>;
						for(var i = 0; i < vararray.length; i++) {
						    if(vararray[i]==varVal) {
						    	valid = false;
						    	alert("This Flag already exists, please use another name!");
						    	break;
						    }		    
						}	
						return valid;
					}

					</script><?php
					echo '<br />';
					echo '<div class="main">';
					echo '<fieldset>';
			        echo '<legend>Add flag</legend>';
			        echo '<form method="post" action=""  onsubmit="return validateFlag();">';
			        echo '<p><input type="text" name="temptomodify2" value="'. $temptomodify .'" readonly /></p>';
			        echo '<p><input type="text" id="flagtoadd" name="flagtoadd" value="" pattern="[0-9]+" maxlength = "8" required /></p>';
					echo '<p><input class="button" type="submit" name="modifydb" value="Continue" /></p>';
			        echo '</form>';
			        echo '</fieldset>';
					echo '</div>';
				} elseif ($action_type=='modifyflag') {
					$temptomodify = $this->input->post('temptomodify');
					$temp_var =& get_instance();
					$temp_var->load->model('CIModUser');
					$all_flags = $temp_var->CIModUser->getFlags($temptomodify);
					echo '<br/>';
			        echo '<div class="main">';
			        echo '<fieldset>';
			        echo '<legend>Select flag to update</legend>';
			        echo '<form method="post" action="">';
			        echo '<p><input type="text" name="temptomodify2" value="'. $temptomodify  .'" readonly /></p>';
					echo '<p>Flag <select name="flagtoupdate" required>';
					echo '<option></option>';

 					foreach($all_flags['flag'] as $value) {
 						echo '<option>' . $value. '</option>';
 					}

					echo '</select></p>';
					echo '<p><input class="button" type="submit" name="modifydb" value="Select flag" /></p>';
					echo '</form>';
					echo '</fieldset>';
					echo '</div>';	
				}
			}

			// add new variable
			if(isset($_POST["vartoadd"]) && !empty($_POST["vartoadd"])) {
				$vartoadd = $_POST["vartoadd"];
				$temptomodify2 = $_POST["temptomodify2"];
				echo '<br/>';
				echo '<div class="main">';
				echo '<fieldset>';
			    echo '<legend>Add variable</legend>';
			    echo '<form method="post" action="'.base_url("admin/manage/spec/addvariable").'" onsubmit="return validateModify();" style="margin-left: 2%;"> ';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Template</label></div>';
			    echo '<div class="col-75"><input type="text" name="temptomodify3" value="' . $temptomodify2  .'" readonly /></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Name</label></div>';
			    echo '<div class="col-75"><input type="text" id="varname" name="varname" value="' . $vartoadd .'" style="text-transform:uppercase" readonly /></div>';
			    echo '</div>';			    
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varnamechange"/> Name changeable </div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Label</label></div>';
			    echo '<div class="col-75"><input type="text" id="varlabel" name="varlabel" maxlength="40" required /></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varlabelchange" />Label changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Unit (enter NA if not applicable)</label></div>';
			    echo '<div class="col-75"><input type="text" id="varunit" name="varunit" value="NA" required /></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varunitchange" />Unit changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Type </label></div>';
			    echo '<div class="col-75"><select name="vartype" required onChange="char_select()" id="char_selectid">';
			    echo '<option value="Num">Num</option>';	  
			      echo '<option value="Char">Char</option>';
			    echo '</select>';
			    echo '</div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="vartypechange" />Type changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Rounding</label></div>';
			    echo '<div class="col-75"><select name="varround" required id="charfinal">';
			    echo '<option value="NA">NA</option>';
			    echo '<option value="0.1">0.1</option>';
			    echo '<option value="0.01">0.01</option>';
			    echo '<option value="0.001">0.001</option>';
			     echo '<option value="1">1</option>';
			    echo '<option value="3 significant digits">3 significant digits</option>';
			    echo '<option value="4 significant digits">4 significant digits</option>';
			    echo '</select>';
			    echo '</div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varroundchange" />Rounding changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Missing Value (enter NA if not applicable)</label></div>';
			    echo '<div class="col-75"><input id="defultvalue" type="text" name="varmiss" required /></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varmisschange" />Missing value changeable</div>';
			    echo '</div>';

				echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Notes</label></div>';
			    echo '<div class="col-75"><textarea name="varnote" rows="5" /> </textarea></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varnotechange" checked />Note changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Source</label></div>';
			    echo '<div class="col-75"><textarea name="varsrc" rows="5" /> </textarea></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varsrcchange" checked />Source changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><input type="checkbox" name="requiredFlag" />Variable required flag</div>';
			    echo '</div>';

			    echo '<div class="row">';
				echo '<p><input class="button" type="submit" name="addVar" value="Add variable" /></p>';
				echo '</div>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';	
			}

			// update variable
			if(isset($_POST["vartoupdate"]) && !empty($_POST["vartoupdate"])) {
				$temptomodify2 = $this->input->post('temptomodify2');
				$vartoupdate = $this->input->post('vartoupdate');
				$temp_var =& get_instance();
				$temp_var->load->model('CIModTempManagement');
				$vars = $temp_var->CIModTempManagement->getUpdateVarList('dsstruct',$temptomodify2, $vartoupdate);
				//print_r($vars);
				echo '<br/>';
				echo '<div class="main">';
				echo '<fieldset>';
			    echo '<legend>Update variable</legend>';
			    echo '<form method="post" action="'.base_url("admin.manage/spec/updatevariable").'" onsubmit="return validateModify();"  style="margin-left: 2%;"> ';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Template</label></div>';
			    echo '<div class="col-75"><input type="text" name="temptomodify3" value="' . $temptomodify2 .'" readonly /></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Name</label></div>';
			    echo '<div class="col-75"><input type="text" id="varname" name="varname" value="' . $vartoupdate .'" readonly /></div>';
			    echo '</div>';			    
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varnamechange"'  . (($vars->nameChange)==1? 'checked="checked"':'')  . ' />Name changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Label</label></div>';
			    echo '<div class="col-75"><input type="text" id="varlabel" name="varlabel" maxlength="40" value="'. htmlspecialchars($vars->var_label).'" required /></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varlabelchange" '  . (($vars->labelChange)==1? 'checked="checked"':''). ' />Label changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Unit (enter NA if not applicable)</label></div>';
			    echo '<div class="col-75"><input type="text" id="varunit" name="varunit" value="' . htmlspecialchars($vars->units)  . '" required /></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varunitchange" '  . (($vars->unitChange)==1?'checked="checked"':'') . ' />Unit changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Type </label></div>';
			    echo '<div class="col-75"><select name="vartype" required onChange="char_select()" id="char_selectid">';
			    
			    $row = array('Num','Char');
				$selected = $vars->type ;
				$i = 0;
				while ($i < count($row)){							
					echo "<option value='". $row[$i] ."'".($row[$i]==$selected?'selected="selected"':"").">". $row[$i]."</option>";
					$i++;
				}
				
			    echo '</select>';
			    echo '</div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="vartypechange" ' . (($vars->typeChange)==1? 'checked="checked"':'')  . ' />Type changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Rounding</label></div>';
			    echo '<div class="col-75"><select name="varround" required  id="charfinal">';
			    echo '<option value="NA">NA</option>';
			    echo '<option value="0.1">0.1</option>';
			    echo '<option value="0.01">0.01</option>';
			    echo '<option value="0.001">0.001</option>';
			     echo '<option value="1">1</option>';
			    echo '<option value="3 significant digits">3 significant digits</option>';
			    echo '<option value="4 significant digits">4 significant digits</option>';
			    echo '</select>';
			    echo '</div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varroundchange" '  . (($vars->roundChange)==1? 'checked="checked"':'') . ' />Rounding changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Missing Value (enter NA if not applicable)</label></div>';
			    echo '<div class="col-75"><input id="defultvalue" type="text" name="varmiss" value="' . htmlspecialchars($vars->missVal).'" required /></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varmisschange"' . (($vars->missValChange)==1? 'checked="checked"':'') . ' />Missing value changeable</div>';
			    echo '</div>';

				echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Notes</label></div>';
			    echo '<div class="col-75"><textarea name="varnote" rows="5" >'  . htmlspecialchars($vars->note) . '</textarea></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varnotechange"'  . (($vars->noteChange)==1? 'checked="checked"':'') . ' />Note changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Variable Source</label></div>';
			    echo '<div class="col-75"><textarea name="varsrc" rows="5" >' . htmlspecialchars($vars->source) .'</textarea></div>';
			    echo '</div>';
			    echo '<div class="row">';
			    echo '<div class="col-75"><input type="checkbox" name="varsrcchange"'  . (($vars->sourceChange)==1? 'checked="checked"':'')  . ' />Source changeable</div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><input type="checkbox" name="requiredFlag"'  . (($vars->requiredFlag)==1? 'checked="checked"':'')  . ' /> Variable required flag</div>';
			   
			    echo '</div>';


			    echo '<br/>';
				echo '<p><input class="button" type="submit" name="updateVar" value="Update variable" /></p>';

				echo '</form>';
				echo '</fieldset>';
				echo '</div>';					
			}

			// add new flag
			if(isset($_POST["flagtoadd"]) && !empty($_POST["flagtoadd"])) {
				$temptomodify2 = $this->input->post('temptomodify2');
				$flagtoadd = $this->input->post('flagtoadd');
				echo '<br/>';
				echo '<div class="main">';
				echo '<fieldset>';
			    echo '<legend>Add flag</legend>';
			    echo '<form method="post" action="'.base_url("admin/manage/spec/addflag").'" > ';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Template</label></div>';
			    echo '<div class="col-75"><input type="text" name="temptomodify3" value="' . $temptomodify2 .'" readonly /></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Flag number </label></div>';
			    echo '<div class="col-75"><input type="text" id="flagnum" name="flagnum" value="'. $flagtoadd .'" readonly /></div>';
			    echo '</div>';			    

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Flag comments</label></div>';
			    echo '<div class="col-75"><textarea rows="5" id="flagcom" name="flagcom" required ></textarea></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Flag notes</label></div>';
			    echo '<div class="col-75"><textarea rows="15" id="flagnote" name="flagnote" ></textarea></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><input type="checkbox" name="required" />Flag required?</div>';
			    echo '</div>';

			    echo '<div class="row">';
				echo '<p><input class="button" type="submit" name="addFlag" value="Add flag" /></p>';
				echo '</div>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';	
			}

			// update a flag
			if(isset($_POST["flagtoupdate"]) && !empty($_POST["flagtoupdate"])) {
				$temptomodify2 = $this->input->post('temptomodify2');
				$flagtoupdate = $this->input->post('flagtoupdate');
				$temp_flag =& get_instance();
				$temp_flag->load->model('CIModTempManagement');
				$flags = $temp_flag->CIModTempManagement->getUpdateFlagList('dsflag',$temptomodify2, $flagtoupdate);
				echo '<br/>';
				echo '<div class="main">';
				echo '<fieldset>';
			    echo '<legend>Update flag</legend>';
			    echo '<form method="post" action="'.base_url("admin.manage/spec/updateflag").'" style="margin-left:3%;" > ';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Template</label></div>';
			    echo '<div class="col-75"><input type="text" name="temptomodify3" value="' . $temptomodify2  .'" readonly /></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Flag number </label></div>';
			    echo '<div class="col-75"><input type="text" id="flagnum" name="flagnum" value="' . $flagtoupdate  .'" readonly /></div>';
			    echo '</div>';			    

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Flag comments</label></div>';
			    echo '<div class="col-75"><textarea rows="5" id="flagcom" name="flagcom" required >'  .htmlspecialchars($flags->FlagCom). '</textarea></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><label>Flag notes</label></div>';
			    echo '<div class="col-75"><textarea rows="15" id="flagnote" name="flagnote" >' . htmlspecialchars($flags->FlagNotes) . '</textarea></div>';
			    echo '</div>';

			    echo '<div class="row">';
			    echo '<div class="col-25"><input type="checkbox" name="required"'  . (($flags->required)==1? 'checked="checked"':'') . ' />Flag required?</div>';
			    echo '</div>';

				echo '<br/>';
				echo '<p><input class="button" type="submit" name="updateFlag" value="Update flag" /></p>';

				echo '</form>';
				echo '</fieldset>';
				echo '</div>';					
			}
			?>
		</div>
	</body>
</html>

<script type="text/javascript">
	function abc(first) 
	{
		let str1 = "algo_";
		let str2 = "field_";
		let algo = str1.concat(first);
		let field = str2.concat(first);

		var alorithem = document.getElementById(algo).value;
		var fields = document.getElementById(field).value;

		document.getElementById('algorithmupdate').value = alorithem;
		document.getElementById('fieldupdate').value = fields;
		document.getElementById('srnoupdate').value = first;

		// document.getElementById("srnoupdate").style.display = "none";

		$("#updatederivation").modal();
	}


	function getuserresponse() 
	{
		// alert('hi');
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		var status = $('#status').val();

		if (fromdate != "" || todate != "")
		{
			if (fromdate != "" && todate != "")
			{
				$.ajax({
		            url:"<?php echo base_url(); ?>admin/getusers/",
		            type: "post",    //request type,
		            data: {fromdate: fromdate, todate: todate, status: status},
		            success: function(data)
		            {
		            	$.ajax({
				            url:"<?php echo base_url(); ?>admin/getuserscount/",
				            type: "post",    //request type,
				            data: {fromdate: fromdate, todate: todate, status: status},
				            success: function(data1)
				            {
				            	$('#user_resultcount').html(data1);
				            }
				        });

		            	$('#user_result').html(data);
		            	
		            }
		        });
			}
			else
			{
				$('#user_result').html('');
				alert('Please select Start date and To date');
			}
		}
		else
		{
			$.ajax({
	            url:"<?php echo base_url(); ?>admin/getusers/",
	            type: "post",    //request type,
	            data: {fromdate: fromdate, todate: todate, status: status},
	            success: function(data)
	            {
	            	$.ajax({
			            url:"<?php echo base_url(); ?>admin/getuserscount/",
			            type: "post",    //request type,
			            data: {fromdate: fromdate, todate: todate, status: status},
			            success: function(data1)
			            {
			            	$('#user_resultcount').html(data1);
			            }
			        });

	            	$('#user_result').html(data);
	            }
	        });
		}
	}
	
 $(document).ready(function()
 {


  $('#usertoadd').change(function(){
   var username = $('#usertoadd').val();
   if(username != ''){
    $.ajax({
    	
     url: "<?php echo base_url(); ?>Search/checkUserId",
     method: "POST",
     data: {usertoadd:usertoadd},
     success: function(data){
      $('#username_result').html(data);
     }
    });
   }
  });
 });

$(document).ready(function() {
$(".tab").click(function () {
    $("input.tab").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active");   
});
});


function char_select() {
    d = document.getElementById("char_selectid").value;
    //alert(d);
    if(d == "Char"){
    	document.getElementById("charfinal").setAttribute("disabled", "disabled");
    	//document.getElementById("defultvalue").setAttribute("disabled", "disabled");
    	document.getElementById("defultvalue").value = " blank";
	}else {
		document.getElementById("charfinal").removeAttribute("disabled");
		document.getElementById("defultvalue").removeAttribute("disabled");
		document.getElementById("defultvalue").value = ".";
	}

}

window.onload = function() {
d = document.getElementById("char_selectid").value;
if(d == "Char"){
    	document.getElementById("charfinal").setAttribute("disabled", "disabled");
    	//document.getElementById("defultvalue").setAttribute("disabled", "disabled");
    	document.getElementById("defultvalue").value = " blank";
	}else {
		document.getElementById("charfinal").removeAttribute("disabled");
		document.getElementById("defultvalue").removeAttribute("disabled");
		document.getElementById("defultvalue").value = ".";
	}
}
</script>