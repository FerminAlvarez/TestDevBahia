<h2><?= esc($title) ?></h2>

<?php if (session()->has('errors')): ?>
    <div>
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form action="/promotions" method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <div>
    <label for="name">Title</label>
    <input type="text" name="title" id="title" class="form-control">
  </div>
  <div>
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control"></textarea>
  </div>
  <div>
    <label for="code">Image</label>
    <input type="file" name="image" id="image" class="form-control">
  </div>
  <div>
    <button type="submit">Create</button>
  </div>
</form>

