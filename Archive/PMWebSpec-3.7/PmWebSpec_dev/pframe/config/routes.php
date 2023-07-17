<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller']                    = 'CIHome/index';
$route['home']                                  = 'CIHome/index';
$route['home/create/spec']                      = 'CIHome/Create/CreateSpec';
$route['home/create/new']                       = 'CIHome/Create/CreateSpec/New';
$route['home/create/save']                      = 'CIHome/Create/CreateSpec/Save';
$route['home/update/save']						= 'CIHome/Create/UpdateSpec/Update';
$route['home/create/flagcheck']                 = 'CIHome/Create/CreateSpec/CheckFlag';
$route['home/create/searchvariable']                 = 'CIHome/Create/CreateSpec/searchvariable';

$route['home/import/existing']                  = 'CIHome/Create/ImportExisting';
$route['home/import/existing/request']          = 'CIHome/Create/ImportExisting/Version';
$route['home/import/existing/copy']             = 'CIHome/Create/ImportExisting/CopyExist';

$route['home/import/existing/modify']           = 'CIHome/Create/Modify/Available';
$route['home/import/existing/revprove']         = 'CIHome/Create/ReviewApprove/SpecInspect';
$route['home/import/existing/drevprove']         = 'CIHome/Create/ReviewApprove/DSpecInspect';

$route['home/export/esub']                      = 'CISpecification/Process/ExportEsub/Esub';
$route['home/export/esubcsv']                   = 'CISpecification/Process/ExportEsub/ExportEsub';
$route['specification/view/pdf']                = 'CISpecification/Process/ViewPdf';

$route['home/download/spec']                    = 'CIHome/Create/Download';
$route['home/download/pdf']                     = 'CIHome/Create/Download/PdfFile';
$route['home/download/pdfreview']               = 'CIHome/Create/Download/Pdffilereview';
$route['home/download/csv']                     = 'CIHome/Create/Download/CsvFile';
$route['home/download/word']                     = 'CIHome/Create/Download/WordFile';

$route['download/csv-file']      				= 'CIHome/Create/Download/Downloadcsv';
//$route['download/word-file']      				= 'CIHome/Create/Download/Downloadword';
$route['home/download/doxc']					= 'CIHome/Create/Download/Downloaddoxc';

$route['download/esub-file']					= 'CIHome/Create/Download/Downloadesub';
$route['home/download/generate/sas']            = 'CIHome/Create/Download/GenerateSAS';
$route['home/download/review/spec']             = 'CIHome/Create/Download/ReviewSpec';
$route['home/download/modify/spec']             = 'CIHome/Create/Download/ModifySpec';

$route['admin/directory/setup']                 = 'CIAdmin/Access/DirectorySetup';
$route['admin/directory/setup/request']         = 'CIAdmin/Access/DirectorySetup/DirReq';
$route['admin/directory/setup/email']           = 'CIAdmin/Access/DirectorySetup/Email';

$route['admin/manage/users']                    = 'CIAdmin/Access/ManageUsers';
$route['admin/manage/view/add/user']            = 'CIAdmin/Access/ManageUsers/ViewAddUser';
$route['admin/manage/view/userdate']            = 'CIAdmin/Access/ManageUsers/UserDate';
$route['admin/manage/view/add/useradd']			= 'CIAdmin/Access/ManageUsers/Useradd';
//$route['admin/manage/view/add/userinformation']			= 'CIAdmin/Access/ManageUsers/userinformation';
$route['admin/manage/view/update/user']         = 'CIAdmin/Access/ManageUsers/ViewUpdateUser';
$route['admin/manage/view/add/user/update']		= 'CIAdmin/Access/ManageUsers/UserUpdate';
$route['admin/manage/view/remove/user']         = 'CIAdmin/Access/ManageUsers/ViewRemoveUser';
$route['admin/manage/view/remove/removevariable']     = 'CIAdmin/Access/ManageUsers/removevariable';
$route['admin/manage/view/remove/removeflag']     = 'CIAdmin/Access/ManageUsers/removeflag';
$route['admin/manage/view/remove/user_role']    = 'CIAdmin/Access/ManageUsers/removeuserandrole';
$route['admin/manage/view/remove/spec']         = 'CIAdmin/Access/ManageUsers/ViewRemoveSpec';
$route['admin/manage/view/unapprove/spec']      = 'CIAdmin/Access/ManageUsers/ViewUnapproveSpec';
$route['admin/manage/view/approve/spec']        = 'CIAdmin/Access/ManageUsers/ApproveSpec';
$route['signature']								= 'CIAdmin/Access/ManageUsers/getSignature';
$route['admin/manage/view/modify/template']     = 'CIAdmin/Access/ManageUsers/ViewModifyTemplate';
$route['admin/manage/role/add']     			= 'CIAdmin/Access/ManageUsers/roleManage';
$route['admin/manage/spec/remove']         		= 'CIAdmin/Access/ManageUsers/UpdateRemoveSpec';
$route['admin/manage/spec/unapprove']         	= 'CIAdmin/Access/ManageUsers/UpdateUnapproveSpec';

$route['admin/manage/add_formula']             	= 'CIAdmin/Access/ManageUsers/AddFormula';
$route['admin/manage/add_template']             = 'CIAdmin/Access/ManageUsers/AddTemplate';

$route['admin/manage/spec/addvariable']		  	= 'CITemplate/Access/ManageTeamplate/AddVariable';
$route['admin.manage/spec/updatevariable']      = 'CITemplate/Access/ManageTeamplate/UpdateVariable';
$route['admin/manage/spec/addflag']		  		= 'CITemplate/Access/ManageTeamplate/AddFlag';
$route['admin.manage/spec/updateflag']     		 = 'CITemplate/Access/ManageTeamplate/UpdateFlag';
	
$route['404_override']                          = 'CIAdmin';
$route['error/unauthorized']                    = 'CIHome/Create/Download/unauthorized';
$route['translate_uri_dashes']                  = FALSE;
$route['about']									='CIHome/Create/Download/About';
$route['popup']									='CIHome/Create/Download/Popup';
$route['help']									='CIHome/Create/Download/Help';
$route['logout']								='CIHome/Create/Download/Logout';


//user
//$route['home/getsessiontime']	= 'CIHome/getsessiontime';
$route['admin/getusers']        = 'CIAdmin/getusers';
$route['admin/getuserscount']   = 'CIAdmin/getuserscount';
$route['home/specapproval']	= 'CIHome/specapproval';
$route['home/specapprovalemail/(:any)/(:any)'] = 'CIHome/specapprovalemail/$1/$2';
$route['home/access']	= 'CIHome/access';
$route['admin/manage/update_formula']    = 'CIAdmin/update_formula';

$route['home/getsessiontime/(:any)']	= 'CIHome/getsessiontime/$1';
$route['home/lockspec/(:any)/(:any)'] = 'CIHome/lockspec/$1/$2';
$route['home/discardchange/(:any)'] = 'CIHome/discardchange/$1';
$route['home/discardchangemanage/(:any)'] = 'CIHome/discardchangemanage/$1';
$route['home/datasetsave']	= 'CIHome/datasetsave';

$route['home/create/getreports']                 = 'CIHome/Create/CreateSpec/getreports';
$route['home/getsearchvariableresult']	= 'CIHome/getsearchvariableresult';