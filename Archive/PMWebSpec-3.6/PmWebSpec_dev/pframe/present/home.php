<?php
//phpinfo();exit;
$user_id_session =& get_instance();
$user_id_session->load->model('CIModSession');
$users_id = $user_id_session->CIModSession->checkIsSessionExist();

if($users_id == 0) {
	echo "Please Login";
	die();
}
$user_name = $this->session->user_details;
$url = base_url();
if ($user_name[0]['user_id'] == NULL) {
	if(!(strpos($url, 'localhost') != 0)){
		redirect(base_url('error/unauthorized'));
	}
}

$user_access = $this->session->user_access;
?>
            <div class="button-container" >
                    <div class="input-container">
                    	<form method="POST" action="<?php echo base_url('home'); ?>">
                            <div class="new-spec-inputs">
                                <div class="hovertip">
                                    <?php
									//print_r($user_access);
                                         if(in_array('CreateNew', $user_access['screen_name'])) {
                                    echo '<a class="button" href="'. base_url("home/create/spec") .'">Create New</a>';
                                         }
                                         else {
                                            //echo '<a class="button" href="'. base_url("home/access") .'">Create New</a>';
                                             echo '<input class="button" type="submit" name="selection" value="CreateNew" disabled /> ';
                                         }
                                    ?>
                                    <span class="hovertiptext">Create a new specification from scratch</span>
                                </div>
                                <div class="hovertip">
                                    <?php
                                         if(in_array('copyExist', $user_access['screen_name'])) {
                                           echo '<input class="button" type="submit" name="selection" value="Import Existing" />';
                                         } else {
                                             //echo '<a class="button" href="'. base_url("home/access") .'">Import Existing</a>';
                                             echo '<input class="button" type="submit" name="selection" value="Import Existing" disabled />';
                                         }
                                    ?>        
                                    <span class="hovertiptext">Copy an existing dataset specification and save as a new one </span>
                                </div>
                                <div class="hovertip">
                                    <?php
                                         if(in_array('Modify', $user_access['screen_name'])) {
                                           echo '<input class="button" type="submit" name="selection" value="Modify" />';
                                         } else {
                                             //echo '<a class="button" href="'. base_url("home/access") .'">Modify</a>';
                                             echo '<input class="button" type="submit" name="selection" value="Modify" disabled />';
                                         }
                                    ?>            
                                    <span class="hovertiptext">Modify an existing specification</span>
                                </div>
                                <div class="hovertip">
                                    <?php
                                         if(in_array('Approve', $user_access['screen_name'])) {
                                           echo '<input class="button" type="submit" name="selection" value="Review / Approve" />';
                                         } else {
                                             //echo '<a class="button" href="'. base_url("home/access") .'">Review / Approve</a>';
                                             echo '<input class="button" type="submit" name="selection" value="Review/Approve" disabled />';
                                        }
                                    ?>                                   
                                    <span class="hovertiptext">Review existing specification (HTML and PDF) and approve</span>
                                </div>
                            </div>
                        
                        <div class="other-inputs"> 
                            <div class="hovertip">
                            	<!-- <form method="POST" action="<?php // echo base_url('home/export/esub'); ?>">  -->
                                <?php
                                     if(in_array('Export', $user_access['screen_name'])) {
                                       echo '<input class="button" type="submit" name="selection" value="Export eSub" /> ';
                                     } else {
                                        //echo '<a class="button" href="'. base_url("home/access") .'">Export eSub</a>';
	                                    echo '<input class="button" type="submit" name="selection" value="Export eSub" disabled />';
                                     }
                                ?>                                       
                                <span class="hovertiptext">Editing and export eSub dataset specification in CSV format. Use it for eSub purpose only</span>
<!--                                 </form> -->
                            </div>
                            <div class="hovertip">  
                                <?php
                                     if(in_array('Directory', $user_access['screen_name'])) {
                                       echo '<a class="button" href="'.base_url("admin/directory/setup").'">Directory Setup</a>';
                                     } else {
                                        //echo '<a class="button" href="'. base_url("home/access") .'">Directory Setup</a>';
                                        echo '<input class="button" type="submit" name="selection" value="Directory Setup" disabled />';
                                     }
                                ?>                                       
                                <span class="hovertiptext">Request for analysis directory setup on Drive Path</span>
                            </div>
                            <div class="hovertip">    
                                <?php
                                     if(in_array('Download', $user_access['screen_name'])) {
                                       echo '<input class="button" type="submit" name="selection" value="DS Tools" />';
                                     } else {
                                        //echo '<a class="button" href="'. base_url("home/access") .'">Download</a>';
                                        echo '<input class="button" type="submit" name="selection" value="DS Tools" disabled />';
                                     }
                                ?>                 
                                <span class="hovertiptext">DS programmer only: download the specification to Drive server</span>
                            </div>
                            <div class="hovertip">
                                <?php
                                     if(in_array('manageUsers', $user_access['screen_name'])) {
                                       echo '<a class="button" href="'.base_url('admin/manage/users').'">Manage</a>';
                                     } else {
                                        //echo '<a class="button" href="'. base_url("home/access") .'">Manage</a>';
                                        echo '<input class="button" type="submit" name="selection" value="Manage" disabled /> ';
                                     }
                                ?>
                                <span class="hovertiptext">Administrator only: manage application users</span>
                            </div>
                        </div>
                    </div>
                </form>            
            </div>
        </div>
    </div>