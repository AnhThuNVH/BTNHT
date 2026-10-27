<section class="card">
    <h2>Không tìm thấy</h2>
    <p><?php echo htmlspecialchars($message ?? 'Trang bạn yêu cầu không tồn tại.', ENT_QUOTES, 'UTF-8'); ?></p>
    <p><a href="<?php echo app_url('/games'); ?>">Quay lại danh sách trò chơi</a></p>
</section>
