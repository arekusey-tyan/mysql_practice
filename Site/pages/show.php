<?php

require ('../config/db.php');

$files = $dbh->query('SELECT * FROM `pictures`;')->fetchAll(PDO::FETCH_ASSOC);

?>
<a href='/Site/pages/upload.php'>Upload image</a> |&nbsp;<a href='/Site'>Home page</a>
<br>
<hr>
<form method='get'>
    <select name='pic_id'>
        <option disabled <?= (empty($_GET['pic_id'])) ? 'selected' : ''; ?>>Выберите изображение</option>
    <?php
    foreach ($files as $file) {
        ?>
        <option <?= (!empty($_GET['pic_id']) && $file['id'] == $_GET['pic_id']) ? 'selected' : ''; ?> value="<?= $file['id']; ?>"><?= $file['pic_name']; ?>
        <?php
    }
    ?>
    </select>
    <button type="submit">Submit</button>
</form>

<?php

if (!empty($_GET['pic_id'])) {
    $q = $dbh->prepare('SELECT imagepath, pic_name as name, size FROM `pictures` WHERE id = :id', [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $q->execute([':id' => $_GET['pic_id']]);
    $result = $q->fetch();
    ?>
    <figure>
        <img src="<?= '../' . $result['imagepath'] ?>" style="max-width: 800px;max-height: 500px;" />
        <figcaption>
            File name: <?= $result['name']; ?> | File size: <?= convert($result['size']); ?>
        </figcaption>
    </figure>
    
    <?php
}

function convert(int $size)
{
    if ($size < 1024) return $size . ' b';
    elseif ($size / 1024 < 1024) return round($size / 1024, 1) . ' kb';
    elseif ($size / (1024 * 1024) < 1024) return round($size / (1024 * 1024), 1) . ' mb';
    else return 're';
}