	    // functions to open the panel 
		function openpanel() {
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
		}
		
		
		// functions to open the tab
        function openTab(evt, tabName) {
             var i, tabcontent, tablinks;
             tabcontent = document.getElementsByClassName("tabcontent");
             for (i = 0; i < tabcontent.length; i++) {
                 tabcontent[i].style.display = "none";
             }
             tablinks = document.getElementsByClassName("tablinks");
             for (i = 0; i < tablinks.length; i++) {
                 tablinks[i].className = tablinks[i].className.replace(" active", "");
             }
             document.getElementById(tabName).style.display = "block";
             evt.currentTarget.className += " active";
         }
         
         // Get the element with id="defaultOpen" and click on it
         /*document.getElementById("defaultOpen").click();*/
		 
		function pad(n, width, z) {
			z = z || '0';
			n = n + '';
			return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
		}

		 // function to add row to the structure table
		function addInput(divName){
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
				checkbox.style.width="22px";

				var td01 = document.createElement("td");
				var varnum = document.createElement("input");
				varnum.className="struct";
				varnum.value=pad(index, 3);
				varnum.style.width="58px";
				varnum.style.height="40px";
				varnum.readOnly = true;
				
				var td02 = document.createElement("td");
				td02.style.display="none";
				var varflag1 = document.createElement("input");
				varflag1.className="struct";
				varflag1.value='0';
				
				var td03 = document.createElement("td");
				td03.style.display="none";
				var varflag2 = document.createElement("input");
				varflag2.className="struct";
				varflag2.value='1';
				
				var td04 = document.createElement("td");
				td04.style.display="none";
				var varflag3 = document.createElement("input");
				varflag3.className="struct";
				varflag3.value='1';
				
				var td05 = document.createElement("td");
				td05.style.display="none";
				var varflag4 = document.createElement("input");
				varflag4.className="struct";
				varflag4.value='1';
				
				var td06 = document.createElement("td");
				td06.style.display="none";
				var varflag5 = document.createElement("input");
				varflag5.className="struct";
				varflag5.value='1';
				
				var td07 = document.createElement("td");
				td07.style.display="none";
				var varflag6 = document.createElement("input");
				varflag6.className="struct";
				varflag6.value='1';
				
				var td08 = document.createElement("td");
				td08.style.display="none";
				var varflag7 = document.createElement("input");
				varflag7.className="struct";
				varflag7.value='1';
				
				var td09 = document.createElement("td");
				td09.style.display="none";
				var varflag8 = document.createElement("input");
				varflag8.className="struct";
				varflag8.value='1';
				
				var td010 = document.createElement("td");
				td010.style.display="none";
				var varflag9 = document.createElement("input");
				varflag9.className="struct";
				varflag9.value='1';
				
				var td1 = document.createElement("td");
				var input1 = document.createElement("input");
				input1.className="struct";
				input1.setAttribute('maxlength',"8");
				input1.value='';
				input1.style.width="90px";
				input1.style.height="40px";
				input1.style.textTransform="uppercase";
				
				var td2 = document.createElement("td");
				var input2 = document.createElement("input")
				input2.className="struct";
				input2.setAttribute('maxlength',"40");
				input2.value='';
				input2.style.width="274px";
				input2.style.height="40px";
				
				var td3 = document.createElement("td");
				var input3 = document.createElement("input");
				input3.className="struct";
				input3.value='NA';
				input3.style.width="82px";
				input3.style.height="40px";

				var td4 = document.createElement("td");
				var selectlist = ["Char","Num"];
				//Create and append select list
				var selectbutton = document.createElement("select");
				selectbutton.className="struct";
				selectbutton.style.width="82px";
				//selectbutton.id="char_selectid"+index;
				//selectbutton.setAttribute("onchange",'char_select()');
				//Create and append the options
				for (var i = 0; i < selectlist.length; i++) {
					var option = document.createElement("option");
					option.value = selectlist[i];
					option.text = selectlist[i];
					selectbutton.appendChild(option);
				}

				var td5 = document.createElement("td");
				var selectlist2 = ["NA","0.1","0.01","0.001","1","3 significant digits","4 significant digits"];
				//Create and append select list
				var selectbutton2 = document.createElement("select");
				selectbutton2.className="struct";
				//selectbutton2.id="charfinal"+index;
				//selectbutton2.setAttribute('disabled','disabled');
				selectbutton2.style.width="82px";
				//Create and append the options
				for (var i = 0; i < selectlist2.length; i++) {
					var option = document.createElement("option");
					option.value = selectlist2[i];
					option.text = selectlist2[i];
					selectbutton2.appendChild(option);
				}

				var td6 = document.createElement("td");
				var input6 = document.createElement("input");
				input6.className="struct";
				input6.style.width="82px";
				//input6.setAttribute('disabled','disabled');
				//input6.value('blank');
				input6.id="defultvalue"+index;
				input6.style.height="40px";
				input6.value="blank";
				
				var td7 = document.createElement("td");
				var input7 = document.createElement("textarea");
				input7.className="struct";
				input7.style.width="248px";
				
				var td8 = document.createElement("td");
				var input8 = document.createElement("textarea");
				input8.className="struct";
				input8.style.width="248px";

				td0.appendChild(checkbox);				
				td01.appendChild(varnum);
				td02.appendChild(varflag1);		
				td03.appendChild(varflag2);	
				td04.appendChild(varflag3);	
				td05.appendChild(varflag4);	
				td06.appendChild(varflag5);	
				td07.appendChild(varflag6);	
				td08.appendChild(varflag7);	
				td09.appendChild(varflag8);	
				td010.appendChild(varflag9);					
				td1.appendChild(input1);
				td2.appendChild(input2);
				td3.appendChild(input3);
				td4.appendChild(selectbutton);
				td5.appendChild(selectbutton2);				
				td6.appendChild(input6);
				td7.appendChild(input7);				
				td8.appendChild(input8);
				
				tr.appendChild(td0);
				tr.appendChild(td01);
				tr.appendChild(td02);
				tr.appendChild(td03);
				tr.appendChild(td04);
				tr.appendChild(td05);
				tr.appendChild(td06);
				tr.appendChild(td07);
				tr.appendChild(td08);
				tr.appendChild(td09);
				tr.appendChild(td010);
				tr.appendChild(td1);
				tr.appendChild(td2);
				tr.appendChild(td3);
				tr.appendChild(td4);
				tr.appendChild(td5);
				tr.appendChild(td6);
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
		

		// function to retrieve information from the tables
		function retrieveinfo(displayid, tableid) {
			document.getElementById(displayid).innerHTML = '';
			var table = document.getElementById(tableid);
			var input = table.getElementsByClassName('struct');	
			document.getElementById(displayid).value = '';			
			for (var z = 0; z < input.length;  z++) {
				document.getElementById(displayid).value += input[z].value;
				document.getElementById(displayid).value += '@@';
			}			
		}
		
		function findDuplicate(arr1) {
			var result = arr1.filter(function(value, index, array) {return array.indexOf(value) !== index; });
			return result;
		}

		function isValid(str) { return /^[A-Za-z_]\w*$/.test(str); }

		function checkfield(fieldId, message) {
			var content = document.getElementById(fieldId);

			if (content.value=="") {
				alert(message);
				return false;
			} else {
				if(fieldId=="dataset_name" && isValid(content.value)===false) {
					alert("Dataset name should only contain letters, numbers and underscore. It must be 8 characters or less");
					return false;
				} else {
					return true;
				}
				
			}							
		}

		function validateMyForm() {
			// console.log('hi');
			var valid=true;

			if(checkfield('title', 'Title cannot be empty')===false) {
				valid=false;
			}
			if(checkfield('project_name', 'Project name cannot be empty')===false) {
				valid=false;
			}
			if(checkfield('version_id', 'Version cannot be empty')===false){
				valid=false;
			}			
			if(checkfield('pk_scientist', 'PK scientist cannot be empty')===false){
				valid=false;
			}
			if(checkfield('pm_scientist', 'PM scientist cannot be empty')===false){
				valid=false;
			}
			if(checkfield('statistician', 'Statistician cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_name', 'Dataset name cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_label', 'Dataset label cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_descriptor', 'Dataset description cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_records', 'Dataset contains cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_criteria', 'Dataset criteria (study and cohort to include) cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_sort', 'Dataset sorting variable(s) cannot be empty')===false){
				valid=false;
			}
			if(checkfield('dataset_date', 'Dataset delivery date cannot be empty')===false){
				valid=false;
			}

			//retrieve information from the structure table
			var table = document.getElementById('myTable');	
			var input = table.getElementsByClassName('struct');
			var arr = [];
			
			for (var z = 0; z < input.length;  z++) {		
				if (z % 18 ==10) {	
					//check if variable name is missing
					if (input[z].value=="") {
						alert("Variable name cannot be empty");
						valid=false;
					} 
					else if (isValid(input[z].value)===false) {
						alert("Variable "+input[z].value+" can only contain letters, numbers, or underscore and must start with letters or underscore. Please check variable names!");
						valid=false;
					}
					else {
						arr.push(input[z].value.toUpperCase());
					}				
					
				} else if (z % 18 ==11) {
					//check if variable label is missing
					if (input[z].value=="") {
						alert("Variable label cannot be empty");
						valid=false;
					}

					if (input[z+1].value=='NA') {
						var total = input[z].value;
					} else {
						var total = input[z].value + "(" + input[z+1].value + ")";
					}
					
					if (total.length>40) {
						alert("The length of label "+input[z].value+"  + unit is greater than 40 characters for variable " + input[z-1].value);
						valid=false;
					}
				}					
			}
			// console.log(findDuplicate(arr).length);
			
			if(findDuplicate(arr).length > 0) { 
				alert("Variable " + findDuplicate(arr) + " already exist!");
				valid=false;
			}

			
			var cname= document.getElementById("cname").value;

			return valid;
		}
		
		//function to clear all checked variables
		function clearChecked() {
			var table = document.getElementById('myTable');	
			var input = table.getElementsByClassName('checkboxc');
			for (var z = 0; z < input.length;  z++) {
				input[z].checked = false;
			}
		}
		
		// function to retrieve information from all of the tables on click of the submit button
		function displaytext() {
			//sort table
			sortTable(0, 1)

			//retrieve information from the structure table
			var table = document.getElementById('myTable');	
			var input = table.getElementsByClassName('struct');
			document.getElementById('passvalue').value = '';
			for (var z = 0; z < input.length;  z++) {
				document.getElementById('passvalue').value += input[z].value;
				document.getElementById('passvalue').value += '@@';								
			}
			
			//retrieve information from the pk table
			retrieveinfo('pkdata', 'pkTable')
			
			//retrieve information from the clinical source table
			retrieveinfo('clinical', 'pathTable')
			
			//retrieve information from the PKMS path table
			retrieveinfo('pkms','libTable')
			
			//retrieve information from the derivation table
			retrieveinfo('derive','deriveTable')
			
			//retrieve information from the flag table
			retrieveinfo('flgs','flagTable')

			//retrieve information from the confirmation table
			retrieveinfo('confs','confirmTable')
		}

		// function to show delete variables 
		function showdelete(tableid) {

			if(tableid=='myTable') {
				//sort table
				sortTable(0, 1)
			}

			var arr=[];
			var arr2=[];
			var table = document.getElementById(tableid);
			var inputElements = table.getElementsByClassName('checkboxc');
			var input = table.getElementsByClassName('struct');
			var cols = table.rows[0].cells.length - 1;
			for(var i=0; inputElements[i]; ++i){
				if(inputElements[i].checked){
					if(tableid=="myTable") {
						if(input[i*18+1].value=="1") {
							alert("Required variable cannot be deleted!");
						} else {
							arr.push(i);
							arr2.push(input[i*18+10].value);
						}

					} else {
						arr.push(i);
					}				
				}
			}

			var adj=0;
			var arrayLength = arr.length;
			for (var i = 0; i < arrayLength; i++) {
				table.deleteRow(arr[i]+1-adj);
				adj++;
			}

			if(tableid=="myTable") {
				var rows = table.rows;	
				var rowlen = rows.length;
				for (var j=0; j < rowlen-1; j++) {
					input[j*18].value = pad(j+1, 3);
				} 
				// add rows back to the optional variable table
				for (var z=0; z <arr2.length; z++) {
					for (var k=0; k<otheroptional.length; k++) {
           				if(arr2[z]==otheroptional[k][0]) {
           					addvaropt(otheroptional[k]); 
           				}
           			}					
				}
			}
		}


		// add variable to the optional variable table
		function addvaropt(vararray) {
			
			var table = document.getElementById("allspectable"); 

			var tr = document.createElement("tr");
			var td0 = document.createElement("td");
			var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";	
				checkbox.value = "value";
				checkbox.id = "id";	
				checkbox.style.width="24px";
				
			var td1 = document.createElement("td");
				td1.innerHTML = vararray[0];
				td1.className = "varname";
				
			var td2 = document.createElement("td");
				td2.innerHTML = vararray[1];
				
			var td3 = document.createElement("td");
				td3.innerHTML = vararray[2];

			var td4 = document.createElement("td");
				td4.innerHTML = vararray[3];

			var td5 = document.createElement("td");
				td5.innerHTML = vararray[4];

			var td6 = document.createElement("td");
				td6.innerHTML = vararray[5];
				
			var td7 = document.createElement("td");
				td7.innerHTML = vararray[6];
				
			var td8 = document.createElement("td");
				td8.innerHTML = vararray[7];	

			td0.appendChild(checkbox);	
			tr.appendChild(td0);
			tr.appendChild(td1);
			tr.appendChild(td2);
			tr.appendChild(td3);
			tr.appendChild(td4);
			tr.appendChild(td5);
			tr.appendChild(td6);
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

		// function to move variables up and down
		function updown(direction) {
			//sort table
			sortTable(0, 1)

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
			
			// check if the table is sorted 
			for (i = 1; i < (rows.length - 1); i++) {
				//start by saying there should be no switching:
				Switch = false;
				/*Get the two elements you want to compare, one from current row and one from the next:*/
				x = rows[i].getElementsByClassName("struct")[0];
				y = rows[i + 1].getElementsByClassName("struct")[0];
				/*check if the two rows should switch place, based on the direction, asc or desc:*/
				
				if (x.value.toLowerCase() > y.value.toLowerCase()) {
					Switch= true;
					break;
				}
			}					
			
			if (direction === "up") {
				for (var i=0; i < arrayLength; i++){
					var index=arrindex[i];
					var parent = rows[index].parentNode;
					if (Switch == true) {
						alert("Please sort variables by ascending order before moving up or down!");
					} else if (index>1) {
						parent.insertBefore(rows[index], rows[index-1]);					
					}
					
					var rowlen = rows.length;
					for (var j=0; j < rowlen-1; j++) {
						input[j*18].value = pad(j+1, 3);
					} 
				}						
			} else if (direction === "down") {
				for (var i=arrayLength-1; i >=0; i--){
					var index=arrindex[i];
					var parent = rows[index].parentNode;
					if (Switch == true) {
						alert("Please sort variables by ascending order before moving up or down!");
					} else if (index <= rows.length-2) {
						parent.insertBefore(rows[index+1], rows[index]);
					}
						
					var rowlen = rows.length;
					for (var j=0; j < rowlen-1; j++) {
						input[j*18].value = pad(j+1, 3);
					} 
								
				}
			}			
		}

		// function to move flags up and down
		function updown2(direction) {
			var table = document.getElementById('flagTable');
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
					if (index>1) {
						parent.insertBefore(rows[index], rows[index-1]);					
					}					
				}						
			} else if (direction === "down") {
				for (var i=arrayLength-1; i >=0; i--){
					var index=arrindex[i];
					var parent = rows[index].parentNode;
					if (index <= rows.length-2) {
						parent.insertBefore(rows[index+1], rows[index]);
					}								
				}
			}			
		}

 		// function to add row to the esub table
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
				var input1 = document.createElement("input")
				input1.className="struct";
				input1.setAttribute('maxlength',"8");
				input1.required = true;
				input1.value='';
				input1.style="width:100%; height: 40px; text-transform: uppercase;";
				input1.setAttribute('pattern',"[A-Za-z_0-9]{1,8}"); 
				
				var td2 = document.createElement("td");
				var input2 = document.createElement("input")
				input2.className="struct";
				input2.setAttribute('maxlength',"40");
				input2.required=true;
				input2.value='';
				input2.style="width:100%; height: 40px;";
			
				
				var td7 = document.createElement("td");
				var input7 = document.createElement("textarea")
				input7.className="struct";
				input7.style="width:100%;";
				
				var td8 = document.createElement("td");
				var input8 = document.createElement("textarea")
				input8.className="struct";
				input8.style="width:100%;";
				
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
		
		// function to add row to the flag table
		function addVer(){
			var table = document.getElementById('verTable');
			var tr = document.createElement("tr");
			var td0 = document.createElement("td");
			var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";
				
			var td1 = document.createElement("td");
			var input1 = document.createElement("input")
				input1.className="struct";
				input1.style.width="100%";
				input1.style.height="40px";
			
			var td2 = document.createElement("td");
			var input2 = document.createElement("input")
				input2.type="date";
				input2.className="struct";
				input2.style.width="100%";
				input2.style.height="40px";

			var td3 = document.createElement("td");
			var input3 = document.createElement("input")
				input3.className="struct";
				input3.style.width="100%";
				input3.style.height="40px";

			var td4 = document.createElement("td");
			var input4 = document.createElement("textarea")
				input4.className="struct";
				input4.style.width="100%";
				input4.style.height="40px";				
				
				td0.appendChild(checkbox);	
				td1.appendChild(input1);
				td2.appendChild(input2);
				td3.appendChild(input3);
				td4.appendChild(input4);
				
				tr.appendChild(td0);
				tr.appendChild(td1);
				tr.appendChild(td2);
				tr.appendChild(td3);
				tr.appendChild(td4);
				table.appendChild(tr);
		}	
				
		// function to add row to the pk table
		function addStudypk(){
			var table = document.getElementById('pkTable');
			var tr = document.createElement("tr");
			var td0 = document.createElement("td");
			var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";
				
			var td1 = document.createElement("td");
			var input1 = document.createElement("input")
				input1.className="struct";
				input1.style.width="100%";
				input1.style.height="40px";
			
			var td2 = document.createElement("td");
			var selectlist = ["Wave 2","Gap","PK optimization","Legacy","Direct Data Capture", "eDM", "RAVE", "Other"];
			//Create and append select list
			// var selectbutton1 = document.createElement("select");
			var selectbutton1 = document.createElement("input");
				selectbutton1.className="struct";
				selectbutton1.style.width="100%";
				selectbutton1.style.height="40px";

			var td3 = document.createElement("td");
			var selectlist = ["Concentration Lock","Analysis Lock", "Other"];
			

			var selectbutton2 = document.createElement("input");
				selectbutton2.className="struct";
				selectbutton2.style.width="100%";
				selectbutton2.style.height="40px";
							
			td0.appendChild(checkbox);	
			td1.appendChild(input1);
			td2.appendChild(selectbutton1);
			td3.appendChild(selectbutton2);
				
			tr.appendChild(td0);
			tr.appendChild(td1);
			tr.appendChild(td2);
			tr.appendChild(td3);
			table.appendChild(tr);
		}
		
		
		// function to add row to the clincal data path table
		function addPath(){
			var table = document.getElementById('pathTable');
			var tr = document.createElement("tr");
			var td0 = document.createElement("td");
			var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";
				
			var td1 = document.createElement("td");
			var input1 = document.createElement("input")
				input1.className="struct";
				input1.style.width="100%";
				input1.style.height="60px";
			
			var td2 = document.createElement("td");
			var input2 = document.createElement("input")
				input2.className="struct";
				input2.style.width="100%";
				input2.style.height="60px";

			var td3 = document.createElement("td");
			var input3 = document.createElement("textarea")
				input3.className="struct";
				input3.style.width="100%";
				input3.style.height="60px";

			var td4 = document.createElement("td");
			var input4 = document.createElement("textarea")
				input4.className="struct";
				input4.style.width="100%";
				input4.style.height="60px";

			var td5 = document.createElement("td");
			var input5 = document.createElement("textarea")
				input5.className="struct";
				input5.style.width="100%";
				input5.style.height="60px";
				
			var td6 = document.createElement("td");
			var input6 = document.createElement("textarea")
				input6.className="struct";
				input6.style.width="100%";
				input6.style.height="60px";
				
				td0.appendChild(checkbox);	
				td1.appendChild(input1);
				td2.appendChild(input2);
				td3.appendChild(input3);
				td4.appendChild(input4);
				td5.appendChild(input5);
				td6.appendChild(input6);
				
				tr.appendChild(td0);
				tr.appendChild(td1);
				tr.appendChild(td2);
				tr.appendChild(td3);
				tr.appendChild(td4);
				tr.appendChild(td5);
				tr.appendChild(td6);
				table.appendChild(tr);
		}
				
		
		// function to add row to the pkms path table
		function addLib(){
			var table = document.getElementById('libTable');
			var tr = document.createElement("tr");
			var td0 = document.createElement("td");
			var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";
				
			var td1 = document.createElement("td");
			var input1 = document.createElement("input")
				input1.className="struct";
				input1.style.width="100%";
				input1.style.height="60px";

			var td2 = document.createElement("td");
			var input2 = document.createElement("textarea")
				input2.className="struct";
				input2.style.width="100%";
				input2.style.height="60px";				
				
				td0.appendChild(checkbox);	
				td1.appendChild(input1);
				td2.appendChild(input2);
				
				tr.appendChild(td0);
				tr.appendChild(td1);
				tr.appendChild(td2);
				table.appendChild(tr);
		}
					
		
		// function to add row to the derivation table
		function addDerivation(){
				var table = document.getElementById("deriveTable"); 
				var tr = document.createElement("tr");
				var td0 = document.createElement("td");
				var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";
				
				var td1 = document.createElement("td");
				var input1 = document.createElement("input")
				input1.className="struct";
				input1.setAttribute('maxlength',"8");
				input1.value='';
				input1.style.width="100%";
				input1.style.height="40px";
				
				var td2 = document.createElement("td");
				var input2 = document.createElement("textarea")
				input2.className="struct";
				input2.style="width:100%;";
				
				td0.appendChild(checkbox);	
				td1.appendChild(input1);
				td2.appendChild(input2);

				tr.appendChild(td0);
				tr.appendChild(td1);
				tr.appendChild(td2);
				table.appendChild(tr);
		}
		
		// function to add row to the flag table
		function addFlag(){	
				var table = document.getElementById("flagTable"); 
				var tr = document.createElement("tr");
				var td0 = document.createElement("td");
				var checkbox = document.createElement('input');
				checkbox.type = "checkbox";
				checkbox.className="checkboxc";
				
				var td1 = document.createElement("td");
				var input1 = document.createElement("input")
				input1.className="struct";
				input1.setAttribute('maxlength',"8");
				input1.value=' ';
				input1.style.width="100%";
				input1.style.height="40px";
				
				var td2 = document.createElement("td");
				var input2 = document.createElement("textarea")
				input2.className="struct";
				input2.style.width="100%";

				var td3 = document.createElement("td");
				var input3 = document.createElement("textarea")
				input3.className="struct";
				input3.style.width="100%";

				var td4 = document.createElement("td");
				td4.style.display="none";
				var input4 = document.createElement("textarea");
				input4.className="struct";
				input4.value='0';
				
				td0.appendChild(checkbox);	
				td1.appendChild(input1);
				td2.appendChild(input2);
				td3.appendChild(input3);
				td4.appendChild(input4);
				
				tr.appendChild(td0);
				tr.appendChild(td1);
				tr.appendChild(td2);
				tr.appendChild(td3);
				tr.appendChild(td4);
				table.appendChild(tr);

				var rows = table.rows;
				var rowslength= rows.length;

				var parent = rows[rowslength-2].parentNode;

				parent.insertBefore(rows[rowslength-1], rows[rowslength-2]);
				
				var parent = rows[rowslength-1].parentNode;
				parent.insertBefore(rows[rowslength-1], rows[rowslength-2]);
		}		

		// function to add text to the descriptions
		function addText(nameid, displayid){
			var input = document.getElementById(nameid);
			document.getElementById(displayid).innerHTML = input.value;
		}

		// function to add confirmation document


		function addDoc(){
			var table = document.getElementById("confirmTable"); 
			var tr = document.createElement("tr");
			var td0 = document.createElement("td");
			var checkbox = document.createElement('input');
			checkbox.type = "checkbox";
			checkbox.className="checkboxc";

			var td1 = document.createElement("td");
			var input1 = document.createElement("input")
			input1.className="struct";
			input1.style.width="100%";
			input1.style.height="40px";
			
			var td2 = document.createElement("td");
			var input2 = document.createElement("input");
			input2.type= 'file';
			input2.name= 'fileToUpload[]';
			input2.id  = 'fileToUpload';
			input2.setAttribute('accept', '.pdf');
			input2.style.width="100%";
			input2.style.height="40px";
							
			td0.appendChild(checkbox);	
			td1.appendChild(input1);
			td2.appendChild(input2);
				
			tr.appendChild(td0);
			tr.appendChild(td1);
			tr.appendChild(td2);
			table.appendChild(tr);
		}

		// function to delete confirmation document
		function delDoc(){
			var arr=[];
			var table = document.getElementById("confirmTable"); 
			var inputElements = table.getElementsByClassName('checkboxc');
			var input = table.getElementsByClassName('struct');
			document.getElementById('confirmdisplay').innerHTML = 'You delete:';			
			for(var i=0; inputElements[i]; ++i){
				if(inputElements[i].checked){
					document.getElementById("confirmdisplay").innerHTML += input[i].value;
					document.getElementById("confirmdisplay").innerHTML += '  ';

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
		
		
		// section 2.5
		function getvalues() {
			var dsname = document.getElementById("dataset_name").value;
			var dslabel = document.getElementById("dataset_label").value;
			var dsrecords = document.getElementById("dataset_records").value;
			var dscriteria = document.getElementById("dataset_criteria").value;
			var dssort = document.getElementById("dataset_sort").value.toUpperCase() ;
			
			document.getElementById("td1").innerHTML = "This dataset will be named: " + dsname; 
			document.getElementById("td2").innerHTML = "This dataset label will be: " + dslabel; 
			document.getElementById("td3").innerHTML = "This dataset will contain " + dsrecords; 
			document.getElementById("td4").innerHTML = "The dataset will only contain records that meet the following criteria:  " + dscriteria; 
			document.getElementById("td8").innerHTML = "This dataset will be sorted by the following variables: " + dssort; 			
		}

		
		
		// signature function
		var canvas, ctx, flag = false,
			prevX = 0,
			currX = 0,
			prevY = 0,
			currY = 0,
			dot_flag = false;

		var x = "black",
			y = 2;
    
		function init() {
			canvas = document.getElementById('can');
			ctx = canvas.getContext("2d");
			w = canvas.width;
			h = canvas.height;
			canvas.addEventListener("mousemove", function (e) {
				findxy('move', e)
			}, false);
			canvas.addEventListener("mousedown", function (e) {
				findxy('down', e)
			}, false);
			canvas.addEventListener("mouseup", function (e) {
				findxy('up', e)
			}, false);
			canvas.addEventListener("mouseout", function (e) {
				findxy('out', e)
			}, false);
		}
    
		function draw() {
			ctx.beginPath();
			ctx.moveTo(prevX, prevY);
			ctx.lineTo(currX, currY);
			ctx.strokeStyle = x;
			ctx.lineWidth = y;
			ctx.stroke();
			ctx.closePath();
		}
		
		function erase() {
			var m = confirm("Want to clear");
			if (m) {
				ctx.clearRect(0, 0, w, h);
				document.getElementById("canvasimg").style.display = "none";
			}
		}
		
		function save() {
			var dataURL = canvas.toDataURL("image/png");
			document.getElementById("canvasimg").src = dataURL;
            document.getElementById('hidden_data').value = dataURL;
			document.getElementById("canvasimg").style.display = "inline";
		}
		
		function findxy(res, e) {
			if (res == 'down') {
				prevX = currX;
				prevY = currY;
				currX = e.clientX - canvas.offsetLeft;
				currY = e.clientY - canvas.offsetTop + window.scrollY;
				flag = true;
				dot_flag = true;
				if (dot_flag) {
					ctx.beginPath();
					ctx.fillStyle = x;
					ctx.fillRect(currX, currY, 2, 2);
					ctx.closePath();
					dot_flag = false;
				}
			}
			if (res == 'up' || res == "out") {
				flag = false;
			}
			if (res == 'move') {
				if (flag) {
					prevX = currX;
					prevY = currY;
					currX = e.clientX - canvas.offsetLeft;
					currY = e.clientY - canvas.offsetTop + window.scrollY;
					draw();
				}
			}
		}

		
		function sortTable(n, ascend) {
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("myTable");
			switching = true;
			//Set the sorting direction to ascending:
			dir = "asc"; 
			/*Make a loop that will continue until no switching has been done:*/
			while (switching) {
				//start by saying: no switching is done:
				switching = false;
				rows = table.rows;
				/*Loop through all table rows (except the first, which contains table headers):*/
				for (i = 1; i < (rows.length - 1); i++) {
					//start by saying there should be no switching:
					shouldSwitch = false;
					/*Get the two elements you want to compare, one from current row and one from the next:*/
					x = rows[i].getElementsByClassName("struct")[n];
					y = rows[i + 1].getElementsByClassName("struct")[n];
					/*check if the two rows should switch place, based on the direction, asc or desc:*/
					if (dir == "asc") {
						if (x.value.toLowerCase() > y.value.toLowerCase()) {
						//if so, mark as a switch and break the loop:
						shouldSwitch= true;
						break;
						}
					} else if (dir == "desc") {
						if (x.value.toLowerCase() < y.value.toLowerCase()) {
							//if so, mark as a switch and break the loop:
							shouldSwitch= true;
							break;
						}
			  		}
				}
				if (shouldSwitch) {
					/*If a switch has been marked, make the switch and mark that a switch has been done:*/
					rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
					switching = true;
					//Each time a switch is done, increase this count by 1:
					switchcount ++;      
				} else {
					/*If no switching has been done AND the direction is "asc",
					set the direction to "desc" and run the while loop again.*/
					if (switchcount == 0 && dir == "asc") {
						if (ascend == 0) {
							dir = "desc";	
							switching = true;
						} else if (ascend ==1) {
							dir = "asc";
							switching = false;
						}					
					}
				}
		  	}
		}


		function addvar(vararray) {
			//alert("welcome");
			// console.log('hikp');
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
				checkbox.style.width="22px";

			var td01 = document.createElement("td");
			var varnum = document.createElement("input");
				varnum.className="struct";
				varnum.value=pad(index, 3);
				varnum.style.width="58px";
				varnum.style.height="40px";
				varnum.readOnly = true;
				//alert("ok");
			var td02 = document.createElement("td");
				td02.style.display="none";
			var varflag1 = document.createElement("input");
				varflag1.className="struct";
				varflag1.value=vararray['requiredFlag'];
				//alert(varflag1.value=vararray[8]);
				
			var td03 = document.createElement("td");
				td03.style.display="none";
			var varflag2 = document.createElement("input");
				varflag2.className="struct";
				varflag2.value=vararray['nameChange'];
				
			var td04 = document.createElement("td");
				td04.style.display="none";
			var varflag3 = document.createElement("input");
				varflag3.className="struct";
				varflag3.value=vararray['labelChange'];
				
			var td05 = document.createElement("td");
				td05.style.display="none";
			var varflag4 = document.createElement("input");
				varflag4.className="struct";
				varflag4.value=vararray['unitChange'];
				
			var td06 = document.createElement("td");
				td06.style.display="none";
			var varflag5 = document.createElement("input");
				varflag5.className="struct";
				varflag5.value=vararray['typeChange'];
				
			var td07 = document.createElement("td");
				td07.style.display="none";
			var varflag6 = document.createElement("input");
				varflag6.className="struct";
				varflag6.value=vararray['roundChange'];
				
			var td08 = document.createElement("td");
				td08.style.display="none";
			var varflag7 = document.createElement("input");
				varflag7.className="struct";
				varflag7.value=vararray['missValChange'];
				
			var td09 = document.createElement("td");
				td09.style.display="none";
			var varflag8 = document.createElement("input");
				varflag8.className="struct";
				varflag8.value=vararray['noteChange'];
				
			var td010 = document.createElement("td");
				td010.style.display="none";
			var varflag9 = document.createElement("input");
				varflag9.className="struct";
				varflag9.value=vararray['sourceChange'];
				
			var td1 = document.createElement("td");
			var input1 = document.createElement("input");
				input1.className="struct";
				input1.setAttribute('maxlength',"8");
				input1.required = true;
				input1.value=vararray['var_name'];
				input1.style.width="98px";
				input1.style.height="33px";
				input1.style.textTransform="uppercase";
				if(varflag2.value=="0") {
					input1.readOnly = true;
				}
				
			var td2 = document.createElement("td");
			var input2 = document.createElement("input")
				input2.className="struct";
				input2.setAttribute('maxlength',"40");
				input2.required=true;
				input2.value=vararray['var_label'];
				input2.style.width="270px";
				input2.style.height="33px";
				if(varflag3.value=="0") {
					input2.readOnly = true;
				}
				
			var td3 = document.createElement("td");
			var input3 = document.createElement("input");
				input3.className="struct";
				input3.value=vararray['units'];
				input3.style.width="80px";
				input3.style.height="33px";
				if(varflag4.value=="0") {
					input3.readOnly = true;
				}

			var td4 = document.createElement("td");
			var selectlist = ["Num","Char"];

				//Create and append select list
			var selectbutton = document.createElement("select");
				selectbutton.className="struct";
				selectbutton.style.width="80px";
				//selectbutton.id="char_selectid"+index;
				//selectbutton.setAttribute("onchange","char_select()");
				//Create and append the options
				for (var i = 0; i < selectlist.length; i++) {
					var option = document.createElement("option");
						option.value = selectlist[i];
						option.text = selectlist[i];
						if (selectlist[i] == vararray['type']) {
							option.selected = true;
						}
						selectbutton.appendChild(option);
					}
				if(varflag5.value=="0") {
					selectbutton.readOnly = true;
				}

			var td5 = document.createElement("td");
				// var selectlist2 = ["NA"];
				var selectlist2 = ['NA', '0.1', '0.01', '0.001', '1', '3 significant digits', '4 significant digits'];

				//Create and append select list
				var selectbutton2 = document.createElement("select");
				selectbutton2.className="struct";
				selectbutton2.style.width="80px";
				selectbutton2.id="charfinal"+index;
				//Create and append the options
				for (var i = 0; i < selectlist2.length; i++) {
					var option = document.createElement("option");
						option.value = selectlist2[i];
						option.text = selectlist2[i];
						if (selectlist2[i] == vararray['round']) {
							option.selected = true;
						}
						selectbutton2.appendChild(option);
				}
				if(varflag6.value=="0") {
					selectbutton2.readOnly = true;
				}

				var td6 = document.createElement("td");
				var input6 = document.createElement("input");
				input6.className="struct";
				input6.id="defultvalue"+index;
				input6.style.width="80px";
				input6.style.height="40px";
				input6.value=vararray['missVal'];
				if(varflag7.value=="0") {
					input6.readOnly = true;
				}
			

			var td7 = document.createElement("td");
			var input7 = document.createElement("textarea");
				input7.className="struct";
				input7.style.width="247px";
				input7.value=vararray['note'];
				if(varflag8.value=="0") {
					input7.readOnly = true;
				}

			var td8 = document.createElement("td");
			var input8 = document.createElement("textarea");
				input8.className="struct";
				input8.style.width="247px";
				input8.value=vararray['source'];
				if(varflag9.value=="0") {
					input8.readOnly = true;
				}

			td0.appendChild(checkbox);				
			td01.appendChild(varnum);
			td02.appendChild(varflag1);		
			td03.appendChild(varflag2);	
			td04.appendChild(varflag3);	
			td05.appendChild(varflag4);	
			td06.appendChild(varflag5);	
			td07.appendChild(varflag6);	
			td08.appendChild(varflag7);	
			td09.appendChild(varflag8);	
			td010.appendChild(varflag9);					
			td1.appendChild(input1);
			td2.appendChild(input2);
			td3.appendChild(input3);
			td4.appendChild(selectbutton);
			td5.appendChild(selectbutton2);				
			td6.appendChild(input6);
			td7.appendChild(input7);				
			td8.appendChild(input8);
				
			tr.appendChild(td0);
			tr.appendChild(td01);
			tr.appendChild(td02);
			tr.appendChild(td03);
			tr.appendChild(td04);
			tr.appendChild(td05);
			tr.appendChild(td06);
			tr.appendChild(td07);
			tr.appendChild(td08);
			tr.appendChild(td09);
			tr.appendChild(td010);
			tr.appendChild(td1);
			tr.appendChild(td2);
			tr.appendChild(td3);
			tr.appendChild(td4);
			tr.appendChild(td5);
			tr.appendChild(td6);
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

		function addOptional() {
			// alert('hureee');
			// add endpoints
			// console.log('hiii');
			var inputElements = document.getElementsByName('endpoints[]');
			
			var len = inputElements.length;

			for(var i=0; i<len; i++){
      			if(inputElements[i].checked===true){
           			var newvar = inputElements[i].value;   
           			//alert(newvar);
           			if(newvar=='gr3') {
           				for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="gr3") {
           						addvar(optional[j]); 
           					}
           				}
           			}
           			else if (newvar=='aedcd') {
           				for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="aedcd") {
           						addvar(optional[j]); 
           					}
           				}
           			}
           			else if (newvar=='imae') {
           				for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="imae") {
           						addvar(optional[j]); 
           					}
           				}
           			}
	           		else if (newvar=='gr2imae') {
           				for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="imaegr2") {
           						addvar(optional[j]); 
           					}
           				}
	           		}
					else if (newvar=='drae') {
	           			for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="drae") {
           						addvar(optional[j]); 
           					}
           				}	           			
	           		}
	           		else if (newvar=='draedcd') {
           				for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="draedcd") {
           						addvar(optional[j]); 
           					}
           				}
	           		}
	           		else if (newvar=='drgr2ae') {
           				for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="drgr2") {
           						addvar(optional[j]); 
           					}
           				}
	           		}
	           		else if (newvar=='drgr3ae') {
	           			for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="drgr3") {
           						addvar(optional[j]); 
           					}
           				}
	           		}
	           		else if (newvar=='bor') {
	           			for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="bor") {
           						addvar(optional[j]); 
           					}
           				}
	           		}
	           		else if (newvar=='pfs') {
	           			for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="pfs") {
           						addvar(optional[j]); 
           					}
           				}
	           		}
	           		else if (newvar=='os') {
	           			for (var j=0; j<optional.length; j++) {
           					if(optional[j]['erflag']=="os") {
           						addvar(optional[j]); 
           					}
           				}
	           		} 
	           		//uncheck the box   
	           		inputElements[i].checked=false;   			
           		}
           	}
			
			//other optional variables
			var table2 = document.getElementById('allspecs');
			var inputElements2 = table2.getElementsByClassName('checkboxc');
			var input = table2.getElementsByClassName('varname');

			for(var i=0; inputElements2[i]; ++i){
				if(inputElements2[i].checked===true){
					var newvar2 = input[i].innerHTML;   
					for (var j=0; j<otheroptional.length; j++) {
						// console.log(otheroptional[j]);
           				if(otheroptional[j]['var_name']==newvar2) {
           					addvar(otheroptional[j]); 
           				}
           			}
				}
			}
			//delete the variables
			showdelete('allspectable');
		}

		// check compound name
		function cnameCheck() {
			var cname= document.getElementById("cname").value;
			var temp=document.getElementById("dstype").value;
		}

  function char_select1() {
  	 //var value = index.value;
  	var table = document.getElementById("myTable"); 
	var rownum = table.rows;
	var index = rownum.length-1;
  	
    var d = document.getElementById("char_selectid"+index).value;
    //alert(value);
    if(d == "Char"){
    	document.getElementById("charfinal"+index).setAttribute("disabled", "disabled");
    	document.getElementById("defultvalue"+index).setAttribute("disabled", "disabled");
    	document.getElementById("defultvalue"+index).value = " blank";
	}else {
		document.getElementById("charfinal"+index).removeAttribute("disabled");
		document.getElementById("defultvalue"+index).removeAttribute("disabled");
		document.getElementById("defultvalue"+index).value = ".";
	}

}