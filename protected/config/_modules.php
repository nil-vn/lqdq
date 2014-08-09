<?php
//Nơi khai báo các modules được sử dụng trong hệ thống.
return array(
	// uncomment the following to enable the Gii tool
	'gii'=>array(
		'class'=>'system.gii.GiiModule',
		'password'=>'123456',
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
		'ipFilters'=>array('127.0.0.1','::1'),
		'generatorPaths' => array(
			'bootstrap.gii'
		),
		'generatorPaths'=>array(
			'ext.YiiMongoDbSuite.gii'
		),
	),
	'user'=>array(
		'tableUsers' => 'users',
		'tableProfiles' => 'profiles',
		'tableProfileFields' => 'profiles_fields',
		# encrypting method (php hash function)
		'hash' => 'md5',

		# send activation email
		'sendActivationMail' => true,

		# allow access for non-activated users
		'loginNotActiv' => false,

		# activate user on registration (only sendActivationMail = false)
		'activeAfterRegister' => false,

		# automatically login from registration
		'autoLogin' => true,

		# registration path
		'registrationUrl' => array('/user/registration'),

		# recovery password path
		'recoveryUrl' => array('/user/recovery'),

		# login form path
		'loginUrl' => array('/user/login'),

		# page after login
		'returnUrl' => array('/user/profile'),

		# page after logout
		'returnLogoutUrl' => array('/user/login'),
		'defaultController' => 'admin',
	),
	'rights'=>array(
		'superuserName'=>'Admin', // Name of the role with super user privileges. 
		'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
		'userIdColumn'=>'id', // Name of the user id column in the database. 
		'userNameColumn'=>'username',  // Name of the user name column in the database. 
		'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
		'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
		'displayDescription'=>true,  // Whether to use item description instead of name. 
		'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
		'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 

		'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
		'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
		'appLayout'=>'//layouts/rights', // Application layout. 
		'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
		'install'=>false,  // Whether to enable installer. 
		'debug'=>false, 
	)
);
/* End file _modules.php */
/* Location: aplication.protected.config._modules.php */