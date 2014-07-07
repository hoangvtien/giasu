<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 16 Jun 2014 10:31:33 GMT
 */

if( !defined( 'NV_IS_MOD_GIASU' ) )
	die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

if( $nv_Request->isset_request( 'namegs', 'post' ) )
{
	$filename = '';
	if( isset( $_FILES['avartar'] ) AND $_FILES['avartar']['filename'] != '' )
	{
		die( 'a' );
		// Upload File
		require_once NV_ROOTDIR . '/includes/class/upload.class.php';

		$allow_files_type = array( 'images' );
		//Các loại file được xác định tại file: includes\ini\mime.ini

		$_upload = new upload( $allow_files_type, $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE );

		nv_mkdir( NV_ROOTDIR . '/uploads/', 'avarta' );
		// Tạo 1  thư mục

		$upload_info = $_upload->save_file( $_FILES['avartar'], NV_ROOTDIR . '/uploads/avarta', false );
		if( !empty( $upload_info['error'] ) )
		{
			$error = $upload_info['error'];
		}
		else
		{
			$filename = $upload_info['name'];
		}
	}
	$row = array( );
	$row['namegs'] = $nv_Request->get_title( 'namegs', 'post', '' );
	$row['datebirth'] = $nv_Request->get_title( 'datebirth', 'post', '' );
	$row['workplace'] = $nv_Request->get_title( 'workplace', 'post', '' );
	$row['email'] = $nv_Request->get_title( 'email', 'post', '' );
	$row['subregister'] = $nv_Request->get_title( 'subregister', 'post', '' );
	$row['begindate'] = 0;
	$row['enddate'] = 0;
	$row['numsession'] = $nv_Request->get_int( 'numsession', 'post', 0 );
	$row['phonenumber'] = $nv_Request->get_title( 'phonenumber', 'post', '' );
	$row['avartar'] = $filename;
	$row['requirements'] = $nv_Request->get_string( 'requirements', 'post', '' );

	if( empty( $row['namegs'] ) )
	{
		$error[] = $lang_module['error_required_namegs'];
	}
	elseif( empty( $row['workplace'] ) )
	{
		$error[] = $lang_module['error_required_workplace'];
	}
	elseif( empty( $row['email'] ) )
	{
		$error[] = $lang_module['error_required_email'];
	}
	elseif( empty( $row['subregister'] ) )
	{
		$error[] = $lang_module['error_required_subregister'];
	}
	elseif( empty( $row['phonenumber'] ) )
	{
		$error[] = $lang_module['error_required_phonenumber'];
	}
	elseif( !empty( $row['email'] ) and ($error_email = nv_check_valid_email( $row['email'] )) != '' )
	{
		$error[] = $error_email;
	}

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{
				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_dangky (namegs, datebirth, workplace, email, subregister, begindate, enddate, numsession, phonenumber, weight, avartar,  requirements) VALUES (:namegs, :datebirth, :workplace, :email, :subregister, :begindate, :enddate, :numsession, :phonenumber, :weight, :avartar, :requirements)' );

				$weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_dangky' )->fetchColumn( );
				$weight = intval( $weight ) + 1;
				$stmt->bindParam( ':weight', $weight, PDO::PARAM_INT );

			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_dangky SET namegs = :namegs, datebirth = :datebirth, workplace = :workplace, email = :email, subregister = :subregister, begindate = :begindate, enddate = :enddate, numsession = :numsession, phonenumber = :phonenumber, avartar = :avartar, requirements = :requirements WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':namegs', $row['namegs'], PDO::PARAM_STR );
			$stmt->bindParam( ':datebirth', $row['datebirth'], PDO::PARAM_STR );
			$stmt->bindParam( ':workplace', $row['workplace'], PDO::PARAM_STR );
			$stmt->bindParam( ':email', $row['email'], PDO::PARAM_STR );
			$stmt->bindParam( ':subregister', $row['subregister'], PDO::PARAM_STR );
			$stmt->bindParam( ':begindate', $row['begindate'], PDO::PARAM_INT );
			$stmt->bindParam( ':enddate', $row['enddate'], PDO::PARAM_INT );
			$stmt->bindParam( ':numsession', $row['numsession'], PDO::PARAM_INT );
			$stmt->bindParam( ':phonenumber', $row['phonenumber'], PDO::PARAM_STR );
			$stmt->bindParam( ':avartar', $row['avartar'], PDO::PARAM_STR );
			$stmt->bindParam( ':requirements', $row['requirements'], PDO::PARAM_STR, strlen( $row['requirements'] ) );

			$exc = $stmt->execute( );
			if( $exc )
			{
				$contents = 'Cap nhat OK';
				include NV_ROOTDIR . '/includes/header.php';
				echo nv_site_theme( $contents );
				include NV_ROOTDIR . '/includes/footer.php';
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage( ) );
			die( $e->getMessage( ) );
			//Remove this line after checks finished
		}
	}
}

$contents = nv_theme_giasu_addregister( $array_data );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
