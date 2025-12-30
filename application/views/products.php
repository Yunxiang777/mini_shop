<h2>商品列表</h2>
<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php if ($product->image): ?>
                    <img src="<?= base_url('uploads/' . $product->image) ?>" class="card-img-top" alt="<?= $product->name ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $product->name ?></h5>
                    <p class="card-text"><?= $product->description ?></p>
                    <p class="card-text"><strong>NT$ <?= number_format($product->price) ?></strong></p>
                    <a href="<?= base_url('shop/add_to_cart/' . $product->id) ?>" class="btn btn-primary">加入購物車</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>