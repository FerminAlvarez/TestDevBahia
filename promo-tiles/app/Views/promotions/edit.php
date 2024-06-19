<h2>Edit Promotion</h2>

<?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger">
        <?php foreach (session('errors') as $error) : ?>
            <?= esc($error) ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (session()->has('error')) : ?>
    <div>
        <?= session('error') ?>
    </div>
<?php endif; ?>

<form action="/promotions/update/<?= esc($promotion['id']) ?>" method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <div class="container">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?= old('title', esc($promotion['title'])) ?>" required>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?=old('description', esc($promotion['description']))?></textarea>
    
    <label for="image">Image:</label>
    <input type="file" id="image" name="image" required>
    
    <button type="submit" class="btn btn-edit">Update Promotion</button>
    <a href="/promotions" class="btn btn-danger">Cancel</a>
</div>
</form>
