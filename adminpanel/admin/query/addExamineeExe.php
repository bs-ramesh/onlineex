<?php 
 include("../../../conn.php");


extract($_POST);

$selExamineeFullname = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_fullname='$fullname' ");
$selExamineeEmail = $conn->query("SELECT * FROM examinee_tbl WHERE usn='$email' ");


if($gender == "0")
{
	$res = array("res" => "noGender");
}
else if($course == "0")
{
	$res = array("res" => "noCourse");
}
else if($year_level == "0")
{
	$res = array("res" => "noLevel");
}
else if($selExamineeFullname->rowCount() > 0)
{
	$res = array("res" => "fullnameExist", "msg" => $fullname);
}
else if($selExamineeEmail->rowCount() > 0)
{
	$res = array("res" => "emailExist", "msg" => $email);
}
else
{   $encryptpassword = md5($_POST['password']);
	$insData = $conn->query("INSERT INTO examinee_tbl(exmne_fullname,branch_id,exmne_gender,exmne_birthdate,exmne_year_level,usn,exmne_password) VALUES('$fullname','$course','$gender','$bdate','$year_level','$email','$encryptpassword')  ");
	if($insData)
	{
		$res = array("res" => "success", "msg" => $email);
	}
	else
	{
		$res = array("res" => "failed");
	}
}


echo json_encode($res);
 ?>