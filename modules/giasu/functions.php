<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 10:31:33 GMT
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_GIASU', true );
//print_r($array_op);die();
/*$sql = $db -> query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_dangky ORDER BY weight ASC');

$array_gs = nv_db_cache($sql,'alias',$module_name);

if(!emty($array_op))
{
	if(preg_match('/\-([0-9]+)$/', $array_op[0], $m))
	{
		$array_giasu = $db -> query("SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_dangky WHERE id=". intval($m));
		if(!empty($array_giasu))
		{
			if($array_giasu['alias'].'-'.$array_giasu['id']== $array_op[0])
			{
				$op = 'detail';
			}
			else {
				die('error');
			}
		}
	}
}*/
