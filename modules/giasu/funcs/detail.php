<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 10:31:33 GMT
 */

if ( ! defined( 'NV_IS_MOD_GIASU' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

//$id = $nv_Request->get_int('id','GET,POST');

//$array_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_dangky WHERE id='.$id)->fetch();

//print_r($array_data);die();

$contents = nv_theme_giasu_detail( $array_data );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
