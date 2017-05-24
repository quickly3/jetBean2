mkdir storage

sudo php artisan key:generate
* sudo chmod -R 777 ./storage  (web 服务器需要拥有 storage 目录下的所有目录和 bootstrap/cache 目录的写权限。)
* sudo chmod 777 ./bootstrap/cache

cd storage

mkdir app

mkdir logs 

mkdir framework

cd framework

mkdir sessions
mkdir views
mkdir cache


sql:
create database jetbean;


### 自动建表  
php artisan migrate
#### 填充数据 
php artisan db:seed --class=UserTableSeeder

后台地址
/Adm

默认管理员账号密码
ID：admin_jetbean
pwd:admin_jetbean