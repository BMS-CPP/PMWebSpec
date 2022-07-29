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
				<label>Compound Name </label>
				<input type="text" name="cname" id="cname" onkeyup="myFunction()" placeholder="Test-" />

				<label>Dataset Type </label>
			    <input type="text" name="dstype" id="dstype" onkeyup="myFunction()" placeholder="PPK etc." />

			    <label>Flag Number </label>
			    <input type="text" name="flnum" id="flnum" onkeyup="myFunction()" placeholder="Flag number" />

				<button type="button" onClick="clearall()" class="button2"><i class="w3-margin-left material-icons">clear</i>clear filters</button>
			</div>

			<br/>

			<p><b>Results</b></p>
			<div id="allflags" class="">
    			<table id="allflagtable" name="allspectable" cellpadding="5" cellspacing="5" >
        			<tbody>			  
        				<tr>
            				<th style="width: 150px;">Compound Name</th>
            				<th style="width: 150px;">Dataset Type</th>
            				<th style="width: 100px;">Flag number</th>
            				<th style="width: 300px;">Flag comment</th>
            				<th style="width: 300px;">Flag notes</th>
        				</tr>
        			</tbody>

        			<?php
					//print_r($flag);exit;
             			if(!empty($flag)) {
             				foreach($flag as $arr) {
             					echo "<tr>";
             					echo '<td>' . $arr['compound'] . '</td>';
             					echo '<td>' . $arr['type'] . '</td>';
             					echo '<td>' . $arr['flag_number'] . '</td>';
             					echo '<td>' . $arr['flag_comment'] . '</td>';
             					echo '<td>' . $arr['flag_notes'] . '</td>';
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
      			var input1 = document.getElementById("cname");
     			var filter1 = input1.value.toUpperCase();

     			var input2 = document.getElementById("dstype");
     			var filter2 = input2.value.toUpperCase();

     			var input3 = document.getElementById("flnum");
     			var filter3 = input3.value.toUpperCase();

      			var table = document.getElementById("allflagtable");

      			for (i = 1; i < table.rows.length; i++) {
      				var td1 = table.rows[i].cells[0].innerHTML;
      				var td2 = table.rows[i].cells[1].innerHTML;
      				var td3 = table.rows[i].cells[2].innerHTML;

      				if (filter3) {
    	    			if (td1.toUpperCase().indexOf(filter1) > -1 && td2.toUpperCase().indexOf(filter2) > -1 && td3.toUpperCase()===filter3) {
    	        			table.rows[i].style.display = "";      			
    	      			} else {
    	        			table.rows[i].style.display = "none";
    	      			}
      				} else {
      					if (td1.toUpperCase().indexOf(filter1) > -1 && td2.toUpperCase().indexOf(filter2) > -1) {
            				table.rows[i].style.display = "";      			
    	      			} else {
    	        			table.rows[i].style.display = "none";
    	      			}
      				}
        		}    
    		}

    		function clearinput() {
      			var input1 = document.getElementById("cname");
      			if (input1) {
      				input1.value = '';
      			}

     			var input2 = document.getElementById("dstype");
     			if (input2) {
     				input2.value = '';
     			}	

     			var input3 = document.getElementById("flnum");
     			if (input3) {
     				input3.value = '';
     			}							
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
