<?php $escape = static function ($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }; ?>
<section><h2>Diễn đàn</h2>
    <?php if (!$forums): ?><p>Chưa có diễn đàn nào.</p><?php else: ?>
        <div class="grid"><?php foreach ($forums as $forum): ?><article class="card">
            <h3><a href="<?php echo app_url('/forums/' . (int)$forum['ma']); ?>"><?php echo $escape($forum['tieu_de']); ?></a></h3>
            <p><?php echo $escape($forum['mo_ta'] ?? ''); ?></p>
        </article><?php endforeach; ?></div>
    <?php endif; ?>
</section>
