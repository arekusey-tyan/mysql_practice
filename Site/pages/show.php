<?php
require('../config/db.php');
require('../utils/functions.php');

$files = getFiles()

?>

<a href='/Site/pages/upload.php'>Upload image</a> |&nbsp;<a href='/Site'>Home page</a> | <a href="/Site/pages/showpictures.php">Show pictures</a>

<br />
<hr />

<form>
    <select name='pic_id'>
        <option disabled <?= (empty($_GET['pic_id'])) ? 'selected' : false; ?>>
            Выберите изображение
        </option>

        <?php foreach ($files as $file) { ?>
            <option value="<?= $file['id']; ?>" <?= (!empty($_GET['pic_id']) && $file['id'] == $_GET['pic_id']) ? 'selected' : ''; ?>>
                <?= $file['pic_name']; ?>
            </option>
        <?php } ?>
    </select>
    <button type="submit">Submit</button>
</form>

<?php

if (!empty($_GET['pic_id'])) {
    $query = $dbh
        ->prepare(
            'SELECT imagepath, pic_name as name, size FROM `pictures` WHERE id = :id'
        );
    $query->execute([':id' => $_GET['pic_id']]);
    $result = $query->fetch();
?>
    <figure>
        <img src="<?= '../' . $result['imagepath'] ?>" style="max-width: 800px; max-height: 500px;" />
        <figcaption>
            File name: <?= $result['name']; ?> | File size: <?= convert($result['size']); ?>
        </figcaption>
    </figure>

<?php } ?>

<?php
