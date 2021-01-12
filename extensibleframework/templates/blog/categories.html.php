<?php
if (!empty($categories)) {
    foreach ($categories as $category) {
?>
        <h3><a href="#"><?=$category['name']?></a></h3>
<?php
    }
} else {
?>
    <p>Empty!</p>
<?php
}