<?php
  // WordPressコアから出力されるHTMLタグをHTML5のフォーマットにする
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
  
  // titleタグを自動で出力
  add_theme_support( 'title-tag' );

  // ページタイトルとサイトのタイトルの区切り文字を変更(デフォルトは「-」)
  function wp_document_title_separator( $separator ) {
    $separator = '|';
    return $separator;
  }
  add_filter( 'document_title_separator', 'wp_document_title_separator' );

  // 固定ページ表示時にbody_class関数にページスラッグを追加
  add_filter( 'body_class', 'add_page_slug_class_name' );
  function add_page_slug_class_name( $classes ) {
    if ( is_page() ) {
      $page = get_post( get_the_ID() );
      $classes[] = $page->post_name;
    }
    return $classes;
  }

  // タイトルタグを「サイト名」だけにする(キャッチフレーズを除去する)
  function remove_titletag($title) {
    if (isset($title['tagline'])) {
      unset($title['tagline']);
    }
    return $title;
  }
  add_filter('document_title_parts','remove_titletag');

  // 管理者以外のユーザーがログインしても、管理バーを表示させない
  $current_user = wp_get_current_user();
  if( !($current_user->ID == "1" )) {
    add_filter('show_admin_bar', '__return_false');
  }