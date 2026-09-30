# WP-Yomigana

Contributors: hametuha, Takahashi_Fumiki  
Tags: ruby, dl, cite, q, small  
Requires at least: 6.6  
Tested up to: 7.1  
Requires PHP: 7.4  
Stable tag: nightly  
License: GPL 3.0 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

## Description

このプラグインはWordPressのエディターにrubyタグを入力する機能を追加します。

**For Non-Japanese Speaker** This plugin enable `ruby` tag which is not a programming language but [Japanese bilinear writing system](http://dev.w3.org/csswg/css-ruby-1/). If you are not Japanese speaker, `ruby` won't matter. But this plugin also enables some utility buttons to your Visual Editor. Do you need `dl`, `small`, `cite` or `q` tags? Try this plugin!

### このプラグインの機能

- ブロックエディターにルビ入力機能を追加します。テキストを選択して、プルダウンもしくはショートカット `⌘(Ctrl) + Alt + R` でルビを入力。
- TinyMCE（クラシックエディター）にも対応。
- ついでにインライン引用（qタグ）、注釈（smallタグ）、定義リスト（dlタグ）、引用元（citeタグ）も入力できるようになります。
- テキストを選択するときは慎重に！

### 貢献

ソースコードは[GitHub](https://github.com/hametuha/wp-yomigana)にホストしているので、気軽にプルリク、イシューなどお送りください。

## Installation

1. ダウンロードする
2. zipファイルを解凍する
3. プラグインディレクトリにアップロードする(wp-content/plugins)。
4. プラグインを有効化する

特にこだわりがないのであれば、管理画面 > プラグイン > 新規追加からインストールすることをお勧めします。

##  Screenshots 

1. ブロックエディターではプルダウンに「ルビ」があります。
2. 設定画面。ビジュアルエディタのどの位置にボタンを出すか、決められます。
3. クラシックエディターでも使えます。

## Changelog

### 2.2.0

- WordPress 7.1 に対応。ブロックエディターのiframe表示に対応しました。
- 必要なWordPressのバージョンを6.6以上、PHPのバージョンを7.4以上に変更。
- ブロックエディターのルビ・引用の入力を、ブラウザのプロンプトからリンクと同様のインラインポップオーバーに変更。
- 引用（qタグ）の出典（cite属性）が再読み込み時に失われる不具合を修正。
- 引用（qタグ）のcite属性の入力欄を、仕様どおりURLを入力するよう変更。
- ブロックエディターでルビ入力をキャンセルしても、親文字と同じルビが挿入される不具合を修正。
- 引用元が空欄のとき、空のcite属性を出力しないよう修正。
- プラグイン更新後もクラシックエディター用のスクリプトが古いままキャッシュされる不具合を修正。
- クラシックエディターで、初期状態からルビボタンを表示するように変更。
- クラシックエディターのルビ・引用ダイアログを開いたとき、入力欄にフォーカスするように変更。
- ビルドツールを刷新。

### 2.1.0

- AMPプラグインと同時に使った時のエラーを抑制。
- ショートカットを `⌘ + Shift + R` から 変更。

### 2.0.3

- Ajaxリクエストにおけるエラーを修正。
- DLのスタイルシートが反映されなかったので修正。

### 2.0.2

- 依存関係に間違いがあったので修正。

### 2.0.1

- JavaScript翻訳のやり方が間違っていたので修正。

### 2.0.0

- Gutenbergに対応

### 1.4.0

- Bufgix. CSSが当たっていなかったのでパスを修正
- Bugfix. DFWモードのときにモーダルが後ろに隠れてしまうのを調整
- 古いファイルを削除
- アイコンをRetina対応
- PHPのバージョン5.4以上
- ライセンスをGPL3.0以上に変更
- Opear mini以外のブラウザでrubyが対応されているので、判別ロジックを削除

### 1.3.0

- Bugfix. WordPressのTinyMCEが4.0になったことに追従。
- DLタグの機能がTinyMCEに元々備わっていたことが判明したので、それを利用するよう変更。安定性の増加。
- Firefoxがver.38からrubyをサポートし始めたので、それに対応。
- アイコンの変更。
- rpタグおよびrbタグがHTML5/CSS3の仕様に入っていないので削除。
- citeタグが[TinyMCE Advanced]()プラグインから消えたので、追加。

### 1.2.3

- Bugfix. 管理者以外が実はrubyを入力できないということに気づいたので、修正。
- キャッシュ対策のため、no-rubyクラスの出力をJSに移譲。これにより、rubyサポートブラウザでno-rubyが出力されないように。
- body.no-rubyをhtml.no-rubyに変更

### 1.2.2

- Bugfix. IEでルビが入力できないことに気づいたので、直しました。ただし、全体的にややバギーです。気をつけて使ってください。

### 1.2.1

- Bugfix. ファイルを追加するのを忘れました。

### 1.2

- MS Wordからコピペしたときにrpタグがついてしまうので、サポートしました。

### 1.1

- rubyをサポートしないブラウザに対してno-rubyクラスを出力するようにしました。

### 1.0

- 公式リポジトリに追加

### 0.8

- プラグイン誕生
