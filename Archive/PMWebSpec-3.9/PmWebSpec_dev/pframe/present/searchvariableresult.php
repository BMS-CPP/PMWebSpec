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
				<label>Variable Name </label>
				<input type="text" name="vname" id="vname" onkeyup="myFunction()" placeholder="Enter Varible Name" />

				<!-- <label>Dataset Type </label>
			    <input type="text" name="dstype" id="dstype" onkeyup="myFunction()" placeholder="PPK etc." /> -->

			    <label>Variable Label </label>
				<input type="text" name="vlable" id="vlable" onkeyup="myFunction()" placeholder="Enter Variable Label" />

                <label>Spec ID </label>
                <input type="text" name="spec_id" id="spec_id" onkeyup="myFunction()" placeholder="Enter Spec ID" />

				<!-- <label>Notes </label>
				<input type="text" name="vnote" id="vnote" onkeyup="myFunction()" placeholder="Enter Notes" />  -->

                <label>Source </label>
                <input type="text" name="vsource" id="vsource" onkeyup="myFunction()" placeholder="Enter Source" /> 

			   <!--  <label>Flag Number </label>
			    <input type="text" name="flnum" id="flnum" onkeyup="myFunction()" placeholder="Flag number" /> -->

                <button type="button" style="width: auto;padding: 10px;" onClick="searchvariable()" class="button2">Search</button>

				<button type="button" style="width: auto;padding: 10px;" onClick="clearall()" class="button2"><i class="w3-margin-left material-icons">clear</i>clear filters</button>
			</div>

			<br/>

			<p><b>Results</b></p>
			<div id="allflags" class="">
    			<table id="allflagtable" name="allspectable" cellpadding="5" cellspacing="5" >
        			<thead>      
        				<tr>
            				<th style="width: 150px;">Variable Name</th>
            				<th style="width: 200px;">Spec ID</th>
            				<th style="width: 150px;">Variable Label</th>
            				<th style="width: 50px;">Units</th>
            				<th style="width: 100px;">Type</th>
            				<th style="width: 100px;">Rounding</th>
            				<th style="width: 100px;">Missing Value</th>
            				<th style="width: 300px;">Notes</th>
            				<th style="width: 300px;">Source</th>
        				</tr>
        			</thead>
                    <tbody id="searchvariableresult" class="searchvariableresult"> 
        			<?php
                     echo '<tr>
                        <td>Result Not Found!</td>
                    </tr>';
             			// if(!empty($getvariable)) {
             			// 	foreach($getvariable as $arr) {
             			// 		echo "<tr>";
             			// 		echo '<td>' . $arr['var_name'] . '</td>';
             			// 		echo '<td>' . $arr['spec_id'] . '</td>';
             			// 		echo '<td>' . $arr['var_label'] . '</td>';
             			// 		echo '<td>' . $arr['var_units'] . '</td>';
             			// 		echo '<td>' . $arr['var_type'] . '</td>';
             			// 		echo '<td>' . $arr['var_rounding'] . '</td>';
             			// 		echo '<td>' . $arr['var_missing_value'] . '</td>';
             			// 		echo '<td>' . htmlspecialchars($arr['var_notes']) . '</td>';
             			// 		echo '<td>' . htmlspecialchars($arr['var_source']) . '</td>';
             			// 		echo "</tr>";
             	 	// 		}
             	 	// 	} else {
                //             echo "<tr>";
                //             echo '<td>No result was found</td>';
             			// 	// echo "No result was found";
                //             echo "</tr>";
             			// }
        			?> 		
				</table>
			</div>
		</div>

		<script>
            function searchvariable() 
            {
                var vname = $('#vname').val();
                var vlable = $('#vlable').val();
                var spec_id = $('#spec_id').val();
                var vsource = $('#vsource').val();
                if (vname != "" || vlable != "" || spec_id != "")
                {
                    $.ajax({
                        url:"<?php echo base_url(); ?>home/getsearchvariableresult/",
                        type: "post",    //request type,
                        data: {vname: vname, vlable: vlable,spec_id: spec_id,vsource:vsource},
                        success: function(data)
                        {
                            $('#searchvariableresult').html(data);
                            
                        }
                    });
                }
                else
                {
                    alert('Please enter Varibale name, Variable label or Spec ID');
                    $('#searchvariableresult').html('<tr nobr="true"><td>No result was found</td></tr>');
                }
            }

			function myFunction() {
      			var input1 = document.getElementById("vname");
     			var filter1 = input1.value.toUpperCase();

     			var input2 = document.getElementById("dstype");
     			var filter2 = input2.value.toUpperCase();

     			var input3 = document.getElementById("vlable");
     			var filter3 = input3.value.toUpperCase();

     			var input4 = document.getElementById("vnote");
     			var filter4 = input4.value.toUpperCase();

     			// var input3 = document.getElementById("flnum");
     			// var filter3 = input3.value.toUpperCase();

      			var table = document.getElementById("allflagtable");

      			for (i = 1; i < table.rows.length; i++) {
      				var td1 = table.rows[i].cells[0].innerHTML;
      				var td2 = table.rows[i].cells[1].innerHTML;
      				var td3 = table.rows[i].cells[2].innerHTML;
      				var td4 = table.rows[i].cells[7].innerHTML;

      				// if (filter3) {
    	    	// 		if (td1.toUpperCase().indexOf(filter1) > -1 && td2.toUpperCase().indexOf(filter2) > -1) {
    	     //    			table.rows[i].style.display = "";      			
    	     //  			} else {
    	     //    			table.rows[i].style.display = "none";
    	     //  			}
      				// } else {
      					if (td1.toUpperCase().indexOf(filter1) > -1 && td2.toUpperCase().indexOf(filter2) > -1 && td3.toUpperCase().indexOf(filter3) > -1 && td4.toUpperCase().indexOf(filter4) > -1) {
            				table.rows[i].style.display = "";      			
    	      			} else {
    	        			table.rows[i].style.display = "none";
    	      			}
      				// }
        		}    
    		}

    		function clearinput() {
      			var input1 = document.getElementById("vname");
      			if (input1) {
      				input1.value = '';
      			}

     			var input2 = document.getElementById("spec_id");
     			if (input2) {
     				input2.value = '';
     			}	

     			var input3 = document.getElementById("vlable");
     			if (input3) {
     				input3.value = '';
     			}

     			var input3 = document.getElementById("vnote");
     			if (input3) {
     				input3.value = '';
     			}		

                var input4 = document.getElementById("vsource");
                if (input4) {
                    input4.value = '';
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
