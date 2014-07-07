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

if(isset($_FILES['avartar']))
			{
				// Upload File
				require_once NV_ROOTDIR . '/includes/class/upload.class.php';
				
				$allow_files_type = array('images');//Các loại file được xác định tại file: includes\ini\mime.ini
				
				$_upload = new upload($allow_files_type, $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE);
				
				nv_mkdir(NV_ROOTDIR . '/uploads/', 'avarta');// Tạo 1  thư mục
				
				$upload_info = $_upload -> save_file($_FILES['uploadfile'], NV_ROOTDIR . '/uploads/avarta', false);
				if (!empty($upload_info['error'])) {
				    $error = $upload_info['error'];
				} else {
				    $filename = $upload_info['name'];
				}
								
			}
			

$contents = nv_theme_giasu_addregister( $array_data );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
