# TC Practice問題集

下記の流れに沿って、実践してみてください。

問題は全部で10問あります。

回答例はanswerブランチにも用意しましたので、できたら照らし合わせてみてください。

※ 回答例と必ずしも一致しないといけないわけではありません。

　自身のコードとの差異を発見と捉え、楽しみながら確認してみてください^^

## Q1

tests/Unit/Libraries/PasswordUtilTest.php

に存在するtest_toHashのテストケースを完成させてください。

ロジックは、

app/Libraries/PasswordUtil.php

で確認できます。

## Q2

tests/Unit/Libraries/PasswordUtilTest.php

に存在するtest_isCorrectFalseのテストケースを完成させてください。

## Q3

app/Models/Role.php

に存在するexistsメソッドのロジックを完成させ、skipしているテストコードが通るようにしてください。

## Q4

tests/Unit/Models/UserTest.php

に存在するtest_register内でユーザ名がおのぽんとなっている箇所があります。

しかし、実際に本メソッドが利用される際、ユーザ名がおのぽんである必要はなく、ユーザ名がおのぽんでない可能性が高いため、

テストとしてはもう一歩という状況です。

そこで、Fakerを利用し、ユーザ名がテストを実行する度にランダムな名前が実行されるようにしてください。

## Q5

tests/Unit/Models/UserTest.php

に存在するtest_findWithPasswordFailedのテストケースを完成させてください。

※ ただし、ロジックは正しいものとします。


このテストケースでは、「ログインIDは合っているけど、passowrdに誤りがある」場合のテストケースを書こうとしています。

## Q6

tests/Feature/Controllers/LogoutControllerTest.php

にてtest_attemptのテストケースを完成させてください。

## Q7

tests/Feature/Controllers/LoginControllerTest.php

にてtest_attemptFailedのテストケースを完成させてください。

現段階ではtest_attemptFailedとなるケースは1パターンだけ考えていただければ大丈夫です。

## Q8

Q7にて、「test_attemptFailedとなるケースは1パターンだけ考えていただければ大丈夫です。」と記載しました。

しかし、ログインが失敗するケースとしては、

- ログインIDが存在しない
- ログインパスワードが異なる

の2パターンが存在します。

なぜ1パターンだけ考えれば良いのか、下記にお答えください。

A. xxxxxxxxxxなため。

## Q9

app/Models/User.php

に存在する getSign メソッドと対応するテストコードを完成させてください。

星座は下記をご参考にしてください。

#### 星座一覧

- 牡羊座: 03/21 - 04/19
- 牡牛座: 04/20 - 05/20
- 双子座: 05/21 - 06/21
- 蟹座  : 06/22 - 07/22
- 獅子座: 07/23 - 08/22
- 乙女座: 08/23 - 09/22
- 天秤座: 09/23 - 10/23
- 蠍座  : 10/24 - 11/22
- 射手座: 11/23 - 12/21
- 山羊座: 12/22 - 01/20
- 水瓶座: 01/21 - 02/18
- 魚座  : 02/19 - 03/20

## Q10

全体のテストを実行した際のカバレッジを100%にしてください。

## Q11 (2023/06/20 updated)

GuzzleHttpをMockeryを使って、loadOverviewTextのテストを書いてください。
mockの仕方はtest_loadOverviewText_apiResult404を参考にしてください。
\GuzzleHttp\Clientのrequest->getBody->getContentsをmockし、もしgetContentsがロジック内で呼ばれたら、$this->getDummyJson()
が呼ばれるようにしてください。

---

お疲れ様でした！

```
git diff master origin/answer
```

などを行い、ぜひ回答例とどのような差があるのかを確認してみてください。

新たな気づきや発見につながりますと幸いです。

最後までご回答いただきありがとうございました！
