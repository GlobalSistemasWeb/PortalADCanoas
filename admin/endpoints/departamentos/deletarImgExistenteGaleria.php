<?php
	include("../connection.php");
	$data = json_decode(file_get_contents("php://input"));

	$q = "DELETE FROM galeria_departamentos WHERE id=:id";
	$query = $db->prepare($q);
	$execute = $query->execute(array(
		":id" => $data->id
	));

	echo "SUCCESS";
?>