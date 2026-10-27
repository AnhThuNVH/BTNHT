<?php
// Layout template for itch.io clone
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? APP_NAME, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        :root {
            color-scheme: light;
            --ink: #24213b;
            --muted: #716f83;
            --paper: #fffdf9;
            --line: #e9e4ed;
            --purple: #7047eb;
            --purple-dark: #5231c7;
            --coral: #ff715b;
            --mint: #b7f2d5;
            --sun: #ffe28a;
            --shadow: 0 16px 38px rgba(48, 34, 86, .09);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            color: var(--ink);
            font: 16px/1.6 "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(ellipse at 7% 0%, rgba(255, 226, 138, .26), transparent 30rem),
                radial-gradient(ellipse at 92% 10%, rgba(183, 242, 213, .3), transparent 28rem),
                #faf8ff;
        }
        a { color: var(--purple-dark); text-decoration: none; }
        a:hover { color: var(--coral); }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
            outline: 3px solid rgba(112, 71, 235, .28);
            outline-offset: 2px;
        }
        .container { width: min(1160px, 100% - 40px); margin: 0 auto; }
        .site-header { padding: 20px 0; margin-bottom: 32px; border-bottom: 1px solid rgba(112, 71, 235, .1); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .site-header h1 { margin: 0; font-size: 19px; line-height: 1.2; letter-spacing: -.04em; }
        .brand { display: inline-flex; align-items: center; gap: 11px; color: var(--ink); }
        .brand:hover { color: var(--ink); }
        .brand-mark {
            display: grid; width: 40px; height: 40px; place-items: center; border-radius: 14px;
            color: #fff; background: linear-gradient(135deg, var(--purple), #a36cff);
            box-shadow: 0 7px 16px rgba(112, 71, 235, .24); font-size: 20px;
        }
        nav { display: flex; align-items: center; justify-content: flex-end; gap: 7px; flex-wrap: wrap; }
        nav a, .nav-logout {
            display: inline-flex; align-items: center; min-height: 40px; padding: 8px 12px;
            border: 0; border-radius: 12px; color: #56536b; background: transparent;
            font: inherit; font-size: 14px; font-weight: 650; cursor: pointer;
        }
        nav a:hover, .nav-logout:hover { color: var(--purple-dark); background: #f0ebff; text-decoration: none; }
        nav .nav-cta { color: #fff; background: var(--purple); }
        nav .nav-cta:hover { color: #fff; background: var(--purple-dark); }
        main { min-height: 65vh; }
        footer { margin-top: 72px; padding: 24px 0 34px; border-top: 1px solid var(--line); color: var(--muted); font-size: 14px; }
        footer p { margin: 0; }
        .button {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            min-height: 44px; padding: 10px 18px; border: 0; border-radius: 13px;
            color: #fff; background: var(--purple); box-shadow: 0 7px 15px rgba(112, 71, 235, .2);
            font: inherit; font-weight: 700; cursor: pointer; transition: transform .18s ease, background .18s ease;
        }
        .button:hover { color: #fff; background: var(--purple-dark); transform: translateY(-2px); text-decoration: none; }
        .card {
            padding: 20px; border: 1px solid rgba(91, 73, 139, .1); border-radius: 20px;
            background: rgba(255, 255, 255, .92); box-shadow: 0 8px 25px rgba(48, 34, 86, .045);
        }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(235px, 1fr)); gap: 20px; }
        h2, h3, h4 { color: var(--ink); line-height: 1.25; letter-spacing: -.025em; }
        h2 { font-size: clamp(24px, 3vw, 34px); }
        p { color: #57556a; }
        input, textarea, select {
            width: auto; max-width: 100%; padding: 11px 13px; border: 1px solid #ded9e8;
            border-radius: 12px; color: var(--ink); background: #fff; font: inherit;
        }
        input::placeholder { color: #a09cad; }
        input:hover, textarea:hover, select:hover { border-color: #bdb1df; }
        label { display: block; margin: 14px 0 6px; color: #454258; font-size: 14px; font-weight: 650; }
        .notice { padding: 13px 16px; margin: 12px 0; border: 1px solid #f1d88a; border-radius: 14px; background: #fff7da; color: #735914; }
        img { max-width: 100%; }
        @media (max-width: 760px) {
            .container { width: min(100% - 28px, 600px); }
            .site-header { margin-bottom: 22px; }
            .header-inner { align-items: flex-start; flex-direction: column; gap: 14px; }
            nav { justify-content: flex-start; gap: 4px; }
            nav a, .nav-logout { padding: 7px 9px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="site-header">
            <div class="header-inner">
            <h1><a class="brand" href="<?php echo app_url('/games'); ?>"><span class="brand-mark" aria-hidden="true">✦</span><span><?php echo htmlspecialchars(APP_NAME, ENT_QUOTES, 'UTF-8'); ?></span></a></h1>
            <nav>
                <a href="<?php echo app_url('/games'); ?>">Trò chơi</a>
                <a href="<?php echo app_url('/forums'); ?>">Diễn đàn</a>
                <a href="<?php echo app_url('/jams'); ?>">Cuộc thi</a>
                <?php if (!empty($_SESSION['user'])): ?>
                    <a href="<?php echo app_url('/account'); ?>">Tài khoản</a>
                    <a href="<?php echo app_url('/cart'); ?>">Giỏ hàng</a>
                    <form method="post" action="<?php echo app_url('/auth/logout'); ?>">
                        <button class="nav-logout" type="submit">Đăng xuất</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo app_url('/auth/login'); ?>">Đăng nhập</a>
                    <a class="nav-cta" href="<?php echo app_url('/auth/register'); ?>">Đăng ký</a>
                <?php endif; ?>
            </nav>
            </div>
        </header>
        <main>
            <?php foreach (['error', 'success'] as $flash): ?>
                <?php if (!empty($_SESSION[$flash])): ?>
                    <div class="notice"><?php echo htmlspecialchars((string)$_SESSION[$flash], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php unset($_SESSION[$flash]); ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php echo $content; ?>
        </main>
        <footer>
            <p>Nen Tang Game Doc Lap Vi - Mô phỏng itch.io</p>
        </footer>
    </div>
</body>
</html>
