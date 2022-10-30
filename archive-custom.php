<?php get_header(); ?>

<main>
  <ul>
    <?php if (have_posts()): ?>
    <?php while (have_posts()) : the_post(); ?>
    <li>
      <!-- 「投稿」のパーマリンク -->
      <a href="<?php the_permalink(); ?>"></a>
      <!-- 「投稿」に紐づいたアイキャッチ画像を表示 -->
      <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail(); ?>
      <?php else: ?>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/test/test_dummy_01.jpg" alt="">
      <?php endif; ?>
      <!-- 「投稿日」を表示 -->
      <p><?php the_time("Y年n月j日"); ?></p>
      <!-- 「投稿」に紐づくカテゴリーを表示 -->
      <?php the_category(); ?>
      <!-- 「投稿」のタイトルを表示 -->
      <p><?php the_title(); ?></p>
      <!-- 「投稿」の抜粋(80字で設定) -->
      <p><?php echo mb_substr(strip_tags($post-> post_content),0,80) . '...'; ?></p>
    </li>
    <?php endwhile; ?>
    <?php endif; ?>
  </ul>
</main>

<?php get_footer(); ?>