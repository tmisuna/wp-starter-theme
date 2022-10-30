<?php
  // archive.phpの有効化
  function post_has_archive( $args, $post_type ) {
  if ( 'post' == $post_type ) {
    $args['rewrite'] = true;
    $args ["label"] = '投稿'; // 「投稿」の表記を変更したい場合に値を変更
    $args['has_archive'] = 'archive'; //任意のスラッグ名
  }
  return $args;
  }
  add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

  /* archive.phpの１ページあたりの表示数を変更する */
  function change_posts_per_page($query) {
    if ( is_admin() || ! $query->is_main_query() ) /* メインクエリでの表示数 */
      return;
    if ( $query->is_archive() ) { //アーカイブページの場合
      $query->set( 'posts_per_page', '-1' ); /* 表示件数を指定する。 */
    }
  }
  add_action( 'pre_get_posts', 'change_posts_per_page' );
  
  // 投稿機能画面でアイキャッチ画像の有効化
  add_theme_support( 'post-thumbnails' );

  // カスタム投稿タイプを追加する処理
  add_action( 'init', 'create_post_type' );
  function create_post_type() {
    register_post_type( // カスタム投稿タイプの追加
      'custom', //カスタム投稿タイプ名
      array(
        'label' => 'カスタム投稿', // 管理画面上のラベル名
        'public' => true, // 管理画面上に表示するかどうか
        'has_archive' => true, // 投稿した記事の一覧ページを作成する
        'show_in_rest' => true, // Gutenbergの有効化
        'menu_position' => 5, // 管理画面メニューの表示位置
        'supports' => array( // サポートする機能（以下）
          'title', // タイトル
          'editor', // エディター機能
          'thumbnail', // アイキャッチ画像
          'revisions', // リビジョン
          'comments' // コメント
        ),
      )
    );

    register_taxonomy( // カスタムタクソノミーの追加
      'custom-cat', // タクソノミー名
      'custom', // タクソノミーを追加したいカスタム投稿タイプ名
      array(
        'label' => 'カテゴリー', // 管理画面上のラベル名
        'public' => true, // 管理画面上に表示するかどうか
        'hierarchical' => true, // 階層を持たせるかどうか
        'show_in_rest' => true, // REST APIの有効化。ブロックエディタの有効化。
      )
    );
  }