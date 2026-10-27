<?php
$escape = static function ($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
};
?>
<article>
    <p><a href="<?php echo app_url('/games'); ?>">← Tất cả trò chơi</a></p>
    <h2><?php echo $escape($game['tieu_de']); ?></h2>
    <?php if (!empty($game['mo_ta_ngan'])): ?><p><?php echo $escape($game['mo_ta_ngan']); ?></p><?php endif; ?>
    <p>Giá: <?php echo $game['mo_hinh_gia'] === 'free' ? 'Miễn phí' : $escape(number_format((float)$game['gia_toi_thieu'], 2) . ' ' . $game['ma_tien_te']); ?></p>
    <?php if (!empty($_SESSION['user'])): ?>
        <form method="post" action="<?php echo app_url('/cart/add'); ?>">
            <input type="hidden" name="type" value="game">
            <input type="hidden" name="game_id" value="<?php echo (int)$game['ma']; ?>">
            <button class="button" type="submit">Thêm vào giỏ hàng</button>
        </form>
    <?php endif; ?>
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin:12px 0">
        <?php foreach ($categories as $category): ?><span class="card"><?php echo $escape($category['ten']); ?></span><?php endforeach; ?>
        <?php foreach ($platforms as $platform): ?><span class="card"><?php echo $escape($platform['ten_nen_tang']); ?></span><?php endforeach; ?>
    </div>
    <?php foreach ($media as $item): ?>
        <?php if (in_array($item['loai_media'], ['cover', 'thumbnail', 'screenshot'], true)): ?>
            <figure><img src="<?php echo $escape($item['url_media']); ?>" alt="<?php echo $escape($item['van_ban_thay_the'] ?? $game['tieu_de']); ?>" loading="lazy"></figure>
        <?php elseif ($item['loai_media'] === 'trailer' || $item['loai_media'] === 'external_link'): ?>
            <p><a href="<?php echo $escape($item['url_media']); ?>" rel="noopener noreferrer"><?php echo $escape($item['chu_thich'] ?: 'Liên kết ngoài'); ?></a></p>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (!empty($game['mo_ta'])): ?><section><h3>Giới thiệu</h3><div><?php echo nl2br($escape($game['mo_ta'])); ?></div></section><?php endif; ?>
    <section>
        <h3>Tác giả</h3>
        <?php if ($authors): ?>
            <ul><?php foreach ($authors as $author): ?>
                <li><a href="<?php echo app_url('/author/' . (int)$author['nguoi_dung_id']); ?>"><?php echo $escape($author['ten_hien_thi']); ?></a></li>
            <?php endforeach; ?></ul>
        <?php else: ?>
            <p><?php echo $escape($game['tieu_de']); ?></p>
        <?php endif; ?>
    </section>
    <section>
        <h3>Đánh giá (<?php echo (int)($rating['count'] ?? 0); ?>)</h3>
        <?php if ($rating['avg_rating'] !== null): ?><p>Điểm trung bình: <?php echo number_format((float)$rating['avg_rating'], 1); ?>/5</p><?php endif; ?>
        <?php foreach ($reviews as $review): ?>
            <article class="card" style="margin:10px 0">
                <strong><?php echo $escape($review['ten_hien_thi']); ?> — <?php echo (int)$review['diem_danh_gia']; ?>/5</strong>
                <?php if ($review['tieu_de']): ?><h4><?php echo $escape($review['tieu_de']); ?></h4><?php endif; ?>
                <p><?php echo nl2br($escape($review['noi_dung_danh_gia'] ?? '')); ?></p>
            </article>
        <?php endforeach; ?>
        <?php if (!empty($_SESSION['user']) && $game['cho_phep_danh_gia']): ?>
            <form method="post" action="<?php echo app_url('/api/games/' . (int)$game['ma'] . '/reviews'); ?>" class="card">
                <h4>Viết đánh giá</h4>
                <label for="rating">Điểm</label>
                <select id="rating" name="rating"><?php for ($score = 5; $score >= 1; $score--): ?><option value="<?php echo $score; ?>"><?php echo $score; ?>/5</option><?php endfor; ?></select>
                <label for="review-title">Tiêu đề</label><input id="review-title" name="title" maxlength="200">
                <label for="review-content">Nội dung</label><textarea id="review-content" name="content" rows="4" style="width:100%"></textarea>
                <button class="button" type="submit">Gửi đánh giá</button>
            </form>
        <?php endif; ?>
    </section>
    <?php if ($comments): ?>
        <section><h3>Bình luận</h3>
            <?php foreach ($comments as $comment): ?><article class="card" style="margin:10px 0"><strong><?php echo $escape($comment['ten_hien_thi']); ?></strong><p><?php echo nl2br($escape($comment['noi_dung'])); ?></p></article><?php endforeach; ?>
        </section>
    <?php endif; ?>
    <?php if ($devlogs): ?>
        <section><h3>Nhật ký phát triển</h3>
            <?php foreach ($devlogs as $post): ?><article class="card" style="margin:10px 0"><h4><?php echo $escape($post['tieu_de']); ?></h4><p><?php echo nl2br($escape($post['noi_dung'])); ?></p></article><?php endforeach; ?>
        </section>
    <?php endif; ?>
</article>
