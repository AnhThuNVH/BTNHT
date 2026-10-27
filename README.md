# Nen Tang Game Doc Lap Vi

## Run with XAMPP

1. Place the project folder in `C:\xampp\htdocs\BTT`.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open phpMyAdmin, select **Import**, and import `test.sql`. The script creates and selects `nen_tang_game_doc_lap_vi_v2`.
4. Confirm the database settings in `config/config.php`. They match the default XAMPP MySQL account (`root`, no password).
5. Open `http://localhost/BTT/` and register an account.

The project uses Apache rewrite rules to route page URLs through the front controller. If URLs return 404, enable `mod_rewrite` and allow `.htaccess` overrides (`AllowOverride All`) for `htdocs`.

The schema stores game metadata and media URLs; cover images uploaded from the game form are stored under `public/uploads/game-covers` (JPG, PNG, WebP or GIF, up to 5 MB), while downloadable game files are not stored. Cart checkout is a demo flow only: it records a simulated paid order and grants the selected games to the account library without charging money or contacting a payment provider.
