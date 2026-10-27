<?php $escape = static function ($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }; ?>
<section><p><a href="<?php echo app_url('/forums'); ?>">← Diễn đàn</a></p><h2><?php echo $escape($forum['tieu_de']); ?></h2>
    <?php if (!empty($forum['mo_ta'])): ?><p><?php echo $escape($forum['mo_ta']); ?></p><?php endif; ?>
    <?php if (!$topics): ?><p>Chưa có chủ đề thảo luận.</p><?php else: ?>
        <?php foreach ($topics as $topic): ?><article class="card" style="margin:10px 0">
            <h3><?php echo $escape($topic['tieu_de']); ?></h3>
            <p><?php echo nl2br($escape($topic['noi_dung_mo_dau'])); ?></p>
            <small><?php echo $escape($topic['ten_hien_thi']); ?> · <?php echo $escape($topic['ngay_tao']); ?></small>
        </article><?php endforeach; ?>
    <?php endif; ?>
</section>
