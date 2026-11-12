<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!empty($_SESSION['user_id'])) { header('Location: ../index.php'); exit; }
$page_title = 'Login Petugas';
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']);
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<section class="card shadow-sm mb-4"><div class="card-body">
<h2 class="text-brand mb-3">Login Petugas</h2>
<?php if ($flash): ?><p class="flash flash-<?php echo h($flash['type']); ?>"><?php echo h($flash['pesan']); ?></p><?php endif; ?>
<form method="post" action="proses_login.php">
  <div class="mb-3"><label for="username" class="form-label">Username</label><input class="form-control" id="username" name="username" required autocomplete="username"></div>
  <div class="mb-3"><label for="password" class="form-label">Password</label><input class="form-control" type="password" id="password" name="password" required autocomplete="current-password"></div>
  <button class="btn btn-brand" type="submit">Masuk</button> <a href="register.php" class="btn btn-outline-secondary">Daftar akun</a>
</form></div></section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
