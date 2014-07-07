<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 10:31:33 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu['searchtutoring'] = $lang_module['searchtutoring'];
$submenu['registertutoring'] = $lang_module['registertutoring'];

$allow_func = array( 'main', 'searchtutoring', 'registertutoring');

define( 'NV_IS_FILE_ADMIN', true );

?>