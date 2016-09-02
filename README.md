# Salvage Party Wordpress theme.

## getting started

### docker / docker-compose

おすすめかも

```
docker-compose up -d
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
