<ul class="sidebar wow slideInRight">
  <?php
    $parent_ID = $post->ID;
    if($post -> post_parent != 0 ){
      $ancestors = array_reverse(get_post_ancestors( $post->ID ));
      $parent_ID = $ancestors[0];
    }
    $child_posts = query_posts(
      'numberposts=-1&order=ASC&orderby=menu_order&' .
      'post_type=page&post_parent=' . $parent_ID
    );
    if ( $child_posts ) {
      foreach ( $child_posts as $child ) {
        $c_title = apply_filters( 'the_title', $child->post_title );
        $c_permalink = apply_filters(
          'the_permalink',
          get_permalink( $child->ID )
        );
          ?>

            <li>
              <a href="<?php echo $c_permalink; ?>">
                <p><?php echo $c_title; ?></p>
              </a>
            </li>

          <?php
      }
    }
  ?>
</ul>
