# WordPressの新規テーマ作成に使えるテンプレート
WordPressの新規テーマ制作案件で使用するテンプレートです。

## テーマ直下のファイル群
既にテンプレートファイル群がありますが、基本的なものだけとなっています。
特定のスラッグがつく固定ページなど、必要なものがある場合は追加してください。
制作するテーマによって、直下の「style.css」の情報を上書きしします。

## includeフォルダについて
includeはページ間で共通化できるコンテンツや、パーツを一元化するためのフォルダです。
例えば「ページトップに遷移するボタン」などは、どのページにも共通していることが多いため、このフォルダに.phpファイルを作成します。
以下でインクルードしてください。
```
<?php get_template_part( $slug ); ?>
```

## functionsフォルダについて
functionsはfunctions.phpに記述する内容を、内容によって分割し、インクルードするためのフォルダです。
現在は以下のような構成となっていますので、お好みで追加してください。

### common.php
共通する設定を記述

### dashboard.php
ダッシュボード内で(管理画面)の表示設定やデザイン変更をしたい場合に記述

### display.php
表示関連の設定をしたい場合に記述

### ogp.php
ディスクリプション / ファビコン / OGPの設定を記述

### post.php
archive.phpの有効化やカスタム投稿の有効化など、投稿に関する設定を記述
