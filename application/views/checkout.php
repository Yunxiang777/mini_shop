<h2>結帳</h2>
<table class="table">
    <thead>
        <tr>
            <th>商品</th>
            <th>數量</th>
            <th>小計</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->cart->contents() as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['qty'] ?></td>
                <td><?= number_format($item['subtotal']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><strong>總金額</strong></td>
            <td><strong>NT$ <?= number_format($this->cart->total()) ?></strong></td>
        </tr>
    </tfoot>
</table>

<?= form_open('shop/process_checkout') ?>
<div class="form-group">
    <label>姓名</label>
    <input type="text" name="name" class="form-control" required>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
</div>
<button type="submit" class="btn btn-success">確認結帳</button>
<a href="<?= base_url('shop') ?>" class="btn btn-secondary">返回購物</a>
<?= form_close() ?>