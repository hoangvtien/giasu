<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 12:43:59 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if ( $nv_Request->isset_request( 'get_alias_title', 'post' ) )
{
	$alias = $nv_Request->get_title( 'get_alias_title', 'post', '' );
	$alias = change_alias( $alias );
	die( $alias );
}

if( $nv_Request->isset_request( 'ajax_action', 'post' ) )
{
	$id = $nv_Request->get_int( 'id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$content = 'NO_' . $id;
	if( $new_vid > 0 )
	{
		$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_giasu WHERE id!=' . $id . ' ORDER BY weight ASC';
		$result = $db->query( $sql );
		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight == $new_vid ) ++$weight;
			$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_giasu SET weight=' . $weight . ' WHERE id=' . $row['id'];
			$db->query( $sql );
		}
		$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_giasu SET weight=' . $new_vid . ' WHERE id=' . $id;
		$db->query( $sql );
		$content = 'OK_' . $id;
	}
	nv_del_moduleCache( $module_name );
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}
if ( $nv_Request->isset_request( 'delete_id', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ))
{
	$id = $nv_Request->get_int( 'delete_id', 'get' );
	$delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
	if( $id > 0 and $delete_checkss == md5( $id . NV_CACHE_PREFIX . $client_info['session_id'] ) )
	{
		$weight=0;
		$sql = 'SELECT weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_giasu WHERE id =' . $db->quote( $id );
		$result = $db->query( $sql );
		list( $weight) = $result->fetch( 3 );
		
		$db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_giasu  WHERE id = ' . $db->quote( $id ) );
		if( $weight > 0)
		{
			$sql = 'SELECT id, weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_giasu WHERE weight >' . $weight;
			$result = $db->query( $sql );
			while(list( $id, $weight) = $result->fetch( 3 ))
			{
				$weight--;
				$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_giasu SET weight=' . $weight . ' WHERE id=' . intval( $id ));
			}
		}
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['namestu'] = $nv_Request->get_title( 'namestu', 'post', '' );
	$row['alias'] = $nv_Request->get_title( 'alias', 'post', '' );
	$row['alias'] = ( empty($row['alias'] ))? change_alias( $row['title'] ) : change_alias( $row['alias'] );
	$row['numberstu'] = $nv_Request->get_int( 'numberstu', 'post', 0 );
	$row['teaching'] = $nv_Request->get_title( 'teaching', 'post', '' );
	$row['sessionnum'] = $nv_Request->get_int( 'sessionnum', 'post', 0 );
	$row['training'] = $nv_Request->get_title( 'training', 'post', '' );
	$row['email'] = $nv_Request->get_title( 'email', 'post', '' );
	$row['phonenumber'] = $nv_Request->get_title( 'phonenumber', 'post', '' );
	$row['requirements'] = $nv_Request->get_editor( 'requirements', '', NV_ALLOWED_HTML_TAGS );
	$row['address'] = $nv_Request->get_title( 'address', 'post', '' );
	$row['avartar'] = $nv_Request->get_title( 'avartar', 'post', '' );
	if( is_file( NV_DOCUMENT_ROOT . $row['avartar'] ) )
	{
		$row['avartar'] = substr( $row['avartar'], strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' ) );
	}
	else
	{
		$row['avartar'] = '';
	}

	if( empty( $row['namestu'] ) )
	{
		$error[] = $lang_module['error_required_namestu'];
	}
	elseif( empty( $row['teaching'] ) )
	{
		$error[] = $lang_module['error_required_teaching'];
	}
	elseif( empty( $row['training'] ) )
	{
		$error[] = $lang_module['error_required_training'];
	}
	elseif( empty( $row['email'] ) )
	{
		$error[] = $lang_module['error_required_email'];
	}
	elseif( empty( $row['phonenumber'] ) )
	{
		$error[] = $lang_module['error_required_phonenumber'];
	}
	elseif( ! empty( $row['email'] ) and ( $error_email = nv_check_valid_email( $row['email'] ) ) != '' )
	{
		$error[] = $error_email;
	}

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{

				$row['idclass'] = 0;

				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_giasu (idclass, namestu, alias, numberstu, teaching, sessionnum, training, email, phonenumber, requirements, address, weight, avartar) VALUES (:idclass, :namestu, :alias, :numberstu, :teaching, :sessionnum, :training, :email, :phonenumber, :requirements, :address, :weight, :avartar)' );

				$stmt->bindParam( ':idclass', $row['idclass'], PDO::PARAM_INT );
				$weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_giasu' )->fetchColumn();
				$weight = intval( $weight ) + 1;
				$stmt->bindParam( ':weight', $weight, PDO::PARAM_INT );


			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_giasu SET namestu = :namestu, alias = :alias, numberstu = :numberstu, teaching = :teaching, sessionnum = :sessionnum, training = :training, email = :email, phonenumber = :phonenumber, requirements = :requirements, address = :address, avartar = :avartar WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':namestu', $row['namestu'], PDO::PARAM_STR );
			$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
			$stmt->bindParam( ':numberstu', $row['numberstu'], PDO::PARAM_INT );
			$stmt->bindParam( ':teaching', $row['teaching'], PDO::PARAM_STR );
			$stmt->bindParam( ':sessionnum', $row['sessionnum'], PDO::PARAM_INT );
			$stmt->bindParam( ':training', $row['training'], PDO::PARAM_STR );
			$stmt->bindParam( ':email', $row['email'], PDO::PARAM_STR );
			$stmt->bindParam( ':phonenumber', $row['phonenumber'], PDO::PARAM_STR );
			$stmt->bindParam( ':requirements', $row['requirements'], PDO::PARAM_STR, strlen($row['requirements']) );
			$stmt->bindParam( ':address', $row['address'], PDO::PARAM_STR );
			$stmt->bindParam( ':avartar', $row['avartar'], PDO::PARAM_STR );

			$exc = $stmt->execute();
			if( $exc )
			{
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
				die();
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}
elseif( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_giasu WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}
else
{
	$row['id'] = 0;
	$row['namestu'] = '';
	$row['alias'] = '';
	$row['numberstu'] = 0;
	$row['teaching'] = '';
	$row['sessionnum'] = 0;
	$row['training'] = '';
	$row['email'] = '';
	$row['phonenumber'] = '';
	$row['requirements'] = '';
	$row['address'] = '';
	$row['avartar'] = '';
}
if( ! empty( $row['avartar'] ) and is_file( NV_UPLOADS_REAL_DIR . '/' . $module_name . '/' . $row['avartar'] ) )
{
	$row['avartar'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $row['avartar'];
}

if( defined( 'NV_EDITOR' ) ) require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
$row['requirements'] = htmlspecialchars( nv_editor_br2nl( $row['requirements'] ) );
if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$row['requirements'] = nv_aleditor( 'requirements', '100%', '300px', $row['requirements'] );
}
else
{
	$row['requirements'] = '<textarea style="width:100%;height:300px" name="requirements">' . $row['requirements'] . '</textarea>';
}


$q = $nv_Request->get_title( 'q', 'post,get' );

// Fetch Limit
$show_view = false;
if ( ! $nv_Request->isset_request( 'id', 'post,get' ) )
{
	$show_view = true;
	$per_page = 5;
	$page = $nv_Request->get_int( 'page', 'post,get', 1 );
	$db->sqlreset()
		->select( 'COUNT(*)' )
		->from( '' . NV_PREFIXLANG . '_' . $module_data . '_giasu' );

	if( ! empty( $q ) )
	{
		$db->where( 'namestu LIKE :q_namestu OR numberstu LIKE :q_numberstu OR teaching LIKE :q_teaching OR sessionnum LIKE :q_sessionnum OR training LIKE :q_training OR email LIKE :q_email OR phonenumber LIKE :q_phonenumber OR address LIKE :q_address' );
	}
	$sth = $db->prepare( $db->sql() );

	if( ! empty( $q ) )
	{
		$sth->bindValue( ':q_namestu', '%' . $q . '%' );
		$sth->bindValue( ':q_numberstu', '%' . $q . '%' );
		$sth->bindValue( ':q_teaching', '%' . $q . '%' );
		$sth->bindValue( ':q_sessionnum', '%' . $q . '%' );
		$sth->bindValue( ':q_training', '%' . $q . '%' );
		$sth->bindValue( ':q_email', '%' . $q . '%' );
		$sth->bindValue( ':q_phonenumber', '%' . $q . '%' );
		$sth->bindValue( ':q_address', '%' . $q . '%' );
	}
	$sth->execute();
	$num_items = $sth->fetchColumn();

	$db->select( '*' )
		->order( 'weight ASC' )
		->limit( $per_page )
		->offset( ( $page - 1 ) * $per_page );
	$sth = $db->prepare( $db->sql() );

	if( ! empty( $q ) )
	{
		$sth->bindValue( ':q_namestu', '%' . $q . '%' );
		$sth->bindValue( ':q_numberstu', '%' . $q . '%' );
		$sth->bindValue( ':q_teaching', '%' . $q . '%' );
		$sth->bindValue( ':q_sessionnum', '%' . $q . '%' );
		$sth->bindValue( ':q_training', '%' . $q . '%' );
		$sth->bindValue( ':q_email', '%' . $q . '%' );
		$sth->bindValue( ':q_phonenumber', '%' . $q . '%' );
		$sth->bindValue( ':q_address', '%' . $q . '%' );
	}
	$sth->execute();
}


$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'Q', $q );

if( $show_view )
{
	$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
	if( ! empty( $q ) )
	{
		$base_url .= '&q=' . $q;
	}
	$xtpl->assign( 'NV_GENERATE_PAGE', nv_generate_page( $base_url, $num_items, $per_page, $page) );

	while( $view = $sth->fetch() )
	{
		for( $i = 1; $i <= $num_items; ++$i )
		{
			$xtpl->assign( 'WEIGHT', array(
				'key' => $i,
				'title' => $i,
				'selected' => ( $i == $view['weight'] ) ? ' selected="selected"' : '') );
			$xtpl->parse( 'main.view.loop.weight_loop' );
		}
		$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
		$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5( $view['id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
		$xtpl->assign( 'VIEW', $view );
		$xtpl->parse( 'main.view.loop' );
	}
	$xtpl->parse( 'main.view' );
}


$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['searchtutoring'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';