<?php $escape = static function ($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }; ?>
<section><p><a href="<?php echo app_url('/jams'); ?>">← Cuộc thi</a></p><h2><?php echo $escape($jam['tieu_de']); ?></h2>
    <p><?php echo nl2br($escape($jam['mo_ta'] ?? '')); ?></p>
    <?php if (!empty($jam['the_le'])): ?><h3>Thể lệ</h3><p><?php echo nl2br($escape($jam['the_le'])); ?></p><?php endif; ?>
    <p>Thời gian: <?php echo $escape($jam['ngay_bat_dau']); ?> – <?php echo $escape($jam['han_nop_bai']); ?></p>
    <h3>Bài dự thi</h3>
    <?php if (!$entries): ?><p>Chưa có bài dự thi.</p><?php else: ?>
        <ul><?php foreach ($entries as $entry): ?><li><a href="<?php echo app_url('/games/' . rawurlencode($entry['duong_dan_rut_gon'])); ?>"><?php echo $escape($entry['tieu_de']); ?></a></li><?php endforeach; ?></ul>
    <?php endif; ?>
</section>
