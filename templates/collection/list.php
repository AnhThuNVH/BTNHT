<?php $escape = static function ($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }; ?>
<section><h2>Bộ sưu tập của tôi</h2>
    <?php if (!$collections): ?><p>Bạn chưa tạo bộ sưu tập nào.</p><?php else: ?>
        <div class="grid"><?php foreach ($collections as $collection): ?><article class="card">
            <h3><?php echo $escape($collection['tieu_de']); ?></h3>
            <p><?php echo $escape($collection['mo_ta'] ?? ''); ?></p>
            <small><?php echo $escape($collection['pham_vi_hien_thi']); ?></small>
        </article><?php endforeach; ?></div>
    <?php endif; ?>
</section>
