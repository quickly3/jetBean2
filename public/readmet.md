
#### 1. npm install -g nrm

     自动切换npm源头的jcli
     nrm ls
     nrm taobao


#### 2. lite-serve 
	小型node web服务器

#### 3. ng serve --port 3000


     angular-cli 切换serve端口


#### 4. 关于英雄编辑器(ng2官方示例)：

	Anuglar 中文官网上的例子代码是有问题的 
	
	下面这个是可以直接用npm启动的
	git clone https://github.com/johnpapa/angular-tour-of-heroes.git toh



#### 5. 有两个ng2-bootstrap angular1的叫做ui-bootstrap

	1. npm install --save @ng-bootstrap/ng-bootstrap
	https://ng-bootstrap.github.io/#/getting-started
	(这个是真的)
	
	
	2. npm install ngx-bootstrap --save
	http://valor-software.com/ngx-bootstrap/#/


#### 6. Angular2 使用Scss

          
	如果是新建一个angular工程采用sass：
	ng new My_New_Project --style=sass
	这样所有样式的地方都将采用sass样式，如果需要使用sass的scss语法，还可以如下方式：
	ng new My_New_Project --style=scss
	然后需要手动安装node-sass:
	npm install node-sass --save-dev
	这样就可以实现用sass语法做样式了。
	已有angular-cli工程改为sass
	如果是已经新建了工程，需要切换到sass，则采用如下方法：
	首先同样安装sass需要的node-sass包
	npm install node-sass --save-dev 
	然后修改已有项目的.angular-cli.json配置文件：
	首先修改最后的defaults标签

	* 
	* 
	* SASS 语法修改为
	"defaults": {
	     "styleExt": "sass",
	}

	* SCSS语法修改为
	"defaults": {
	     "styleExt": "scss",
	}



	然后修改styles标签
	"styles": [
	        "styles.css"
	      ],
	其中的css修改为sass或scss。
	并把全局style.css文件改为style.scss或style.sass。
