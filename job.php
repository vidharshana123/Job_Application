<?php
if(isset($_POST['submit'])){
	//Get form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];
	$position = $_POST['position'];
	$experience = $_POST['experience'];
	$cover = $_POST['cover'];
	
	
	//validation for email
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
if (!preg_match($email_exp, $email)) {
	echo "The Email address you entered is not valid.";
	exit;
}
 
//Get uploaded file data using $_FILES array
$tmp_name = $_FILES['file']['tmp_name']; // get the temporary file name of the file on the server
$filename = $_FILES['file']['name']; // get the name of the file
$filesize = $_FILES['file']['size']; // get size of the file for size validation
$filetype = $_FILES['file']['type']; // get type of the file
$fileerror = $_FILES['file']['error']; // get the error (if any)
 
//validate form field for attaching the file
if($fileerror > 0)
{
	echo "Upload error or No files uploaded.";
	exit;
}
		 
// Upload attachment file
if(!empty($_FILES["file"]["name"])){
	 
	// File path config
	$targetDir = "uploads/";
	$fileName = basename($filename);
	$targetFilePath = $targetDir . $fileName;
	$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	 
	// Allow certain file formats
	$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
	if(in_array($fileType, $allowTypes)){
		// Check file size
		if ($filesize > 2000000) {
			echo "File size should be less than 2MB";
			exit;
		}else{
			// Upload file to the server
			if(move_uploaded_file($tmp_name, $targetFilePath)){
				$uploadedFile = $targetFilePath;
			}else{
				echo "Sorry, there was an error uploading your file.";
				exit;
			}
		}
	}else{
		echo "Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.";
		exit;
	}
}
?>