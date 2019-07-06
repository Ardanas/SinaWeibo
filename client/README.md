### 网站描述

> 该网站是模仿新浪微博网页端，极力的去模仿它里面的所有界面特效以及细节，尽力做到一模一样， 从而达到提升自己的技术的目标，记录自己的学习成果，在开发过程中弥补自己的不足。前端主要用了Vue+Element UI框架，后端用的是PHP，数据库用的是MySQL

### 功能模块
+ 登录页
	+ 登录界面
	+ 热门
    + 本地新闻
    + 体育
    + 电影
	+ 搞笑
	+ 时尚

+ 首页
	+ 发布信息
	+ 信息查看
+ 个人主页
	+ 个人信息
	+ 个人相册
	+ 修改资料
	+ 空间装扮

### 效果展示
![login.png](https://upload-images.jianshu.io/upload_images/9711746-9ce6dd4854e82dab.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/440)

![login_detail.png](https://upload-images.jianshu.io/upload_images/9711746-2e112ab4e75505b6.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/440)

![index.png](https://upload-images.jianshu.io/upload_images/9711746-781da470a1feeaef.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/440)



## Client Build Setup

``` bash
# install dependencies
npm install

# modify configuration files
打开main.js文件， 将 Vue.prototype.$HOST 改成你的php服务器地址 'http://localhost/controller/'(看个人情况而定)

# modify configuration files
再打开config/index.js文件，找到proxyTable，将'/vp'下的target给为php服务器地址（http://localhost:80）

# serve with hot reload at localhost:8080
npm run dev

```

## Server Build Setup

``` bash
# move to the specified folder
将server下的controller移动到你的php运行环境里（我的是wamp64）
# serve with hot reload at localhost:80
开启服务器
```

## db Build Setup
``` bash
# import database
将.sql文件导入到本地数据库中，创建好表
# modify configuration files
在server/controller/conn/config/config.php修改本地数据库的配置信息
```
