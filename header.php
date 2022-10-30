<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if(is_tag() || is_date() || is_search() || is_404()) : ?>
  <meta name="robots" content="noindex">
  <?php endif; ?>
  <?php wp_head(); ?>
</head>

<body <?php echo body_class(); ?>>

  <header></header>