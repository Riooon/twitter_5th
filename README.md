# twitter_5th

前回までに引き続きTwitterもどきに機能を追加いたしました。
今回追加しました機能は、以下の通りです。

1. デフォルトの画像を設定
2. 同じ人の複数回フォロー禁止
3. タイムラインから自分の投稿を非表示（自分をフォローできないようにするため）
4. ajaxを使ったリツイート機能・いいね機能（メイン）
5. ツイートの詳細ページで上記2点の数・人を表示（メイン）

<機能していない点>
いくつか上手く機能させれなかった点があり、記載させていただきます。

・タイムラインからの直接リツイート・いいね - 
データの繋がりがかなり複雑になり、諦めました。

・リツイートした投稿と、元の投稿のリツイート数等が連動していない - 
リツイートしたものを元の投稿と区別することで自分のタイムラインにとりこめるようにしましたが、そうすると数値が連動しなくなってしまいました。

・ツイート詳細画面（tweet_detail.php）にて、リツイート・いいねをした際に、データをajaxで送信・数値をjQueryで変更していますが、リツイート・いいねした人はMySQLからデータをとってきて表示しているため、リロードしないと表示されていません。

もし可能であれば、上記少しアドバイスをいただけますととても嬉しいです。

時間の都合上、ハッシュ化・エスケープ・関数化が全然できてなく、コードも見にくくて（醜くて）大変恐縮なのですが、よろしくお願い致します。
