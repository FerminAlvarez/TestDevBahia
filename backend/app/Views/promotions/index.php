<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<a href="/promotions/new" class="btn btn-primary">Create Promotion</a>
<?php if (!empty($promo_list)) : ?>
    <?php foreach ($promo_list as $promo_item) : ?>
        <div class="promo-item">
            <h3 class="promo-title"><?= esc($promo_item['title']) ?></h3>
            <p class="promo-description"><?= esc($promo_item['description']) ?></p>
            <img src="<?= base_url('uploads/' . esc($promo_item['image_url'])) ?>" class="promo-image" alt="Promotion Image"/>
            <div class="buttons-container">
                <a href="/promotions/edit/<?= esc($promo_item['id']) ?>" class="btn btn-edit">Edit</a>
                <form action="/promotions/<?= esc($promo_item['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this promotion?');">
                    <input type="hidden" name="_method" value="DELETE" >
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h3>No Promotions</h3>
    <p>Unable to find any promotion for you.</p>
<?php endif; ?>
