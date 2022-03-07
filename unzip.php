<?php

$target_dir = "uploads/";

if (isset($_POST['submit'])) {

	$fileName = $_FILES["upload"]["name"];
	$fileType = $_FILES["upload"]["type"];
	$fileSize = $_FILES["upload"]["size"];
	$filePath = $_FILES["upload"]["tmp_name"];
	$trueTypes = ["x-rar-compressed","octet-stream","zip","x-zip-compressed","x-zip"];
	$trueSize = 1024*1024*1024*20; // = 5MB
	$newName = "";
	$unZippedFolder = "0";

	// Check File Size

	if($fileSize<=$trueSize)
	{
			if(strlen($fileType)>0 && in_array(explode("/",$fileType)[1],$trueTypes))
			{
				$newName = $target_dir . time() . random_int(100000,999999999) .substr($fileName,strrpos($fileName,'.'),strlen($fileName)); 
				$unZippedFolder = substr($newName,0,strrpos($newName,'.'));
				move_uploaded_file($filePath,$newName);
				unZipFile($newName,$unZippedFolder);
				deleteFile($newName);
				header("location:/RowadCodingAcademy/challeng2 php/view.php?folder=".$unZippedFolder);
		
			}else{
				
				echo "<script>
			alert('The File Type is not allowed  !!!!');
			</script>";
			}
	}else
	{
			echo "<script>
					alert('The File Size must be <= $trueSize  !!!!');
					location.href = '/RowadCodingAcademy/challeng2 php/';
					</script>";
	}
	
	
}
else
{
	echo "<script>
	alert('Upload file first !!!!');
	location.href = '/RowadCodingAcademy/challeng2 php/';
	</script>";
}


function unZipFile($file,$folder)
{
	$zip = new ZipArchive;

// Zip File Name
if ($zip->open($file) === TRUE) {

	// Unzip Path
	$zip->extractTo($folder);
	$zip->close();
	echo 'Unzipped Process Successful!';
} else {
	echo 'Unzipped Process failed';
}
}

function deleteFile($file_pointer)
{  
	if (!unlink($file_pointer)) { 
		echo ("$file_pointer cannot be deleted due to an error"); 
	} 
	else { 
		echo ("$file_pointer has been deleted"); 
	} 
}


?>