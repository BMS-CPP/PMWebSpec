
	<style>
		* {box-sizing: border-box}
		body {font-family: Avenir, Helvetica, sans-serif; }

		/* Style the tab */
		.tab {
			float: left;
			border: 1px solid #ccc;
			width: 100%;
			height: auto;
			background-color: #000000;
		}

		/* Style the buttons inside the tab */
		.tab button {
			display: block;
			background-color: inherit;
			padding: 22px 16px;
			width: 20%!important;
			border: none;
			outline: none;
			text-align: left;
			cursor: pointer;
			transition: 0.3s;
			font-size: 17px;
			color: white;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: #ddd;
			color: #3498DB;
		}

		/* Create an active/current "tab button" class */
		.tab button.active {
			background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
			float: left;
			padding: 0px 12px;
			border: 1px solid #ccc;
			width: 70%;
			border: none;
			height: auto;
		}

		video {
			border: 2px solid grey;
			box-shadow: 3px 3px 3px grey;
		}
		div.tab button {
			color: #941919;
			border: 1px solid #ccc;
		}
	</style>

<br/>
	<div class="container-fluid">
	<div class="tab">
		<button class="tablinks" onclick="openTab(event, 'New')" id="defaultOpen">Create a new spec</button>
		<button class="tablinks" onclick="openTab(event, 'Import')">Import a spec</button>
		<button class="tablinks" onclick="openTab(event, 'Modify')">Modify a spec</button>
		<button class="tablinks" onclick="openTab(event, 'Review')">Review and approve a spec</button>
		<button class="tablinks" onclick="openTab(event, 'Export')">Export esub spec</button>
	</div>
	<br/>
	<div id="New" class="tabcontent">
		<h2>Create a new spec</h2>
		<p><i>This feature is to create a new spec using a template</i></p>
		<p><strong>Step 1. Select a template to start.</strong></p>
		<p>-Templates include standard data structures for different compounds and studys.</p>
		<p>-Click the drop down menu to select the right template for your study.</p>
		<p>-If you couldn't find a template you want, you can select 'Blank template' option to create your own from scratch.</p>
		<center><img src="assets/imgs/help/01_01.png" width="1200" height="300" border="2"></center>
		<br />
		<p><strong>Step 2. Fill out Specification information and general information.</strong></p>
		<p>-Make sure you have all required(*) fields filled up.</p>
		<center><img src="assets/imgs/help/02_02_new.png?random" width="1200" height="400" border="2"></center>
		<br />
		<p><strong>Step 3. Modify dataset structure.</strong></p>
		<p>-Required variables will appear in the dataset structure table when the template is loaded.</p>
		<p>-Optional variables will appear in the optional variable table. You can select variables to add to the dataset structure table.</p>
		<p>-Fields without borders cannot be changed.</p>
		<p>-Variables can be moved up or down. If variables you need are not in the optional table, you can add by clicking the &lsquo;Add new variable&rsquo; button. If variables are not needed, you can remove them by clicking the &lsquo;Delete selected variables&rsquo; button. <b>Required variables cannot be removed</b>.</p>
		<p>-Maximum length for variable name is 8 characters, and for variable label is 40 characters. Variable name must start with letters or underscore.</p>
		<p>-Variable order can be sorted by variable name or variable number.</p>
		<center><p>Dataset structure table</p><img src="assets/imgs/help/03_03.png?random" width="1200" height="500" border="2"></center>
		<center><p>Variable actions</p><img src="assets/imgs/help/04.png?random" width="1000" height="200" border="2"></center>
		<center><p>Optional variable table</p><img src="assets/imgs/help/05_05.png?random" width="1000" height="500" border="2"></center>
		<br />
		<p><strong>Step 4. Modify derivations.</strong></p>
		<p>-Default algorithms are not editable.</p>
		<p>-Default exclusion flag number and comments are not editable.</p>
		<p>-Use Check all existing flags button to check all flags in the database.</p>
		<center><p>Variable actions</p><img src="assets/imgs/help/06_06.png?random" width="1000" height="500" border="2"></center>
		<center><p>Variable actions</p><img src="assets/imgs/help/07_07.png?random" width="1000" height="500" border="2"></center>
		<br />
		<p><strong>Step 5. Click Submit to save and upload specification information to the database.</strong></p>
	</div>

	<div id="Import" class="tabcontent">
		<h2>Import a spec</h2>
		<p><i>This feature is to import an existing spec as a template to create a new spec for future use.</i></p>
		<p><i><font color="red">Important note: Be careful when importing an existing spec with fixed variable which will not be editable after importing. Please use 'Import from existing' function only for the same type of template used for the imported spec, e.g. import existing spec with same compound number and different protocol number.</font></i></p>
		<p><strong>Step 1. Use filter to search for the existing specification you want to import.</strong></p>
		<p>-Select a specification ID and click Next to continue.</p>
		<center><img src="assets/imgs/help/08_08.png?random" width="1300" height="500" border="2"></center>
		<p>-Select a version ID and click Next to continue.</p>
		<center><img src="assets/imgs/help/09_09.png?random" width="1000" height="250" border="2"></center>
		<br />
		<p><strong>Step 2. Revise and modify specification information.</strong></p>
		<p>-Fill in the fields in general information. When importing from existing specification, all fields in the general information section are cleared up. </p>
		<p>-Update other information if necessary. The instruction is the same as creating a new specfication.</p>
		<br />
		<p><strong>Step 3. Click Submit to save and upload a new specification to the database.</strong></p>
	</div>

	<div id="Modify" class="tabcontent">
		<h2>Modify a spec</h2>
		<p><i>This feature is to modify an existing unapproved spec. Approved spec cannot be modified.</i></p>
		<p><strong>Step 1. Use filter to search for the existing specification you want to modify.</strong></p>
		<p>-Following instruction is the same as importing a spec.</p>
		<p>-Select a specification ID and click Next to continue. </p>
		<p>-Select a version ID and click Next to continue.</p>
		<br />
		<p><strong>Step 2. Update specification information.</strong></p>
		<p>-&lsquo;Changes made&rsquo; and &lsquo;Revised by&rsquo; are required to store modification history information in order to track the changes.</p>
		<br />
		<p><strong>Step 3. Click Submit to save and upload modified specification information to the database.</strong></p>
	</div>

	<div id="Review" class="tabcontent">
		<h2>Review and approve a spec</h2>
		<p><i>This feature is to review the specification in a webpage or as a PDF file. When the specification is finalized, sign at the bottom to approve a spec.</i></p>
		<p><strong>Step 1. Use filter to search for the existing specification you want to review.</strong></p>
		<p>-Following instruction is the same as importing a spec.</p>
		<p>-Select a specification ID and click Next to continue.</p>
		<p>-Select a version ID and click Next to continue.</p>
		<br />
		<p><strong>Step 2. Review the specification.</strong></p>
		<p>-You can review the specification in the webpage or click the View as PDF button to review as a PDF file.</p>
		<p>-The pdf file will also pop up in another window in which you can scroll down and review.</p>
		<center><img src="assets/imgs/help/10_10.png?random" width="1000" height="300" border="2"></center>
		<p><strong>Step 3. Approve the specification.</strong></p>
		<p>-When the dataset is created and no more changes will be made, pharmacometrician will approve the specfication. Use the mouse to sign in the box, then click Approve to save the change to the database. </p>
		<center><img src="assets/imgs/help/11.png?random" width="1000" height="300" border="2"></center>
	</div>

	<div id="Export" class="tabcontent">
		<h2>Export esub spec to csv file</h2>
		<p><i>This feature is to export an esub spec to a csv file. This function is used when the dataset will be submitted to health authorities. </i></p>
		<p><strong>Step 1. Use filter to search for the approved spec you want to output to a esub spec.</strong></p>
		<p>-Following instruction is the same as importing a spec.</p>
		<p>-Select a specification ID and click Next to continue.</p>
		<p>-Select a version ID and click Next to continue.</p>
		<br />
		<p><strong>Step 2. Modify the content if needed, just like editing the dataset structure section.</strong></p>
		<p>-All the cells are editable and can be moved up or down.</p>
		<p>-You can also add another input or delete any existing one.</p>
		<br />
		<p><strong>Step 3. Click Export. The csv file will be downloaded to Drive Path directly and the location will be specified after the button is clicked.</strong></p>
	</div>

</div>


<script>
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
	document.getElementById("defaultOpen").click();
</script>

</body>
</html>
