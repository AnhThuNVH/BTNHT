<?php $escape = static function ($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }; ?>
<section><h2>Cuộc thi làm game</h2>
    <?php if (!$jams): ?><p>Chưa có cuộc thi nào.</p><?php else: ?>
        <div class="grid"><?php foreach ($jams as $jam): ?><article class="card">
            <h3><a href="<?php echo app_url('/jams/' . rawurlencode($jam['duong_dan_rut_gon'])); ?>"><?php echo $escape($jam['tieu_de']); ?></a></h3>
            <p><?php echo $escape($jam['mo_ta'] ?? ''); ?></p>
            <small><?php echo $escape($jam['trang_thai']); ?> · Hạn nộp: <?php echo $escape($jam['han_nop_bai']); ?></small>
        </article><?php endforeach; ?></div>
    <?php endif; ?>
</section>
