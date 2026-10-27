<section class="card" style="max-width:720px;margin:auto">
    <h2>Đăng trò chơi</h2>
    <p>Thông tin trò chơi, giá và ảnh bìa sẽ được lưu khi đăng.</p>
    <?php if (!empty($error)): ?>
        <p class="notice"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo app_url('/games'); ?>" enctype="multipart/form-data">
        <label for="title">Tiêu đề</label>
        <input id="title" name="tieu_de" maxlength="200" required style="width:100%">
        <label for="slug">Slug URL (chữ Latin, số và dấu gạch ngang)</label>
        <input id="slug" name="duong_dan_rut_gon" maxlength="220" pattern="[A-Za-z0-9]+(-[A-Za-z0-9]+)*" required style="width:100%">
        <label for="short-description">Mô tả ngắn</label>
        <input id="short-description" name="mo_ta_ngan" maxlength="500" style="width:100%">
        <label for="description">Giới thiệu</label>
        <textarea id="description" name="mo_ta" rows="8" style="width:100%"></textarea>
        <label for="cover-image">Ảnh bìa</label>
        <input id="cover-image" name="cover_image" type="file" accept="image/jpeg,image/png,image/webp,image/gif" aria-describedby="cover-image-hint" style="width:100%">
        <p id="cover-image-hint" class="price-hint">JPG, PNG, WebP hoặc GIF; tối đa 5 MB.</p>
        <img id="cover-preview" class="cover-preview" alt="Xem trước ảnh bìa" hidden>
        <fieldset class="pricing-fields">
            <legend>Giá trò chơi</legend>
            <label for="pricing-model">Mô hình giá</label>
            <select id="pricing-model" name="mo_hinh_gia" required style="width:100%">
                <option value="free">Miễn phí</option>
                <option value="paid">Có giá cố định</option>
                <option value="pay_what_you_want">Trả tùy tâm</option>
                <option value="donation">Ủng hộ nhà phát triển</option>
            </select>
            <label for="minimum-price">Giá tối thiểu</label>
            <div class="price-input">
                <input id="minimum-price" name="gia_toi_thieu" type="number" min="0" max="9999999999.99" step="0.01" value="0" inputmode="decimal" style="width:100%">
                <span>USD</span>
            </div>
            <p id="price-hint" class="price-hint">Trò chơi miễn phí sẽ có giá tối thiểu bằng 0.</p>
        </fieldset>
        <label for="categories">Thể loại (có thể chọn nhiều)</label>
        <select id="categories" name="categories[]" multiple style="width:100%;min-height:120px">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo (int)$category['ma']; ?>"><?php echo htmlspecialchars($category['ten'], ENT_QUOTES, 'UTF-8'); ?></option>
            <?php endforeach; ?>
        </select>
        <label for="platforms">Nền tảng (có thể chọn nhiều)</label>
        <select id="platforms" name="platforms[]" multiple style="width:100%;min-height:120px">
            <?php foreach ($platforms as $platform): ?>
                <option value="<?php echo (int)$platform['ma']; ?>"><?php echo htmlspecialchars($platform['ten_nen_tang'], ENT_QUOTES, 'UTF-8'); ?></option>
            <?php endforeach; ?>
        </select>
        <p style="margin-top:16px"><button class="button" type="submit">Đăng trò chơi</button></p>
    </form>
</section>
<style>
    .pricing-fields { margin: 20px 0 8px; padding: 18px; border: 1px solid var(--line); border-radius: 16px; }
    .pricing-fields legend { padding: 0 7px; color: var(--ink); font-weight: 750; }
    .pricing-fields label:first-of-type { margin-top: 0; }
    .price-input { position: relative; }
    .price-input input { padding-right: 58px; }
    .price-input span { position: absolute; top: 50%; right: 14px; color: var(--muted); font-size: 13px; transform: translateY(-50%); }
    .price-hint { margin: 8px 0 0; font-size: 13px; }
    .cover-preview { display: block; width: min(100%, 440px); max-height: 250px; margin-top: 12px; object-fit: cover; border-radius: 14px; }
</style>
<script>
    (() => {
        const pricingModel = document.getElementById('pricing-model');
        const minimumPrice = document.getElementById('minimum-price');
        const priceHint = document.getElementById('price-hint');
        const updatePriceField = () => {
            const isFree = pricingModel.value === 'free';
            minimumPrice.readOnly = isFree;
            minimumPrice.required = pricingModel.value === 'paid';
            minimumPrice.value = isFree ? '0' : minimumPrice.value;
            priceHint.textContent = isFree
                ? 'Trò chơi miễn phí sẽ có giá tối thiểu bằng 0.'
                : pricingModel.value === 'paid'
                    ? 'Nhập mức giá cố định tối thiểu cho trò chơi.'
                    : 'Người chơi có thể trả mức này hoặc cao hơn.';
        };
        pricingModel.addEventListener('change', updatePriceField);
        updatePriceField();

        const coverInput = document.getElementById('cover-image');
        const coverPreview = document.getElementById('cover-preview');
        let previewUrl = null;
        coverInput.addEventListener('change', () => {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }
            const file = coverInput.files[0];
            coverPreview.hidden = !file;
            if (file) {
                previewUrl = URL.createObjectURL(file);
                coverPreview.src = previewUrl;
            } else {
                coverPreview.removeAttribute('src');
            }
        });
    })();
</script>
