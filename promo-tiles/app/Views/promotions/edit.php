<h2>Edit Promotion</h2>

<?php if (session()->has('errors')): ?>
    <div>
        <?php foreach (session('errors') as $error): ?>
            <?= esc($error) ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div>
        <?= session('error') ?>
    </div>
<?php endif; ?>

<form action="/promotions/update/<?= esc($promotion['id']) ?>" method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="<?= old('title', esc($promotion['title'])) ?>"><br><br>
    
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"><?= old('description', esc($promotion['description'])) ?></textarea><br><br>
    
    <label for="image">Image:</label><br>
    <input type="file" id="image" name="image"><br><br>
    
    <button type="submit">Update Promotion</button>
</form>
