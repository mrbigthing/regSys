<?php
/*
 * Refer to the following code to write your own callback methods
 */
$uploaddir = str_replace("\\", "/", dirname(__FILE__)).'/../uploaddir/';
$uploadfile = $uploaddir.time();
$editor = $_POST['editor'];//a global variable of the editor

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

echo '</pre>';

$image_type = array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 'image/x-png', 'image/bmp');

echo '<script>';
if(in_array($_FILES['userfile']['type'], $image_type)) {
	echo 'window.parent.'.$editor.'.insertContent("<img src=\'../../../uploaddir/'.basename($uploadfile).'\'>");';
} else {
	echo 'window.parent.'.$editor.'.insertContent("<a href=\'../../../uploaddir/'.basename($uploadfile).'\'></a>");';
}
echo 'window.parent.'.$editor.'.plugins.upload.finish();';
echo '</script>';
?>