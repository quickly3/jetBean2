#### 下载核心代码
git clone https://github.com/quickly3/jetBean2.git



#### 自动从composer 安装所需php包
composer install

国内环境composer请替换中国镜像
	Cmd替换方法
	composer config -g repo.packagist composer https://packagist.phpcomposer.com

#### 更新app key
sudo php artisan key:generate


#### 建立相关缓存目录
mkdir storage

cd storage

mkdir app

mkdir logs 

mkdir framework

cd framework

mkdir sessions
mkdir views
mkdir cache

#### 目录授权
* sudo chmod -R 777 ./storage  (web 服务器需要拥有 storage 目录下的所有目录和 bootstrap/cache 目录的写权限。)
* sudo chmod 777 ./bootstrap/cache

sql:
create database jetbean;


#### 自动建表  
php artisan migrate
#### 填充数据 
php artisan db:seed --class=UserTableSeeder

后台地址
/Adm

默认管理员账号密码
ID：admin_jetbean
pwd:admin_jetbean