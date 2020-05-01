<?php

return array(
    
    'page-([0-9]+)' => 'site/index/$1',
    
    'ajax' => 'site/ajax',
    'ajax/page-([0-9]+)' => 'site/ajax',
    'sort/([a-zA-Z]+)' => 'site/sort/$1',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
    'change/update/([0-9]+)' => 'site/update/$1',
    'change/([0-9]+)' => 'site/change/$1',
    
    '' => 'site/index',
);

