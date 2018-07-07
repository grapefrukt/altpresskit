<header>
  <?php if (!isset(ViewHelper::$headerImage)): ?>
    <h1 class="sixteen columns"><?php echo ViewHelper::$header; ?></h1>
  <?php else: ?>
    <h1 class="sixteen columns has-image" style="background-image: url(<?php echo ViewHelper::$headerImage; ?>); background-color: <?php echo (ViewHelper::$headerColor != '') ? ViewHelper::$headerColor : 'inherit'; ?>">
      <?php echo ViewHelper::$header; ?>
    </h1>
  <?php endif; ?>
</header>
