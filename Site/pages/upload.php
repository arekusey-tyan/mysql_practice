<?php
require('../config/db.php');

if (!empty($_FILES['file']['tmp_name'])) {
    $file = $_FILES['file'];

    $name = $file['name'];
    $filepath = 'images/' . $name;

    move_uploaded_file($file['tmp_name'], "../$filepath");

    $query = $dbh->prepare(
        'INSERT INTO `pictures` (pic_name, size, imagepath)
                VALUE (:name, :size, :filepath);'
    );

    $query->execute([
        ':name' => $name,
        ':size' => $file['size'],
        ':filepath' => $filepath
    ]);
}
?>

<a href='/Site/pages/show.php'>Show image</a> |&nbsp;
<a href='/Site'>Home page</a> |
<a href="/Site/pages/showpictures.php">Show pictures</a>
<br />
<hr />

<form method='post' enctype="multipart/form-data">
    <input type='file' name='file' />
    <button>Submit</button>
</form>