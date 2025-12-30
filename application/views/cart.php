<h2>購物車</h2>
<?php if ($this->cart->total_items() > 0): ?>
<form action="<?= base_url('shop/update_cart') ?>" method="post">
    <table class="table">
        <thead>
            <tr>
                <th>商品</th>
                <th>價格</th>
                <th>數量</th>
                <th>小計</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->cart->contents() as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= number_format($item['price']) ?></td>
                <td>
                    <input type="number" name="cart[<?= $item['rowid'] ?>][qty]" value="<?= $item['qty'] ?>" min="0"
                        class="form-control w-50">
                    <input type="hidden" name="cart[<?= $item['rowid'] ?>][rowid]" value="<?= $item['rowid'] ?>">
                </td>
                <td><?= number_format($item['subtotal']) ?></td>
                <td><a href="<?= base_url('shop/update_cart?rowid='.$item['rowid'].'&qty=0') ?>"
                        class="btn btn-danger btn-sm">移除</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>總計</strong></td>
                <td colspan="2"><strong>NT$ <?= number_format($this->cart->total()) ?></strong></td>
            </tr>
        </tfoot>
    </table>
    <button type="submit" class="btn btn-warning">更新購物車</button>
    <a href="<?= base_url('shop/clear_cart') ?>" class="btn btn-danger">清空購物車</a>
    <a href="<?= base_url('shop/checkout') ?>" class="btn btn-success float-right">結帳</a>
</form>
<?php else: ?>
<p>購物車是空的！<a href="<?= base_url() ?>">繼續購物</a></p>
<?php endif; ?>