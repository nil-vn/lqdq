<?php
/*Nơi khai báo xác lập url routing*/
return array(
	'login'=>'user/login',
	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
);

/* End file _routers.php */
/* Location: aplication.protected.config._routers.php */