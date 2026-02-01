<?php require 'header.php'; ?>

<?php if($section=='add'): ?>
    <?php require 'post_form.php'; ?>
<?php elseif($section=='my'): ?>
    <h2>My Posts</h2>
    <?php foreach($my_posts as $p): ?>
        <div class="post-card">
            <h3><?=htmlspecialchars($p['title'])?></h3>
            <p><?=nl2br(htmlspecialchars($p['content']))?></p>
            <small>Posted on <?= $p['created_at'] ?></small><br>
            <a href="edit_post.php?id=<?= $p['id'] ?>">Edit</a> | 
            <a href="delete_post.php?id=<?= $p['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h2>All Posts</h2>
    <?php foreach($all_posts as $p): ?>
        <div class="post-card">
            <h3><?=htmlspecialchars($p['title'])?></h3>
            <p><?=nl2br(htmlspecialchars($p['content']))?></p>
            <small>By <?= htmlspecialchars($p['author']) ?> on <?= $p['created_at'] ?></small>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require 'footer.php'; ?>
