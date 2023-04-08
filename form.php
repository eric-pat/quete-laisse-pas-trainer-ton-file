<?php
// Vérifier si le formulaire a été soumis
if(isset($_FILES['photo'])) {

	// Vérifier si le fichier a bien été uploadé
	if($_FILES['photo']['error'] == UPLOAD_ERR_OK) {

		// Vérifier la taille du fichier
		if($_FILES['photo']['size'] <= 1000000) {

			// Vérifier l'extension du fichier
			$allowed_extensions = array('jpg', 'png', 'gif', 'webp');
			$filename = $_FILES['photo']['name'];
			$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
			if(in_array($file_extension, $allowed_extensions)) {

				// Générer un nom de fichier unique
				$new_filename = uniqid('', true) . '.' . $file_extension;

				// Déplacer le fichier uploadé dans le dossier uploads/
				move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $new_filename);

				// Afficher l'image

				echo '<img src="uploads/' . $new_filename . '">';

			} else {
				echo 'L\'extension du fichier n\'est pas autorisée. Les extensions autorisées sont : ' . implode(', ', $allowed_extensions);
			}

		} else {
			echo 'Le fichier est trop volumineux (1Mo maximum).';
		}

	} else {
		echo 'Erreur lors de l\'upload du fichier : ' . $_FILES['photo']['error'];
	}

} else {
	echo 'Le formulaire n\'a pas été soumis.';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="imageUpload">Choisir une photo : </label>
    <input type="file" name="avatar" id="imageUpload" >
	<label for="firstname">Nom</label>
	<input type="text" name="firstname" id="firstname" required>
	<label for="lastname">Prénom</label>
	<input type="text" name="lastname" id="lastname" required>
	<label for="age">Age</label>
	<input type="number" name="age" id="age" required>
    <button name="send">Send</button>
</form>
</body>
</html>



