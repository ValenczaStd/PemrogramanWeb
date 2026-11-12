</main>

<footer class="text-center py-3 text-secondary small">
  <p class="mb-0">&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 10</p>
</footer>

<?php
$jsFile = dirname(__DIR__) . '/assets/js/app.js';
$jsVersion = is_file($jsFile) ? filemtime($jsFile) : time();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base; ?>assets/js/app.js?v=<?php echo $jsVersion; ?>"></script>

<?php if (!empty($extra_scripts) && is_array($extra_scripts)): ?>
  <?php foreach ($extra_scripts as $src): ?>
    <script src="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>
</body>

</html>