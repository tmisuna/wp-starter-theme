<?php
  // 記事の抜粋の文字の省略を[...]→...（任意の値）に変更する
  function new_excerpt_more( $more ) {
    return '...';
  }
  add_filter( 'excerpt_more', 'new_excerpt_more' );

  // 固定ページのエディターを無効化
  add_filter('use_block_editor_for_post',function($use_block_editor,$post) {
    if($post->post_type==='page') {
      remove_post_type_support('page','editor');
      return false;
    }
    return $use_block_editor;
  },10,2);