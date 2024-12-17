#! bin/sh
# .envファイルの作成
cp .env.example .env
cp .env.testing.example .env.testing

# dockerの準備・立ち上げ
docker compose build
docker compose up -d

# composer install
docker compose run phpunit composer install

# .envファイルのアプリケーションキーを作成
docker compose run phpunit php artisan key:generate
docker compose run phpunit php artisan key:generate --env=testing

# マイグレーションの実行
docker compose run phpunit php artisan migrate
docker compose run phpunit php artisan migrate --env=testing

# local環境にMasterデータを用意
docker compose run phpunit php artisan db:seed --class=RoleSeeder

# testユーザの作成
docker compose run phpunit php artisan create:user
