
<?php
session_start();
$_SESSION['userFolder'] = "";
$path = $_SESSION['qPath'];
$mime_type=mime_content_type($path); 

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: " . $mime_type);
header("Content-Length: " .(string)(filesize($path)) );
header('Content-Disposition: attachment; filename="'.basename($path).'"');
header("Content-Transfer-Encoding: binary\\n");
 
readfile($path);

function custom_copy($src, $dst) {  
  
    // open the source directory 
    $dir = opendir($src);  
  
    // Make the destination directory if not exist 
    @mkdir($dst, 0777, true);  
  
    // Loop through the files in source directory 
    while( $file = readdir($dir) ) {  
  
        if (( $file != '.' ) && ( $file != '..' )) {  
            if ( is_dir($src . '/' . $file) )  
            {  
  
                // Recursively calling custom copy function 
                // for sub directory  
                custom_copy($src . '/' . $file, $dst . '/' . $file);  
  
            }  
            else {  
                copy($src . '/' . $file, $dst . '/' . $file);  
            }  
        }  
    }  
  
    closedir($dir); 
}  
  
$src = dirname($_SESSION['qPath']); 
  
$_SESSION['userFolder'] = 'C:\\userSolution\\' . $_SESSION['userDBid'] . '\\' .$_SESSION['userDBid'].'_'.$_SESSION['qID'];
  
custom_copy($src, $_SESSION['userFolder']); 


exit();
?>



