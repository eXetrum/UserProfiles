<?php
$config['acl'] = array('home' => array('public' => true, 'member' => true, 'admin' => true),
                       'members' => array('public' => false, 'member' => true, 'admin' => true),
                       'admin' => array('public' => false, 'member' => false, 'admin' => true),
                       'login' => array('public' => true, 'member' => true, 'admin' => true)
                      );
?>