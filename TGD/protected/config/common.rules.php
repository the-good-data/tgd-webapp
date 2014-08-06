<?php

return array(

	// REST patterns
	array('api/deleteQueries', 'pattern'=>'api/queries/delete/<user_id:[\w-]+>', 'verb'=>'GET'),
	array('api/deleteQueries', 'pattern'=>'api/queries/delete/<user_id:\d+>', 'verb'=>'GET'),

	array('api/count', 'pattern'=>'api/<model:\w+>/count', 'verb'=>'GET'),
	array('api/count', 'pattern'=>'api/<model:\w+>/count/<user_id:[\w-]+>', 'verb'=>'GET'),

	array('api/percentil', 'pattern'=>'api/<model:\w+>/percentile/<user_id:[\w-]+>', 'verb'=>'GET'),
	array('api/percentil', 'pattern'=>'api/<model:\w+>/percentile/<user_id:\d+>', 'verb'=>'GET'),

  array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
  array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
  array('api/view', 'pattern'=>'api/<model:\w+>/<query:[\w  \%\-]+>', 'verb'=>'GET'),
  array('api/view', 'pattern'=>'api/<model:\w+>/<lang:[\w  \%\-]+>/<query:[\w  \%\-]+>', 'verb'=>'GET'),
  
  array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
  array('api/update', 'pattern'=>'api/<model:\w+>/<user_id:[\w-]+>/', 'verb'=>'PUT'),
  array('api/update', 'pattern'=>'api/<model:\w+>/<user_id:[\w-]+>/<member_id:\d*>', 'verb'=>'PUT'),

  array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
  array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
      
  // Set friendly-urls
  '/' => 'site/index',
  '/good-data' => 'goodData/index',
  'apply'=>'/user/registration',
  //'share/thanks'=>'/purchase/thanks', // think this is old and should be removed
  'sign-in'=>'/user/login',
  'recover'=>'/user/recovery',
  'good-data'=>'/goodData/index',
  'evil-data'=>'/evilData/index',
  'user-data'=>'/userData/index',
  'membership'=>'/user/profile',
  'product'=>'/site/product',
  'partners'=>'/site/partners',
  'your-company'=>'/site/company',
  'support-us'=>'/donate',
  'support-us/thanks'=>'/donate/thanks',
  'coders'=>'/site/coders',
  'faq'=>'/site/faq',
  'legal'=>'/site/legal',	
  'get-your-share'=>'/purchase/index',
  'not-applicable'=>'/purchase/notApplicable',
  'robots.txt'=>'/site/robots',

	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

);