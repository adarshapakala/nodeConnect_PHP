<?php
session_start();


$target_dir = $_SESSION['userFolder'];
echo "the file filder:".$_SESSION['userFolder'];
$target_file = $target_dir . "\\".basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submittSolution"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "vi") {
  echo "Sorry, only <b>.vi</b> files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    //echo $target_file;

    // run unit test command on the uploaded file
    $_SESSION['reportpath']=$target_dir.'\\'.$_SESSION['qID'].'.html';
    $unitTestModule=$target_dir.'\\'.$_SESSION['qID'].'.lvtest';
    $command = 'LabVIEWCLI -OperationName RunVI -VIPath "C:\unitTestExecuter\unitTestExecutor.vi" -PortNumber 3366'.' "'.$_SESSION['reportpath'].'" "'.$unitTestModule.'"';
    

    $cliOut= exec($command);
    

	header('location: ..\userBoard\displayResult.php');


  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

