<ul class="sidebar">
  <li><span>参考URL</span></li>
  <?php if (get_post_meta($post->ID, 'reference') == NULL): ?>
    <li><span>なし</span></li>
  <?php else: ?>
    <li><a href="<?php echo get_post_meta($post->ID, 'reference')[0]; ?>"
      target="_blank">
      <?php echo get_post_meta($post->ID, 'reference')[0]; ?>
    </a></li>
  <?php endif; ?>
</ul>
