<?php
	include("../../connection.php");

	$texto_grande    = $_POST['textoGrande'];
	$texto_medio     = $_POST['textoMedio'];
	
	if(!empty($_FILES)){
		$pastaTemporaria = $_FILES['file']['tmp_name'];
		$pastaDestino    = "../../../../uploads_admin/" . $_FILES['file']['name'];
		$img             = "uploads_admin/" . $_FILES['file']['name'];
	}

	if(!isset($_POST['id'])){
		if(move_uploaded_file($pastaTemporaria, $pastaDestino)){
			$q = "INSERT INTO destaques (img, texto_grande, texto_medio) VALUES (:img, :texto_grande, :texto_medio)";
			$query = $db->prepare($q);
			$execute = $query->execute(array(
				":img" => $img,
				":texto_grande" => $texto_grande,
				":texto_medio" => $texto_medio
			));
			echo "SUCCESS";
		}else{
			echo "ERROR";
		}
	}else{
		$idEdit = $_POST['id'];

		if(empty($_FILES)){
			$q = "UPDATE destaques SET 
			texto_grande=:texto_grande,
			texto_medio=:texto_medio WHERE id=:id";
			$query = $db->prepare($q);
			$execute = $query->execute(array(
				":id" => $idEdit,
				":texto_grande" => $texto_grande,
				":texto_medio" => $texto_medio
			));
			echo "SUCCESS_EDIT";
		}else{
			if(move_uploaded_file($pastaTemporaria, $pastaDestino)){
				$q = "UPDATE destaques SET 
				img=:img, 
				texto_grande=:texto_grande,
				texto_medio=:texto_medio WHERE id=:id";
				$query = $db->prepare($q);
				$execute = $query->execute(array(
					":id" => $idEdit,
					":img" => $img,
					":texto_grande" => $texto_grande,
					":texto_medio" => $texto_medio
				));

				echo "SUCCESS_EDIT";
			}else{
				echo "ERROR_EDIT";
			}
		}
	}
?>