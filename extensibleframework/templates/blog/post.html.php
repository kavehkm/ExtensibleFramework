<?php
if (!empty($post)) {
?>
    <h2><?=$post['title']?></h2>
    <p>
        <span class="comment"><?=$post['category']?> | </span>
        <span class="comment"><?=$post['author']?></span>
    </p>
    <p><?=$post['content']?></p>
<?php
} else {
?>
    <p>Empty!</p>
<?php
}
