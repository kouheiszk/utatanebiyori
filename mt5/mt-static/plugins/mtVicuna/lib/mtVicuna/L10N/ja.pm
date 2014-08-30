package mtVicuna::L10N::ja;

use strict;
use base 'mtVicuna::L10N::en_us';
use vars qw( %Lexicon );

%Lexicon = (
    'Vicuna Credit' => '<a href="http://mt.vicuna.jp/" title="ver.2.2.1">Movable Type Template</a>',
#Archive
    'Entry' => 'ブログ記事(個別エントリー)',
    'Entry Listing Category' => 'ブログ記事リスト(カテゴリー)',
    'Entry Listing Datebased' => 'ブログ記事リスト(月別)',
#Template Label
    'Header' => 'ヘッダー',
    'Footer' => 'フッター',
    'HTML Header' => '共通Head内要素',
    'Archive Index Link' => 'アーカイブページへのリンク',
    'Entry Metadata' => 'エントリーメタデータ',
    'Page Detail' => 'ウェブページ詳細',
    'Entry Detail' => 'エントリー詳細',
    'Entry Summary Feedbacks' => 'リアクションリンク',
    'Related Entries' => '関連エントリー',
    'Global Navigation' => 'グローバルナビゲーション',
    'Headline' => 'ヘッドライン',
    'Next Entry Link Detailed' => '前後の記事へのリンク(タイトル付き)',
    'Next Entry Link Simple' => '前後の記事へのリンク(シンプル)',
    'Calender' => 'カレンダー',
    'Return to page top' => 'ページ上部へ戻る',
    'Category Archive List' => 'カテゴリーリスト',
    'Links' => 'リンク集',
    'Monthly Archive List' => '月別リスト',
    'Recent Assets' => 'アイテム画像サムネイル',
    'Recent Comments' => '最近届いたコメント',
    'Recent Trackbacks' => '最近届いたトラックバック',
    'Topic Path' => 'パンくずリスト',
    'Feed' => 'フィード購読リンク',
#Widget Label
    'Conditional Widget - Main Index(Home)' => '条件付 Widget - トップページのみ出現',
    'Conditional Widget - Category' => '条件付 Widget - カテゴリページのみ出現',
    'Conditional Widget - Web Page' => '条件付 Widget - ウェブページのみ出現',
    'Conditional Widget - Individual' => '条件付 Widget - 個別エントリーのみ出現',
    'Conditional Widget - Datebased' => '条件付 Widget - 時系列ページのみ出現',
    'Monthly Archive Dropdown' => '月別ドロップダウン',
    'Navigation Utilities' => 'サイドバー(ナビゲーション)',
    'Other Utilities' => 'サイドバー(その他)',
#Text
    'Related Entries' => '関連エントリー',
    'This is a custom set of widgets that are conditioned to only appear on the Individual entry page.' => '個別エントリーページだけに表示されるように設定されているウィジェットです。',
    'This is a custom set of widgets that are conditioned to only appear on the Category archive.' => 'カテゴリーアーカイブページだけに表示されるように設定されているウィジェットです。',
    'This is a custom set of widgets that are conditioned to only appear on the Web page.' => 'ウェブページだけに表示されるように設定されているウィジェットです。',
    'This is a custom set of widgets that are conditioned to only appear on the Datebased archive page.' => '時系列アーカイブページだけに表示されるように設定されているウィジェットです。',
    'You can use some <abbr title="Hyper Text Markup Language">HTML</abbr> tags for decorating.' => 'スタイル指定用の一部の <abbr title="Hyper Text Markup Language">HTML</abbr>タグが使用できます。',
    'You cannot use <abbr title="Hyper Text Markup Language">HTML</abbr> tags.' => '<abbr title="Hyper Text Markup Language">HTML</abbr>タグは使用できません。',
    'Extended' => '続きを読む',
    'Comments on <$MTEntryTitle encode_html="1"$>' => '<$MTEntryTitle encode_html="1"$> へのコメント',
    'Trackbacks to <$MTEntryTitle encode_html="1"$>' => '<$MTEntryTitle encode_html="1"$> へのトラックバック',
    'a newer entry' => '1つ新しい記事',
    'an older entry' => '1つ古い記事',
#Search
    'You did not enter anything to search for. Please try again' => '検索キーワードが入力されていません。',
    'Your search - <em><$MTSearchString$></em> -- did not match any documents.' => '<em><$MTSearchString$></em> というキーワードを含む記事は見つかりませんでした。',
    'Suggestions:' => '次項のヒントを参考にして、検索キーワードを変えてもう一度検索してみてください。',
    'Make sure all words are spelled correctly.' => 'キーワードに誤字や脱字がありませんか ?',
    'Try different keywords.' => 'キーワードの意味はそのままで、表現や言い回しを変えてみてください。',
    'Try more general keywords.' => '専門的なキーワードだったり、長い文字列のキーワードだったりした場合は、より一般的で短いキーワードにしてください。',
    'Try decreasing the number of keywords.' => 'キーワードを複数指定している場合は、キーワードの数を減らしてみてください。',
    'Character Case' => '大文字・小文字を区別する',
    'Regex Search' => '正規表現を使用する',
    'Body text' => '本文内検索',
    'Comments' => 'コメント',
    'Both' => '両方',
);

1;