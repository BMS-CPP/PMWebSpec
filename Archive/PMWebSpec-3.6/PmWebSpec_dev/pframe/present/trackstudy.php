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
		<br/>
		<div class="main-body">
			<p><b>Filters</b></p>
			<div class="input-style">
				<label>Specification ID </label>
				<input type="text" name="vname" id="vname" onkeyup="myFunction()" placeholder="Enter Spec ID" />

				<label>Dataset Inclusion Criteria </label>
			    <input type="text" name="dstype" id="dstype" onkeyup="myFunction()" placeholder="Enter Dataset Inclusion Criteria" />

			    <label>GBDS Location </label>
				<input type="text" name="vlable" id="vlable" onkeyup="myFunction()" placeholder="Enter GBDS Location" />

				<!-- <label>Notes </label>
				<input type="text" name="vnote" id="vnote" onkeyup="myFunction()" placeholder="Enter Notes" /> -->

			   <!--  <label>Flag Number </label>
			    <input type="text" name="flnum" id="flnum" onkeyup="myFunction()" placeholder="Flag number" /> -->

				<button type="button" onClick="clearall()" class="button2"><i class="w3-margin-left material-icons">clear</i>clear filters</button>
			</div>

			<br/>

			<p><b>Results</b></p>
			<div id="allflags" class="">
    			<table id="allflagtable" name="allspectable" cellpadding="5" cellspacing="5" >
        			<tbody>			  
        				<tr>
            				<th style="word-wrap:break-word;">Specification ID</th>
            				<th>Dataset Inclusion Criteria</th>
            				<th style="width: 200px;">Last Modification Date</th>
            				<th style="word-wrap:break-word;">Dataset Location</th>
            				<th style="word-wrap:break-word;">GBDS Location</th>
            				<th style="word-wrap:break-word;">GBDS Location Details</th>
        				</tr>
        			</tbody>

        			<?php
					//print_r($flag);exit;
             			if(!empty($getresult)) {
             				foreach($getresult as $arr) {
             					echo "<tr>";
             					echo '<td style="word-wrap:break-word;">' . $arr['spec_id'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['dataset_inclusion'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['modification_date'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['dataset_path'] . '</td>';
             					//echo '<td><a href="'. base_url().'home/getstudydetails/'.$arr['spec_id'].'/'.$arr['version_id'].'"><u>' . $arr['study'] . '</a></u></td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['study'] . '</td>';
             					if(!empty($arr['study']))
             					{
             						echo '<td style="word-wrap:break-word;"><a target="_blank" href="'. base_url().'home/getstudydetails/'.$arr['spec_id'].'/'.$arr['version_id'].'"><u>Click here</a></u></td>';
             					}
             					else
             					{
             						echo '<td style="word-wrap:break-word;"> - </td>';
             					}
             					echo "</tr>";
             	 			}
             	 		} else {
             				echo "No result was found";
             			}
        			?> 		
				</table>
			</div>
		</div>
		<script>
			function myFunction() {
      			var input1 = document.getElementById("vname");
     			var filter1 = input1.value.toUpperCase();

     			var input2 = document.getElementById("dstype");
     			var filter2 = input2.value.toUpperCase();

     			var input3 = document.getElementById("vlable");
     			var filter3 = input3.value.toUpperCase();

      			var table = document.getElementById("allflagtable");

      			for (i = 1; i < table.rows.length; i++) {
      				var td1 = table.rows[i].cells[0].innerHTML;
      				var td2 = table.rows[i].cells[1].innerHTML;
      				var td3 = table.rows[i].cells[4].innerHTML;

  					if (td1.toUpperCase().indexOf(filter1) > -1 && td2.toUpperCase().indexOf(filter2) > -1 && td3.toUpperCase().indexOf(filter3) > -1) {
        				table.rows[i].style.display = "";      			
	      			} else {
	        			table.rows[i].style.display = "none";
	      			}
        		}    
    		}

    		function clearinput() {
      			var input1 = document.getElementById("vname");
      			if (input1) {
      				input1.value = '';
      			}

     			var input2 = document.getElementById("dstype");
     			if (input2) {
     				input2.value = '';
     			}	

     			var input3 = document.getElementById("vlable");
     			if (input3) {
     				input3.value = '';
     			}

     			// var input3 = document.getElementById("vnote");
     			// if (input3) {
     			// 	input3.value = '';
     			// }							
    		}

    		function clearall() {
      			clearinput();

     			var table = document.getElementById("allflagtable");
     			for (i = 1; i < table.rows.length; i++) {
     				table.rows[i].style.display = "";
     			}		
    		}
		</script>
	</body>
</html>