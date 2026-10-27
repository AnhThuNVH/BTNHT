<section class="card">
    <h2>Không có quyền truy cập</h2>
    <p><?php echo htmlspecialchars($message ?? 'Bạn không có quyền truy cập trang này.', ENT_QUOTES, 'UTF-8'); ?></p>
    <p><a href="<?php echo app_url('/games'); ?>">Quay lại</a></p>
</section>
