<?php

return array(
    'class' => 'CLogRouter',
    'routes' => array(
        array(
            'class' => 'CFileLogRoute',
            'levels' => 'error, warning',
        ),
        array(
            'class' => 'ext.yii-slow-query-log.YiiSlowQueryLogRoute',
            'countLimit' => 100, // How many times the same query should be executed to be considered inefficient
            'slowQueryMin' => 0.5, // Minimum time for the query to be slow
            'enabled' => (defined('SLOW_QUERY_LOG') && SLOW_QUERY_LOG === true) ? true : false,
        ),
        array(
            'class'=>'CMailLogRoute',
            'levels'=>'error',
            'emails'=>(defined('SEND_ERRORS_TO_EMAILS')) ? SEND_ERRORS_TO_EMAILS : 'info@thegooddata.org',
            'subject'=>'Email Log File Message',
            'enabled' => (defined('SEND_ERRORS_BY_MAIL') && SEND_ERRORS_BY_MAIL === true) ? true : false,
        ),
    ),
);
