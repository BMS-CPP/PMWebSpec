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
			
			<p><b>Study Details</b></p>
			<div id="allflags" class="">
    			<table id="allflagtable" name="allspectable" cellpadding="5" cellspacing="5" >
        			<tbody>			  
        				<tr>
            				<th style="width: 100px;">Study</th>
            				<th style="width: 100px;">Statistician</th>
            				<th style="word-wrap:break-word;">level0</th>
            				<th style="word-wrap:break-word;">level1/SDTM</th>
            				<th style="word-wrap:break-word;">level2</th>
            				<th style="word-wrap:break-word;">format</th>
        				</tr>
        			</tbody>

        			<?php
					//print_r($flag);exit;
             			if(!empty($studydetails)) {
             				foreach($studydetails as $arr) {
             					echo "<tr>";
             					echo '<td>' . $arr['study'] . '</td>';
             					echo '<td>' . $arr['statistician'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['level0'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['level1'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['level2'] . '</td>';
             					echo '<td style="word-wrap:break-word;">' . $arr['format'] . '</td>';
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