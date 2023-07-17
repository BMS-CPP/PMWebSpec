###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 7.2 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

****************************
Installation For Deployment
****************************

Step 1:
 1. `Chnage the Database connection`
	a. Go to folder pframe.
	b. Go to config folder.
	c. Open database.php file.
    d. Change the
		'hostname' => '',
    	'username' => '',
    	'password' => '',               ---> `as required for both the databases`

 2. `Change the base URL`
	a. Go to folder pframe.
	b. Go to config folder.
    c. Open config.php file.
	d. Change the
		$config['base_url'] = [Current URL Which you want to use.]

 3. `Change the default value if required in config.php file.`
	a. Go to folder pframe.
	b. Go to config folder.
	c. Open config.php file.
	d. Change the
		$pkms_path = '';
		$pkms_path2 = '';
		$pdfspecpath = '';
		$exportcsvpath = '';
		$s3_bucket_path = '';


***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
