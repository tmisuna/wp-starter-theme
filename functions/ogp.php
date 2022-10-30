<?php
  // OGP / ページディスクリプション設定を行う関数を定義
  function my_meta_ogp() {
    if ( is_front_page() || is_home() || is_singular() ) {
      // グローバル変数の定義
      global $post;

      // パスの関数を変数へセット
      $templateUrl = get_template_directory_uri();

      // 下記の項目は任意の値を入れる。(テーマ以下のパスを入力)
      $default_ogp_image = '/assets/images/meta/ogp.jpg';
      $favicon_url = '/assets/images/meta/favicon.ico';
      $appletouchicon_url = '/assets/images/meta/apple-touch-icon.png';
      $androidchrome_url = '/assets/images/meta/android-chrome-192×192.png';
      
      // 変数の初期化
      $description = '';
      $ogp_title = '';
      $ogp_description = '';
      $ogp_url = '';
      $ogp_img = '';
      $insert = '';

      // 投稿(カスタム投稿含む)＆固定ページのOGP設定
      if ( is_singular() ) {
        // 投稿情報をグローバル変数へセット
        setup_postdata($post);
        // カスタムフィールドの「description」を取得
        $descriptionValue = get_post_meta($post->ID, 'description', true);
        // カスタムフィールドの「description」がなければ、抜粋を呼び出す(120字まで)
        $description = $descriptionValue ? $descriptionValue : mb_substr(get_the_excerpt(), 0, 120);
        // og:description
        $ogp_description = $description;
        // og:title
        $ogp_title = $post->post_title;
        // og:url
        $ogp_url = get_permalink();
        // 取得した投稿情報をリセット
        wp_reset_postdata();
      }
      // トップページのOGP設定
      elseif ( is_front_page() || is_home() ) {
        // 一般設定の「サイトのタイトル」を取得
        $ogp_title = get_bloginfo('name');
        // 一般設定の「キャッチフレーズ」を取得
        $description = get_bloginfo('description');
        $ogp_description = $description;
        // ホームのURLを取得
        $ogp_url = home_url();
      }
      
      // og:type
      $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';
      
      // 固定ページ＆投稿(カスタム投稿含む)にアイキャッチ画像が設定されている場合
      if ( is_singular() && has_post_thumbnail() ) {
        $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $ogp_img = $ps_thumb[0];
      }
      // 上記がなければ、デフォルトのOGP画像を設定
      elseif ($default_ogp_image !== '') {
        $ogp_img = $templateUrl.$default_ogp_image;
      }
      
      // headに出力するディスクリプション
      if( is_front_page() || is_home() || is_singular() ) {
        $insert .= '<meta name="description" content="' .esc_attr($description). '" />' . "\n";
      }
      // headに出力するOGPタグ
      $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'">' . "\n";
      $insert .= '<meta property="og:description" content="'.esc_attr($ogp_description).'">' . "\n";
      $insert .= '<meta property="og:type" content="'.$ogp_type.'">' . "\n";
      $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'">' . "\n";
      $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'">' . "\n";
      $insert .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
      // og:image
      if ($ogp_img !== '') {
        $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'">' . "\n";
        $insert .= '<meta name="twitter:image:src" content="'.esc_url($ogp_img).'">' . "\n";
      }
      // favicon
      if ($favicon_url !== '') {
        $insert .= '<link rel="icon" href="' .$templateUrl.esc_attr($favicon_url). '">' . "\n";
      }
      if ($appletouchicon_url !== '') {
        $insert .= '<link rel="apple-touch-icon" href="' .$templateUrl.esc_attr($appletouchicon_url). '" sizes="180x180">';
      }
      if ($androidchrome_url !== '') {
        $insert .= '<link rel="icon" type="image/png" href="' .$templateUrl.esc_attr($androidchrome_url). '" sizes="192x192">';
      }
      echo $insert;
    }
  }
  // headに出力
  add_action('wp_head','my_meta_ogp');