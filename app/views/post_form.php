<h2><?= isset($post) ? "Edit Post" : "Add Post" ?></h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="POST">
    <input type="text" name="title" placeholder="Title" value="<?= isset($post)?htmlspecialchars($post['title']):'' ?>" required>
    <textarea name="content" placeholder="Content" rows="5" required><?= isset($post)?htmlspecialchars($post['content']):'' ?></textarea>
    <button type="submit"><?= isset($post) ? "Update" : "Create" ?></button>
</form>
