<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<form action="/promotions" method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <div class="container">
      <label for="name">Title</label>
      <input type="text" name="title" id="title" class="form-control">

      <label for="description">Description</label>
      <textarea name="description" id="description" class="form-control"></textarea>

      <label for="code">Image</label>
      <input type="file" name="image" id="image" class="form-control">
      
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
    <a href="/promotions" class="btn btn-danger">Cancel</a>
  </div>
</form>

