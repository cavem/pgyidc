<?php
return array(
	'URL_HTML_SUFFIX'=>'html',
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则 
	    'index/:id\d/:name'    => 'Index/index',
	    // 'register/:regtype\d/:icode\d/:actime\d'    => 'Subpage/register',
        // 'plainreg/:icode\d/:actime\d'    => 'Subpage/register',
        'cloudbuy/:id\d/:cid\d'    => 'Index/cloudbuy',
	),
	'TMPL_PARSE_STRING' => array(
        '__ASSETS__' => __ROOT__.'/Application/'.MODULE_NAME.'/View/Public',
    ),
);