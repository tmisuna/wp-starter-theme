<?php
  // ダッシュボード内の項目を以下に並び替える
  function my_custom_menu_order($menu_order) {
    if (!$menu_order) return true;
    return array(
      'index.php', // ダッシュボード
      'separator1', // セパレータ１
      'edit.php', // 投稿
      'edit.php?post_type=custom', // カスタム投稿
      'edit.php?post_type=page', // 固定ページ
      'separator2', // セパレータ２
    );
  }
  add_filter('custom_menu_order', 'my_custom_menu_order'); 
  add_filter('menu_order', 'my_custom_menu_order');

  // セパレーター(区切り線)に色を追加し、線の太さや余白を変更
  function my_admin_style() {
  echo '<style>
    #adminmenu li.wp-menu-separator {
    height: 1px!important;
    margin: 10px 0!important;
    background-color: #a7aaad;
  }
  </style>'.PHP_EOL;
}
add_action('admin_print_styles', 'my_admin_style');