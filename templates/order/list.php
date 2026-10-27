<?php $escape = static function ($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }; ?>
<section><h2>Đơn hàng của tôi</h2>
    <?php if (!$orders): ?><p>Bạn chưa có đơn hàng.</p><?php else: ?>
        <table style="width:100%;border-collapse:collapse"><thead><tr><th>Mã đơn</th><th>Ngày đặt</th><th>Trạng thái</th><th>Tổng thanh toán</th></tr></thead><tbody>
        <?php foreach ($orders as $order): ?><tr><td><?php echo $escape($order['ma_don_hang']); ?></td><td><?php echo $escape($order['ngay_dat_hang']); ?></td><td><?php echo $escape($order['trang_thai']); ?></td><td><?php echo $escape($order['tong_thanh_toan']) . ' ' . $escape($order['ma_tien_te']); ?></td></tr><?php endforeach; ?>
        </tbody></table>
    <?php endif; ?>
</section>
