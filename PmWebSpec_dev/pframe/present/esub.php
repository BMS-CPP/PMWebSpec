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

	.main {
		align-items: center;

		background:#f1f1f1;
		width:100%;
		margin:0 auto;
		padding-left:25px;
		padding-top:20px;
		padding-bottom:20px;
		padding-right:25px;
	}
	fieldset {
		display: block;
		margin-left: 2px;
		margin-right: 2px;
		padding-top: 0.35em;
		padding-bottom: 0.625em;
		padding-left: 0.75em;
		padding-right: 0.75em;
		border: 1px groove;
	}

	input[type=text], select, textarea{
		width: 100%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		resize: vertical;
		font-family: Avenir, Helvetica, sans-serif;
	}

	table {
    width: 100%!important;
    table-layout: fixed;
}

.main input[type=text], select#SpecType {
	width: 100%;
}

.main textarea {
    width: 100%;
}


</style>
	<br/>
	<div class="container" style="text-align: end;margin-top: 2%;">
	<b style="background-color: skyblue;">Time Remaining For Session Timeout : <span id='timeremainingforsessiontimeout'>Loading </span><br></b>
</div>
		<div class="main">
			<fieldset>
    			<legend align="center">E-submission Specification</legend>
    			<form method="post" action="<?php echo base_url('home/export/esubcsv'); ?>"  enctype="multipart/form-data" onsubmit="return validateSubForm();">
    				<input type="text" name="spec_id" value= "<?php echo $spec_id; ?>" hidden>
    				<input type="text" name="version_id" value= "<?php echo $version_id; ?>" hidden>
        			<input id="passvalue" name="passvalue"  type="hidden"/>
        			<input id="studies" name="studies" type="hidden" />
        			<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $_SESSION['LAST_ACTIVITY']; ?>">
        			<br/>
            

                    	Please note that <b>dataset label</b> must be <b>less than or equal to 40 characters</b>:
                    	<br/><br/>
					<div class="row">
                        <div class="col-2"><label>Dataset Label:</label></div>
                        <div class="col-6"><input type="text" id="dataset_label" name="dataset_label" value="<?php  echo htmlspecialchars($dataset_label); ?>" required maxlength="40" /></div>
                    </div>
        			<br/>
        
                    Please note that <b>variable name</b> must be <b>less than or equal to 8 characters</b> and <b>variable label</b> must be <b>less than or equal to 40 characters</b>:
                    <br/><br/>
        
                    <table id="myTable" name="myTable" border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
                    	<tbody>			  
                            <tr>
                                <th contenteditable="False" style="width: 30px;"></th>
                                <th contenteditable="False" style="width: 120px;">Variable Name</th>
                                <th contenteditable="False" style="width: 300px;">Variable Label</th>
                                <th contenteditable="False" style="width: 200px;">Comment</th>
                                <th contenteditable="False" style="width: 500px;">
                                	Codes <br/>(If the codes column is longer than 200 characters, please copy the content to the Comment column)
                                </th>
                            </tr>
        			
            				<?php
             				    foreach($dataset_structure as $arr) {
             				    	//print_r($arr);exit;
             						echo "<tr>";
             						echo "<td><input type='checkbox'  class='checkboxc'/>&nbsp;</td>";
            						echo '<td><input type="text" class="struct" maxlength="8" value="' . $arr[0] . '"></td>';
             						echo '<td><textarea class="struct" maxlength="40">' . $arr[1] . '</textarea></td>';
            
             						if (strlen($arr[2])>200) {
             							echo '<td><textarea class="struct">'. $arr[2] .'</textarea></td>';
             				   			echo '<td><textarea class="struct" maxlength="200"></textarea></td>';
             						} else {
             							echo '<td><textarea class="struct"></textarea></td>';
             				   			echo '<td><textarea class="struct" maxlength="200">'. $arr[2] .'</textarea></td>';
             						}				   		
             						echo "</tr>";						
             					}
            			    ?>
        				</tbody>
        			</table>
        			<br/>
        			
                    <input type="button" value="Add another text input" onClick="addInput_esub('dynamicInput');" style="background-color: #2874A6;border: none;color: white;padding: 12px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 25px;"/>
                    <input type="button" value="Delete selected variables" onClick="showdelete('myTable');" style="background-color: #2874A6;border: none;color: white;padding: 12px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 25px;"/>
                    <input type="button" title="Select Variable To Move Up" value="move up" class="move up" onClick="updown('up');" style="background-color: #2874A6;border: none;color: white;padding: 12px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 25px;"/>
                    <input type="button" title = "Select Variable To Move Down" value="move down" class="move down" onClick="updown('down');" style="background-color: #2874A6;border: none;color: white;padding: 12px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 25px;"/>
                    <br><br>
        			<center>
        			<input type="submit" value="Export" name="export" onclick="displaytext();" style="background-color: #319a71;border: none;color: white;padding: 12px 45px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;border-radius: 25px;"/>
					</center>
        		</form>

			</fieldset>
		</div>
<script>
	$(document).ready(function() 
			{
				setInterval(function()
				{
					<?php 
					if (isset($_SESSION['LAST_ACTIVITY'])) 
					{
						?>
						var lastactivitytimeold = document.getElementById("timestamp").value;

						$.ajax({
					        url: "<?php echo base_url(); ?>home/getsessiontime/"+lastactivitytimeold,
					        type: "post",
					        data: "values" ,
					        success: function (response) 
					        {
					        	var response = JSON.parse(response);
					        	var lastactivitytime = response.lastactivitytime;
					        	var afteractivity_timespent = response.afteractivity_timespent;
					        	var timeremainingforsessiontimeout = response.timeremainingforsessiontimeout;
					        	var timeremainingforsessiontimeoutinsec = response.timeremainingforsessiontimeoutinsec;

					        	// document.getElementById("lastactivitytime").innerHTML = lastactivitytime;
					        	// document.getElementById("afteractivity_timespent").innerHTML = afteractivity_timespent;
					        	document.getElementById("timeremainingforsessiontimeout").innerHTML = timeremainingforsessiontimeout;
					        	// document.getElementById("timeremainingforsessiontimeoutinsec").innerHTML = timeremainingforsessiontimeoutinsec;

					        	if(timeremainingforsessiontimeoutinsec <= 300)
					        	{
					        		if (confirm('Your Session is about to expire in 5 Minute, Click "OK" to extend your session.')) 
					        		{
					        			document.getElementById("timestamp").value = Math.floor(Date.now() / 1000);
									  // Save it!
									  $.ajax({
								            url:"<?php echo base_url(); ?>home",
								            type: "post",    //request type,
								            dataType: 'json',
								            data: {registration: "success", name: "xyz", email: "abc@gmail.com"},
								            success:function(result){
								                console.log(result.abc);
								                //document.getElementById("timestamp").value = '';
					        					//document.getElementById("timestamp").value = <?php echo time(); ?>;
								            }
								        });
									} else 
									{
										document.location = '<?php echo base_url(); ?>home';
									}
					        	}
					        	

					        	// alert(lastactivitytime.lastactivitytime);
					           // You will get response from your PHP page (what you echo or print)
					        },
					        error: function(jqXHR, textStatus, errorThrown) {
					           console.log(textStatus, errorThrown);
					        }
					    });

						<?php
						}
					?>
			    },5000);
			});
</script>


		<script>
            var acc = document.getElementsByClassName("accordion");
            var i;
 
            for (i = 0; i < acc.length; i++) {
            	acc[i].onclick = function() {
            		this.classList.toggle("active");
            		var panel = this.nextElementSibling;
            		if (panel.style.maxHeight){
            			panel.style.maxHeight = null;
            		} else {
            			panel.style.maxHeight = "500px";
            		}
            	}
            }

			function addInput_esub(divName){
				var table = document.getElementById("myTable"); 
				var rownum = table.rows;
				var index = rownum.length;
				var tr = document.createElement("tr");
				var td0 = document.createElement("td");
				var checkbox = document.createElement('input');

				checkbox.type = "checkbox";
				checkbox.name = "name";
				checkbox.value = "value";
				checkbox.id = "id";	
				checkbox.className="checkboxc";

				var td1 = document.createElement("td");
				var input1 = document.createElement("input");

				input1.className="struct";
				input1.setAttribute('maxlength',"8");
				input1.required = true;
				input1.value='';
				input1.style.width="100%";
				input1.style.height="40px";
				input1.style.textTransform="uppercase";
				input1.setAttribute('pattern',"[A-Za-z_0-9]{1,8}"); 
				
				var td2 = document.createElement("td");
				var input2 = document.createElement("textarea");

				input2.className="struct";
				input2.setAttribute('maxlength',"40");
				input2.required=true;
				input2.value='';
				input2.style="width:100%;";

				var td7 = document.createElement("td");
				var input7 = document.createElement("textarea");

				input7.className="struct";
				input7.style="width:100%;";
				
				var td8 = document.createElement("td");
				var input8 = document.createElement("textarea");

				input8.className="struct";
				input8.style="width:100%;";
				input8.setAttribute('maxlength',"200");
				
				td0.appendChild(checkbox);					
				td1.appendChild(input1);
				td2.appendChild(input2);
				td7.appendChild(input7);				
				td8.appendChild(input8);
				tr.appendChild(td0);
				tr.appendChild(td1);
				tr.appendChild(td2);
				tr.appendChild(td7);
				tr.appendChild(td8);
				table.appendChild(tr);

				var rows = table.rows;
				var rowslength= rows.length;
				var parent = rows[rowslength-2].parentNode;

				parent.insertBefore(rows[rowslength-1], rows[rowslength-2]);
				
				var parent = rows[rowslength-1].parentNode;
				parent.insertBefore(rows[rowslength-1], rows[rowslength-2]);
			}

			// function to show delete variables 
			function showdelete(tableid) {
				var arr=[];
				var table = document.getElementById(tableid);
				var inputElements = table.getElementsByClassName('checkboxc');
				var input = table.getElementsByClassName('struct');
				var cols = table.rows[0].cells.length - 1;

				for(var i=0; inputElements[i]; ++i){
					if(inputElements[i].checked){
						arr.push(i);
					}
				}
				
				var adj=0;
				var arrayLength = arr.length;
				for (var i = 0; i < arrayLength; i++) {
					table.deleteRow(arr[i]+1-adj);
					adj++;
				}
			}	

			// function to move variables up and down
			function updown(direction) {
				var table = document.getElementById('myTable');
				var inputElements = table.getElementsByClassName('checkboxc');
				var input = table.getElementsByClassName('struct');
				var arrindex=[];
			
				for(var i=0; inputElements[i]; ++i){
					if(inputElements[i].checked){
						arrindex.push(i+1);
					}
				}
				
				var rows = table.rows;			
				var arrayLength = arrindex.length;
				
				if (direction === "up") {								
					for (var i=0; i < arrayLength; i++){
						var index=arrindex[i];
						var parent = rows[index].parentNode;
					
						if (index > 1) {
							parent.insertBefore(rows[index], rows[index-1]);					
						}
					}
				} else if (direction === "down" ) {
					for (var i=arrayLength-1; i >=0; i--){
						var index=arrindex[i];
						var parent = rows[index].parentNode;
						if (index <= rows.length) {
							parent.insertBefore(rows[index+1], rows[index]);
						}
					}
				}
			}

			function findDuplicate(arr1) {
				var result = arr1.filter(function(value, index, array) {return array.indexOf(value) !== index; });
				return result;
			}

			function validateSubForm() {
				//retrieve information from the structure table
				var table = document.getElementById('myTable');	
				var input = table.getElementsByClassName('struct');
				var arr = [];
				var arr2 = [];
				var valid=true;

				for (var z = 0; z < input.length;  z++) {		
					if (z % 4 ==0) {					
						arr.push(input[z].value.toUpperCase());
						if (input[z].value.length>8) {
							alert("Variable " + input[z].value + " is longer than 8 characters!");
							valid=false;
						}

						var expr  =  /^[A-Za-z_][A-Za-z0-9_]*$/;
						if (!expr.test(input[z].value)) {
			   				alert("Variable "+ input[z].value  + "can only start with letters or underscores");
			  				valid=false;
			   			 }	

					} else if (z % 4 ==1) {
						arr2.push(input[z].value.toUpperCase());
						if (input[z].value.length>40) {
							alert("Variable " + input[z-1].value + " has label longer than 40 characters!");
							valid=false;
						}
					} else if (z % 4 ==3) {
						if (input[z].value.length>200) {
							alert("Variable " + input[z-3].value + " has codes longer than 200 characters!");
							valid=false;
						}
					}					
				}
			
				if(findDuplicate(arr).length > 0) { 
					alert("Variable " + findDuplicate(arr) + " already exist!");
					valid=false;
				}

				if(findDuplicate(arr2).length > 0) { 
					alert("Variable label " + findDuplicate(arr2) + " already exist! Please update.");
					valid=false;
				}



				return valid;
			}

    		function displaytext() {
    			//retrieve information from the structure table
    			var table = document.getElementById('myTable');	
    			var input = table.getElementsByClassName('struct');
    
    			document.getElementById('passvalue').value = '';
    
    			for (var z = 0; z < input.length;  z++) {
    				document.getElementById('passvalue').value += input[z].value;
    				document.getElementById('passvalue').value += '@@';								
    			}
    		}
		</script>	
	</body>
</html>
