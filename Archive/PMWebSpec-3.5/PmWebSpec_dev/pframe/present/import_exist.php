<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request For Spec Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('home/specapproval'); ?>" autocomplete="off">
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Spec ID:</label>
            <input type="text" readonly class="form-control" id="approval_spec_id" name="approval_spec_id">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Version:</label>
            <input type="text" readonly class="form-control" id="approval_version_id" name="approval_version_id">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Approver's Name:</label>
            <span style="color:red;">*</span>
            <input type="text" class="form-control" id="approval_name" name="approval_name" required="required">
            <span style="color: green;">Note - Pharmacometrician or individual who will approve this spec</span>
          </div>
          <div class="form-group">
          	<label for="recipient-name" class="col-form-label"><span style="color:red;">*</span> Recipient:</label>
            <input type="text" class="form-control" id="recipiente" name="recipiente" required="required">
            <span style="color: green;">Note - Please separate multiple email addresses with a comma(,)</span>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><span style="color:red;"> * </span>Message:</label>
            <textarea class="form-control" required="required" name="message" id="message-text"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Email</button>
      </div>
      </form>
    </div>
  </div>
</div>
<style>
table {
    width: 100%!important;
    
    /*table-layout: auto;*/
}
</style>
<div class="main-body">
    <?php
    if($this->session->userdata('selection') == 'ImportExisting')
    {
        $urlroute = 'Import Existing';
    }
    elseif($this->session->userdata('selection') == 'ReviewApprove')
    {
        $urlroute = 'Review Approve';
    }
    elseif($this->session->userdata('selection') == 'ExportEsub')
    {
        $urlroute = 'Export Esub';
    }
    else
    {
        $urlroute = $this->session->userdata('selection');
    }


    ?>
    <div style="padding: 10px;">
        <a href="<?php echo base_url(); ?>"><u>Home</u></a> : <?php echo $urlroute; ?><br>
    </div>
<?php
    
    if(!isset($param) && $param == NULL && strtolower($param) != 'version') {
    	echo '
		<fieldset>
			<legend><b>Filters</b></legend>
			<div class="input-style">
	
                <div class="row">
                  <div class="col col-md-2">
					<!--<label>Spec ID </label>-->
					<input style ="width:100%" type="text" name="sid" id="sid" onkeyup="myFunction()" placeholder="Enter Spec Id">
				  </div>
				   <div class="col col-md-2">
					<!--<label>Compound </label>-->
					<input style ="width:100%" type="text" name="cname"  id="cname" onkeyup="myFunction()" placeholder="Enter Compund Ex: Test-">
					</div>
					 <div class="col col-md-3">
					<!--<label>Dataset type </label>-->
					<input style ="width:100%" type="text" name="dstype" id="dstype" onkeyup="myFunction()" placeholder="Dataset type Ex: PPK etc.">
					</div>
					<div class="col col-md-2">
					<!--<label>Created by </label>-->
					<input style ="width:100%" type="text" name="username" id="username" onkeyup="myFunction()" placeholder="Created By">
					</div>
                    <div class="col col-md-2">
                    <!--<label>Created by </label>-->
                    <input style ="width:100%" type="text" name="lastmodifiedby" id="lastmodifiedby" onkeyup="myFunction()" placeholder="Modified By">
                    </div>
					 <div class="col col-md-2" style="padding-top:10px;">
					<!--<label>Indication </label>-->
					<input style ="width:100%" type="text" name="indication" id="indication" onkeyup="myFunction()" placeholder = "Enter Indication">
					</div>
					 <div class="col col-md-1" style="padding-top:10px;">
					<button type="button" onclick="clearall()" class="btn" title="Clear The Filter" style="background-color:red; color:#fff;">&#10006</button>
					</div>
				</div>
				</fieldset><br/>';


        		echo '<p><b>Results</b></p>';
        		echo '<div id="allspecs" class="">
            <table class="table" id="allspectable" name="allspectable" cellpadding="5" cellspacing="5" >
        	<tbody>			  
        		<tr>
        			<th  style="width: 250px;" onclick="sortTable(0)"> Specification ID </th>
        			<th style="width: 100px;"  onclick="sortTable(1)"> Created By </th>
        			<th style="width: 300px;" onclick="sortTable(2)"> Dataset Path </th>
        			<th style="width: 150px;" onclick="sortTable(3)"> Indication </th>
        			<th style="width: 150px;" onclick="sortTable(4)"> Dataset Type </th>	
        			<th style="width: 120px;" onclick="sortTable(5)"> Creation Date </th>				
        			<th style="width: 120px;"> Approved </th>
        			<th style="width: 120px;" onclick="sortTable(7)"> Approved By </th>
                    <th style="width: 120px;" onclick="sortTable(8)"> Modified By </th>
                    <th style="width: 80px;"> Spec Status </th>
                    <th style="width: 120px;display:none;"> Compound </th>
        		</tr>
            </tbody>';
		//echo $this->session->userdata('selection');exit;$spec['approved']
           // echo $this->session->userdata('selection');
        if(!empty($all_specs)) {
            foreach($all_specs as $indx => $spec) {
				if(($this->session->userdata('selection') == 'ImportExisting') || ($this->session->userdata('selection')=='ReviewApprove') || ($this->session->userdata('selection') == 'ExportEsub') || ($this->session->userdata('selection')=='DsTools') ) {
					echo '<tr>';
                     $dataset_path = wordwrap($spec['dataset_path'], 40, "<br />\n", true);
                    echo '<td style="width: 850px;">' . $spec['spec_id'] . '</td>';
					echo '<td>' . $spec['created_by'] . '</td>';
					echo '<td>' . $dataset_path . '</td>';
					echo '<td>' . $spec['indication'] . '</td>';
					echo '<td>' . $spec['type'] . '</td>';
					echo '<td>' . date('Y-m-d',strtotime($spec['creation_date'])) . '</td>';
					echo '<td>';
					echo '<form method="post" action="' . base_url('signature') . '" target="_blank">';
					echo '  <input type="text" hidden name="spec_id" value ="' . $spec['spec_id'] . '" />';
					if ($spec['approved'] == 1) {
						$approve = '&#10004';
						echo '<input type="submit" value ="' . $approve . '" style="background-color:#52b32f;color:#fff;">';
					} else {
						$approve = '&#10006';
						echo '<input type="button" value ="' . $approve . '" disabled style="background-color:red; color:#fff;">';
					}
					echo '</form>';
					echo '</td>';
					//echo '<td><a target="_blank" href="signature.php?id='.$spec['spec_id'].'">' .  $approve  . '</a></td>';
					echo '<td>' . $spec['approved_by'] . '</td>';
                    echo '<td>' . $spec['last_modified_by'] . '</td>';
                    echo '<td>'; 
                                if ($spec['islocked'] == 'Locked') {
                                    $locked = '&#128274';
                                    echo '<input title="Locked Specification" type="submit" value ="' . $locked . '" disabled style="background-color:#52b32f;color:#fff;">';
                                }
                                else{
                                    $locked = '&#10003';
                                    echo '<input title="Available Specification" type="submit" value ="' . $locked . '" disabled style="background-color:#52b32f;color:#fff;">';
                                }
                    echo '</td>';
					echo '<td style="display:none;">' . $spec['compound'] . '</td>';
					echo '</tr>';
				}else {
                    if($spec['approved'] != 1) {
					echo '<tr>';
                    $dataset_path = wordwrap($spec['dataset_path'], 40, "<br />\n", true);
                    //echo $dataset_path;
					echo '<td style="width: 850px;">' . $spec['spec_id'] . '</td>';
					echo '<td>' . $spec['created_by'] . '</td>';
					echo '<td>' . $dataset_path .'</td>';
					echo '<td>' . $spec['indication'] . '</td>';
					echo '<td>' . $spec['type'] . '</td>';
					echo '<td>' . date('Y-m-d',strtotime($spec['creation_date'])) . '</td>';
					echo '<td>';
					echo '<form method="post" action="' . base_url('signature') . '" target="_blank">';
					echo '  <input type="text" hidden name="spec_id" value ="' . $spec['spec_id'] . '" />';
					if ($spec['approved'] == 1) {
						$approve = '&#10004';
						echo '<input type="submit" value ="' . $approve . '" style="background-color:#52b32f;color:#fff;">';
					} else {
						$approve = '&#10006';
						echo '<input type="button" value ="' . $approve . '" disabled style="background-color:red; color:#fff;">';
					}
					echo '</form>';
					echo '</td>';
					//echo '<td><a target="_blank" href="signature.php?id='.$spec['spec_id'].'">' .  $approve  . '</a></td>';
					echo '<td>' . $spec['approved_by'] . '</td>';
                    echo '<td>' . $spec['last_modified_by'] . '</td>';
                    echo '<td>'; 
                                if ($spec['islocked'] == 'Locked') {
                                    $locked = '&#128274';
                                    echo '<input title="Locked Specification" type="submit" value ="' . $locked . '" disabled style="background-color:#f2c934;color:#fff;">';
                                }
                                else{
                                    $locked = '&#10003';
                                    echo '<input title="Available Specification" type="submit" value ="' . $locked . '" disabled style="background-color:#52b32f;color:#fff;">';
                                }
                    echo '</td>';
					echo '<td style="display:none;">' . $spec['compound'] . '</td>';
					echo '</tr>';
                }
				}
            }
        } else {
        	echo "<td colspan='8' style='text-align:center;'>No result was found</td>";					
        }

        echo '</table></div>';
        echo '<form method="post" action="'.base_url('home/import/existing/request').'" autocomplete="off">
                <p><b>Please select a specification:</b></p>
                <p><select id="spec_id" name="spec_id" style="height:45px; font-size:14px; width:600px; padding:5px;" required>
                    <option value=""></option>';

        if(!empty($all_specs)) {
            foreach($all_specs as $indx => $spec) {
                echo '<option value="'.$spec['spec_id'] .'">' . $spec['spec_id'] . '</option>';		
            }
        }

        echo '<input type="hidden" value="'.$this->session->userdata('selection').'" name="selectors"/>';

        echo '</select></p><input class="button" type="submit" value="Next" name="submit2" onsubmit="clearall();" />';
        echo '</form>';
    }

    if((isset($param) && true == in_array($param, array('version', NULL))) && !empty($spec_info['spec_gnrl'])) {
        echo '<p><b>Results</b></p>';
        echo '<table id="versiontable" name="versiontable" cellpadding="5" cellspacing="5" >';
        echo '<tbody>
                <tr>
                    <th style="width: 40%;" onclick="sortTable(1)">Specification ID</th>
                    <th style="width: 10%;" onclick="sortTable(2)">Version ID</th>
                    <th style="width: 10%;" onclick="sortTable(3)">Modification Date</th>
                    <th style="width: 10%;" onclick="sortTable(4)">Revised by</th>				
                    <th style="width: 20%;" onclick="sortTable(5)">Changes made</th>
                    <th style="width: 10%;" onclick="sortTable(6)">Spec Status</th>
                </tr>
        	  </tbody>';
		//print_r($spec_info['spec_gnrl']);exit;
        $spec_info_version = [];
        $current_version = 1;
        foreach($spec_info['spec_gnrl'] as $info) {
            if($info['islocked'] == '1')
            {
                $statusspec = 'In-Progress';
            }
            else{
                $statusspec = 'Live';
            }
        	echo "<tr>";
            //if()
           $spec_info_version[] =  $info['version_id'];
        	echo '<td>' . $info['spec_id'] . '</td>';
        	echo '<td>' . $info['version_id'] . '</td>';
            //$date = new DateTime($info['modification_date']);
            //$modification_date =  $date->format('Y-m-d');
            echo '<td>' . date("Y-m-d", strtotime($info['modification_date'])).  '</td>';
            //echo '<td>' . date('Y-m-d',strtotime($info['modification_date'])) . '</td>';
        	//echo '<td>' . $info['modification_date'] . '</td>';
        	echo '<td>' . $info['revised_by'] . '</td>';
        	echo '<td>' . $info['changes_made'] . '</td>';
            echo '<td>' . $statusspec . '</td>';
        	echo "</tr>";
        }
        $current_version = max($spec_info_version);
        //echo $current_version;exit;
        echo '</table>';
    }

    if(isset($param) && $param=="version") {
        if(strtolower($selected)=="modify") {
    		echo '<form method="post" target="_blank" action="'.base_url('home/import/existing/modify').'" onsubmit="checkVersion();" >';
        } elseif(strtolower($selected)=="importexisting") {
        	echo '<form method="post" target="_blank" action="'.base_url('home/import/existing/copy').'" onsubmit="checkVersion();" >';
        } elseif(strtolower($selected)=="reviewapprove") {
            echo '<form method="post" target="_blank" action="'.base_url('home/import/existing/revprove').'" onsubmit="checkVersion();" >';
        } elseif (strtolower($selected)=="exportesub") {
        	echo '<form method="post" target="_blank" action="'.base_url('home/export/esub').'" onsubmit="checkVersion();" >';
        
        } elseif (strtolower($selected)=="dstools") {
            echo '<form id="dstools" method="post" target="_blank" action="'.base_url('home/download/pdf').'" onsubmit="checkVersion();" >';
        } elseif(isset($spec_id) && empty($spec_id))  {
            echo "<h3>Please select a specification to proceed!</h3>";
        }

    	echo '<br/><p><b>Please select a version:</b><br/>';
    	echo '<select name="version_id" id="version_id" style="width: 700px; height: 40px; margin-top: 10px;" required>
                <option value="">Select Version</option>';

        foreach($spec_info['vrsn_list'] as $indx => $version_number) {
            echo "<option>" . $version_number . "</option>";
        }

        echo '</select>';
        echo '<input type="hidden" id="spec_id_approval" value="'.$info['spec_id'].'" name="spec_id" />';
        echo '<input type="hidden" id="spec_id_status" value="'.$info['islocked'].'" name="spec_status" />';
        echo '<br/><br/>';
        //$selected = "";
        // echo $selected;
        if(strtolower($selected) =="importexisting" || strtolower($selected) =="modify" || strtolower($selected) =="modify" ||  strtolower($selected) =="reviewapprove" || strtolower($selected) =="exportesub") {
            
              echo '<input class="button" type="submit" value="Next" name="submit3">';
              
          } else if(strtolower($selected) =="") {
             echo '<span style="color:red">Session is over, please login again.</span>';
          }
        
       
        //echo '</form>';
    }
	//print_r($all_specs);
    if (isset($param) && $param=="version" && strtolower($selected)=="dstools") {
    	echo '<div class="row">';
        echo '<div class="col col-md-2"><input class="button" type="submit" name="download_pdf" value="Download PDF" /></div>';
        echo '<div class="col col-md-2"><input class="button" type="submit" name="download_csv" formaction="'.base_url('home/download/csv').'" value="Download CSV" /></div>';
		echo '<div class="col col-md-2"><input class="button" type="submit" name="download_csv" formaction="'.base_url('home/download/word').'" value="Download DOC" /></div> ';
        echo '<div class="col col-md-2"><input class="button" type="submit" name="download_gc" formaction="'.base_url('home/download/generate/sas').'" value="Generate Code" /></div>';
        echo '<div class="col col-md-2"><input class="button" type="submit" name="download_rs" formaction="'.base_url('home/import/existing/drevprove').'" value="Review Spec" /></div>';
		echo '<div class="col col-md-2"><input class="button" type="submit" name="download_ms" formaction="' . base_url('home/import/existing/modify') . '" value="Modify Spec" /></div>';
		echo '<div class="col col-md-2" style="margin-top:10px;"><input onclick="openpopup()" style="padding: 10px;border-radius: 20px;" class="button" type="button" name="download_ms" value="Send Email" /></div>';
        echo '</div';
        echo '</form>';
    }
?>
		</div>
	</div>
</div>

<script type="text/javascript">
	function openpopup() 
    {
        var version_id = document.getElementById('version_id').value;
        var spec_id = document.getElementById('spec_id_approval').value;
        var spec_id_status = document.getElementById('spec_id_status').value;
        
        if(version_id == '')
        {
            alert('Please select Version Id to proceed further');
        }
        else
        {
            if(spec_id_status == '1')
            {
                alert('Not Allowed! Specification is In-progress');
            }
            else
            {
                document.getElementById('approval_spec_id').value = spec_id;
                document.getElementById('approval_version_id').value = version_id;
                $("#exampleModal").modal();
            }
        }
    }

	$('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })

    function sortTable(n) {
    	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    	table = document.getElementById("allspectable");
    	switching = true;
    	
    	// Set the sorting direction to ascending
    	dir = "asc"; 

    	/* Make a loop that will continue until no switching has been done */
    	while (switching) {
    		// Start by saying : no switching is done
    		switching = false;
    		rows = table.getElementsByTagName("TR");
    		/* Loop through all table rows (except the first, which contains table headers) */
    		for (i = 1; i < (rows.length - 1); i++) {
    			// Start by saying there should be no switching
    			shouldSwitch = false;
    			/* Get the two elements you want to compare, one from current row and one from the next */
    			x = rows[i].getElementsByTagName("TD")[n];
    			y = rows[i + 1].getElementsByTagName("TD")[n];
    			/* Check if the two rows should switch place, based on the direction, asc or desc */
    			if (dir == "asc") {
    				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
    				// If so, mark as a switch and break the loop
    				shouldSwitch= true;
    				break;
    			}
    		} else if (dir == "desc") {
    			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
    			// If so, mark as a switch and break the loop
    			shouldSwitch= true;
    			break;
    		}
    	  }
    	}

    	if (shouldSwitch) {
    		/* If a switch has been marked, make the switch and mark that a switch has been done */
    		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
    		switching = true;
    		// Each time a switch is done, increase this count by 1
    		switchcount ++;      
    	} else {
    		/* If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
		}
	}
}

    function myFunction() {
    	var input1 = document.getElementById("sid");
    	var filter1 = input1.value.toUpperCase();

    	var input2 = document.getElementById("cname");
    	var filter2 = input2.value.toUpperCase();

    	var input3 = document.getElementById("dstype");
    	var filter3 = input3.value.toUpperCase();

    	var input4 = document.getElementById("username");
    	var filter4 = input4.value.toUpperCase();

    	var input5 	= document.getElementById("indication");
    	var filter5 = input5.value.toUpperCase();

        var input6 = document.getElementById("lastmodifiedby");
        var filter6 = input6.value.toUpperCase();

    	var table	= document.getElementById("allspectable");

    	// clear options
    	var selectoption = document.getElementById("spec_id");
    	for(i = selectoption.options.length-1; i >=0 ; i--) {
    		selectoption.remove(i);
    	}

    	var options = [''];
    	for (i = 1; i < table.rows.length; i++) {
    		var td1 = table.rows[i].cells[0].innerHTML;
    		var td2 = table.rows[i].cells[10].innerHTML;
    		var td3 = table.rows[i].cells[4].innerHTML;
    		var td4 = table.rows[i].cells[1].innerHTML;
    		var td5 = table.rows[i].cells[3].innerHTML;
            var td6 = table.rows[i].cells[8].innerHTML;

    		if (td1.toUpperCase().indexOf(filter1) > -1 && td2.toUpperCase().indexOf(filter2) > -1 && td3.toUpperCase().indexOf(filter3) > -1 && td4.toUpperCase().indexOf(filter4) > -1 && td5.toUpperCase().indexOf(filter5) > -1 && td6.toUpperCase().indexOf(filter6) > -1 ) {
    			table.rows[i].style.display = "";
    			if(options.includes(table.rows[i].cells[0].innerHTML)==false) {
    				options.push(table.rows[i].cells[0].innerHTML);
    			}        			
    		} else {
    			table.rows[i].style.display = "none";
    		}
    	}

    	for (i = 0; i < options.length; i++) {
    		var option = document.createElement("option");
    		option.text = options[i];
    		selectoption.appendChild(option);
    	}       
    }

    function clearinput() {
    	var input1 = document.getElementById("sid");
    	if (input1) {
    		input1.value = '';
    	}

    	var input2 = document.getElementById("cname");
    	if (input2) {
    		input2.value = '';
    	}			

    	var input3 = document.getElementById("dstype");
    	if (input3) {
    		input3.value = '';
    	}

    	var input4 = document.getElementById("username");
    	if (input4) {
    		input4.value = '';
    	} 	

    	var input5 = document.getElementById("indication");
    	if (input5) {
    		input5.value = '';
    	} 	

        var input6 = document.getElementById("lastmodifiedby");
        if (input6) {
            input6.value = '';
        }			
    }

    function clearall() {
    	clearinput();

    	// clear options
    	var selectoption = document.getElementById("spec_id");
    	for(i = selectoption.options.length-1; i >=0 ; i--) {
    		selectoption.remove(i);
    	}

    	var options = [''];
    	var table = document.getElementById("allspectable");

    	for (i = 1; i < table.rows.length; i++) {
    		table.rows[i].style.display = "";
    		if(options.includes(table.rows[i].cells[0].innerHTML)==false) {
    			options.push(table.rows[i].cells[0].innerHTML);
    		} 
    	}

    	for (i = 0; i < options.length; i++) {
    		var option = document.createElement("option");
    		option.text = options[i];
    		selectoption.appendChild(option);
    	} 
    }

    function submitForm(action) {
    	var form = document.getElementById('dstools');
    	form.action = action;
    	form.submit();
    }

   function checkVersion() {
        var selected = document.getElementById('version_id').value;
        var current = "<?php echo $current_version;?>" ;
        if(selected != current) {
            alert("An older version was selected!");
        }
    }

//     $( document ).ready(function() {
//     var windowName = 'userConsole'; 
//     var popUp = window.open('/popup', windowName, 'width=1000, height=700, left=24, top=24, scrollbars, resizable');
//     if (popUp == null || typeof(popUp)=='undefined') {  
        
//     } 
//     else {  
//     alert('Please disable your pop-up blocker and click the "Open" link again.'); 
    
// }
// });
</script>