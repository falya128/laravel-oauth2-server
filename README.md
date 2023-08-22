# Laravel OAuth2 Server

## 概要

OAuth2 を用いた認証機能の構築手順を理解するために作成した Laravel プロジェクトです。  
詳細についてはこちらの Qiita 記事をご参照ください。  
https://qiita.com/falya128/items/652a0d150faaaeb58b2b

本プロジェクトはリソースサーバ 兼 認証サーバの役割を担っております。  
動作確認を行うためには、別リポジトリのクライアントアプリと併せてご利用ください。  
https://github.com/falya128/laravel-oauth2-client

## 開始手順

### 各種ライブラリのインストール

```powershell
cd laravel-oauth2-server
composer install
npm install
```

### 環境設定

```powershell
cp .env.example .env
php artisan key:generate
```

以下の箇所を変更

```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### データベース準備

```powershell
php artisan migrate
php artisan db:seed
```

### Laravel Passport の Key 作成

```powershell
php artisan passport:keys
```

### Laravel Passport の Client 作成

```powershell
php artisan passport:client --public

 Which user ID should the client be assigned to? (Optional):
 > [入力なしで Enter キー押下]

 What should we name the client?:
 > OAuth2Server Authorization Code Grant

 Where should we redirect the request after authorization? [http://localhost/auth/callback]:
 > http://localhost:8000/auth/callback

New client created successfully.
Client ID: ********-****-****-****-************
Client secret:
```

### 起動

```powershell
npm run build
php artisan serve --port=8080
```
