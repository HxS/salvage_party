# Salvage Party Wordpress theme.

## getting started

### gulp

CSSとJSをトランスパイルする。

```
npm install --save-dev
npm start
```

以降、`npm start`実行中はsassファイル、jsファイルに更新があったら
トランスパイル処理が走るようになる。

### docker / docker-compose

おすすめかも

```
bash boot.sh
```

→ http://localhost/ にサーバが立つ

### 普通のLAMP環境 / MAMP

古来からある方法で多分いちばん楽

1. WordPressのzipをDLして配置
2. `wp-content/themes/` でこのrepositoryをclone

### Vagrant

一応使えるけど非推奨

```
vagrant up
```

→ http://172.17.8.123/ にサーバが立つ

## 設計の方針

* docker-compose 系のコマンドをboot.shにまとめています。
    * docker-compose を介してwordpressのプラグインも導入してます。
* BEMつかってます。(CSS設計 / クラス名の付け方)
* babelつかってます。(Alt JS)
* bootstrap-sassをつかっています。
    * sassのextend機能をつかってCODINGしていきたいです。
