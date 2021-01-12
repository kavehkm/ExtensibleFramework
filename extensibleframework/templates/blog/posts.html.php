<?php
if (!empty($posts)) {
    foreach ($posts as $post) {
?>
        <h4><a href="<?='/?route=post/get&id=' . $post['id']?>"><?=$post['title']?></a></h4>
        <span class="comment"><?=$post['category']?> | </span>
        <span class="comment"><?=$post['author']?></span>
        <p><?=substr($post['content'], 0, 40) . '...'?></p>
<?php
    }
} else {
?>
<p>Empty!</p>
<?php
}
