<?php //echo $hostname;
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
		echo "Please Login";
	die();
	}
}

?>
<div class="main center">
	<div class="title-head">
		<b><u>Application Details</u> : </b><br><br>
	<p>The PmWebSpec application is designed to simplify the creation and management of CDISC-compliant pharmacometric analysis dataset specifications. It offers a user-friendly interface with built-in templates aligned with the CDISC ADaM population pharmacokinetic implementation guide. With a versatile toolbox, it streamlines the entire project lifecycle, from initial setup to completion. Acting as a centralized repository, it allows for easy tracking, reusing, and referencing of dataset specifications. The application enhances efficiency by semi-automating the creation of PMx analysis datasets and specifications, while ensuring quality by implementing the latest standards and maintaining consistency across projects.
		<br>
 
<p>PMWebSpec is a web-based application developed using CodeIgniter based PHP Programming language (Version 8.0 and above). Frontend is developed in HTML5, CSS, JavaScript, Bootstrap and MySQL as database.  

<br><br>
<b><u>Application Copyright</u> : </b><br><br>
Pharmacometrics Web-based Specification (PMWebSpec) License<br><br>
Copyright © 2019-2023, Bristol-Myers Squibb Company<br><br>
Permission is hereby granted, royalty and payment free, to any person obtaining and/or copying this work, to redistribute and use in source and binary forms, with or without modification so long as you (the licensee) agree that you have read, understood, and will comply with the following terms and conditions.<br>
Redistributions of source code must retain the above copyright notice, this list of conditions and the below disclaimer.<br>
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the below disclaimer in the documentation and/or other materials provided with the distribution.<br>
Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.<br><br>
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.'<br><br>
 
The name and trademarks of copyright holders may NOT be used in advertising or publicity pertaining to this document or its contents without specific, written prior permission. Title to copyright in this document will at all times remain with copyright holders.


	
		<fieldset>
			<center>
				<h3 align="center"> <b>Version:</b> 3.9 </h3><br/>
				<h3 align="center"><b>Date:</b>  15th November 2023 </h3><br/>
				<h3 align="center"><b>Host:</b> <?php  echo $hostname .""." via TCP/IP "; ?></h3><br/>
				<h3 align="center"><b>S3 bucket:</b> <?php  echo s3_bucket_path; ?></h3><br/>
			</center>
		</fieldset>
	</div>
</div>