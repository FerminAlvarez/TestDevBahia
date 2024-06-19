<h2>Promotions</h2>

<?php if (!empty($promo_list)): ?>
    <?php foreach ($promo_list as $promo_item): ?>
        <div>
            <h3 class="promo-title"><?= esc($promo_item['title']) ?></h3>
            <p class="promo-description"><?= esc($promo_item['description']) ?></p>
            <img src="<?= base_url('uploads/' . esc($promo_item['image_url'])) ?>" class="promo-image" alt="Promotion Image"/>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h3>No Promotions</h3>
    <p>Unable to find any promotion for you.</p>
<?php endif; ?>
