<?php
if (!empty($authors)) {
    foreach ($authors as $author) {
?>
        <h3><a href="#"><?=$author['fname'] . ' ' . $author['lname']?></a></h3>
        <p><?=$author['email']?></p>
<?php
    }
} else {
?>
    <p>Empty!</p>
<?php
}