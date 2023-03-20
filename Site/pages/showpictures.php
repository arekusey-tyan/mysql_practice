<?php
require('../config/db.php');

/* При загрузке страницы showpictures.php в ней должны отображаться все картинки из таблицы Pictures. Картинки должны
отображаться в виде миниатюр (в уменьшенном размере) с фиксированной высотой или шириной. Все миниатюры должны располагаться слева направо и перетекать на следующую строку при
заполнении ширины страницы (как во FlowLayout или WrapPanel).
Средствами AJAX сделать так, чтобы при клике по какой-либо
миниатюре на этой же странице отображались бы характеристики изображения: идентификатор, имя и размер.
*/

$result = getFiles();
$count = count($result);

?>

<style>
  .h-100 {
    height: 100px
  }

  .w-200 {
    width: 200px
  }

  .d-flex {
    display: flex
  }

  .select {
    border: 3px dotted red
  }
</style>

<script>
  function showInfo(id) {
    let e = event.currentTarget

    document.querySelectorAll('img.select').forEach(el => el.classList.remove('select'))

    fetch(`/Site/pages/showinfo.php?id=${id}`)
      .then(res => res.json())
      .then(data => {
        document.querySelector('.id span').innerHTML = data['id']
        document.querySelector('.name span').innerHTML = data['pic_name']
        document.querySelector('.size span').innerHTML = data['size']

        e.classList.add('select')
      })
  }
</script>

<a href='/Site/pages/show.php'>Show image</a> |&nbsp;
<a href='/Site'>Home page</a> |
<a href="/Site/pages/upload.php">Upload picture</a>
<br />
<hr />

<div class="">

  <span>Selected image info: </span><br>
  <div class="id">ID: <span></span></div>
  <div class="name">Name: <span></span></div>
  <div class="size">Size: <span></span></div>


</div>

<br />
<hr />


<div class="d-flex">

  <?php for ($i = 0; $i < $count; $i++) { ?>
    <div class="item img">

      <img src="../<?= urldecode($result[$i]['imagepath']); ?>" class="w-200 h-100" onclick="showInfo(<?= $result[$i]['id']; ?>)" />

    </div>
  <?php } ?>

</div>