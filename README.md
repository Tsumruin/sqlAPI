# sqlAPI

## 本レポジトリの目的
SQLの記法を勉強するために作成。

## テーブルの構造
### mainテーブル

| | キー名 | 説明 | 備考 |
| ---- | ---- | ---- | ---- |
| 主キー | id |  | |
| | title | 記事のタイトル | |
| 外部キー | category | 記事のカテゴリ | categoryテーブルのcategory_idを参照 |
| | url | 記事のURL | |
| 外部キー | junre1 | ジャンル1 | junreテーブルのjunre_idを参照 |
| 外部キー | junre2 | ジャンル2 | junreテーブルのjunre_idを参照 |
| 外部キー | junre3 | ジャンル3 | junreテーブルのjunre_idを参照 |
| | update | 更新日 | |


### categoryテーブル

| | キー名 | 説明 | 備考 |
| ---- | ---- | ---- | ---- |
| 主キー | category_id |  | |
| | name | カテゴリー名 | |

### junreテーブル

| | キー名 | 説明 | 備考 |
| ---- | ---- | ---- | ---- |
| 主キー | junre_id |  | |
| | name | ジャンル名 | |
