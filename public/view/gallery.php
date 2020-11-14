<?php
foreach ($images as $image) {
    echo '<img style="border:solid 1px;float:left; margin:10px;" src="/media/storage/' . $image['file'] . '">';
}
