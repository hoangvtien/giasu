<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 10:31:33 GMT
 */

if ( ! defined( 'NV_IS_MOD_GIASU' ) ) die( 'Stop!!!' );/**
 * nv_theme_giasu_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_giasu_main ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;
	//print_r($module_info);die();
    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );	
    foreach ($array_data as $row) {
    	$link = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $module_info['alias']['detail']. "/" . $row['alias'].'-'.$row['id'];
		$xtpl->assign( 'DATA1', $link );    	    		    	    	  
        $xtpl->assign( 'DATA', $row );
		$xtpl->parse( 'main.data' );
    }
	$xtpl->assign( 'URL_ADD',NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=register' );
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

/**
 * nv_theme_giasu_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_giasu_detail ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( 'detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

    //foreach ($array_data as $row) {
    	//$images = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_file . '/' . $row['avartar'];
		//$xtpl->parse( 'ROW',$images );    	    	    		    	    	 
        //$xtpl->assign( 'DATA', $row );
		//$xtpl->parse( 'main.loop' );
    //}

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}
 /**
 * nv_theme_giasu_addregister()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_giasu_addregister ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate('register.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

	
    
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

/**
 * nv_theme_giasu_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_giasu_search ( $array_data )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( 'LANG', $lang_module );

    

    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

