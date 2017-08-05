ThinkPHP 5.0 商城
===============
2017/4/27 2:11:00
 ----------------------------------------------------
## 商家平台
    * 商家入驻：
        1.地址获取经纬度
        2.图片上传
        3.邮件发送
     * 商家登陆
        session
     c.门店管理
        1.新增门店
        2.门店列表
        3.编辑门店
     d.商品管理
        1.添加商品
        2.商品列表
## 主平台
    a.分类管理
        1.添加分类
        2.分类列表
        3.分类排序
        4.修改状态
        5.修改分类
        6.删除分类
        7.获取子栏目
        8.分页处理
    b.城市管理
    c.商家管理
        1.商户入驻审批
        2.商户列表
    d.团购商品管理
        1.商家提交商品列表
        2.商家提交商品审批
        3.商品列表
        4.商品搜索
## 前台模块
    1.首页
    2.商品列表页
    3.商品详情页
    4.订单确认页
    5.微信支付
    6.消费券
    7.登录注册

## 一： 详细介绍
#### a.导入数据表 source f:/thinkphp5/er/mysql.sql
#### b.tp5基础：
    1.启动命令  php -S localhost:8181 router.php
    2.nohup使用 nohub php -S localhost:8181 router.php &
    3.运行tp5
       config.php  默认return 'default_return_type'    => 'html',  json
    4.
        php think make:controller index/Test  创建控制器文件Test
        访问：http://www.tp5shop.com/index.php/index/test/aqie
        访问：http://www.tp5shop.com/index.php?s=index/test/aqie
#### c.创建模块
    1.build.php 放到application下,并配置
    2. 根目录执行 php think build 创建模块
#### d.加载模板文件
    1.静态模板放到tp5
        a.前端文件放在 public/static/index下
        b.application/config  配置 '__STATIC__' => '/static',
        c.公共部分 index/view/public  head.html nav.html
        d. 命令行新建
            php think make:controller index/User  user控制器
    2.模板中文件引入
        a.__STATIC__/index/css/base2.css
        b.后台模板 H-ui.admin
            1.将foot,head,menu分离
            2.iframe welcome.html ->  {:url('index/welcome')}
#### e.生活服务模块
    1.增删改查
        1.添加：模板表单数据->控制器->validate->model->数据库
        2.连接数据库
            application/database.php
        3.编写common模块下category模型
        4.优化自动添加时间
    2.validate验证
        admin/validate/Category.php  对提交表单进行验证
    3.tp5分页
        1.获取一级分类，点击显示子分类
        2.application/common.php 下面定义公共函数
        3.config.php    'url_common_param' => true,(编辑,自动生成url)
        4.
        5.新建 public/static/admin/css/common.css
    4.编辑排序
        1.新建public/static/admin/js/common.js
    5.修改状态
        2.要记得添加状态的长江
    6. 完善城市管理city和商圈管理area
#### f.根据地址获取经纬度
    1.获取第三方接口
        ak : g0WG86oUwxZkcGGjlfgcNUbGhRuWZL0C  ->web服务API ->Geocoding
        新建 ：extends/Map.php
        新建 ：application/extra
        application/common.php 封装curl
        （http://lbsyun.baidu.com/index.php?title=static）
#### g.发送邮件
    1.获取开源的phpmail类 放到extend 目录
    2.开启stmp服务
        aqie123aqie@163.com
        封装phpmail
        新建extra/email.php
    3.测试发送邮件
#### h.商户模块
    1.商户bis模块搭建
        1.login/index      (http://www.tp5shop.com/index.php/bis/login/index)
        2.register/index (http://www.tp5shop.com/index.php/bis/register/index)
            a.所属城市
            b.所属分类(有二级分类则列出来)
        3.新建common/model/city.php  php think make:model Common/City
        4.public/static/admin/js/common.js
        5.api/common.php 定义show(方法)
        6.
            Reghister控制器$citys = model('city')->getNormalCitysByParentId(); 获取城市
            common.js 传入城市id 通过ajax  api/city/getCitysByParentid  获取二级城市
            获取所属分类同上
            优化：api/config.php 让所有数据输出格式以json格式
        7.图片上传
            1.uploadify插件 public/static/admin/uploadify
            2.image.js
                bis/views/register/index,html 配置
            3.编写图片上传API接口实现图片异步上传
        8.商户申请数据入库和邮件发送  (申请 bis模块下的register控制器)
            1.validate进行数据校验
               新建 application/common/validate/Bis.php
            2.数据入库(商户表(o2o_bis),商户门店信息(o2o_bis_location),商户账号信息(o2o_bis_account))
            3.邮件发送
                application/common.php 编写bisRegister(方法)
    2.模板导入
    3.城市分类数据填充
#### i.主后台商户入驻列表页开发
    1.商户入驻申请->主后台入驻列表页->查看->审核(修改状态)->商户列表
    2.bank_account   有问题
    3.查看在common.php定义 getSeCityName(获取二级城市)
=============================bis模块===============================
#### j.tp5-session处理商户后台登录模块 （bis/login）
    1.登录逻辑处理
    2.session使用
    3.退出登录逻辑处理
    4.加载商户后台页面
#### k.商户门店管理 (bis/location)
    1.商户管理员添加门店 (location控制器)
    2.列表页，门店查看，下架
    3.主后台有个门店管理，对分店进行审核 （admin模块）
        a.完成门店批准 (admin/location/status) *****************这里代码重复了***********************
        b.门店列表 admin/location/index
#### l.添加本地团购 bis/deal/add 表(o2o_del 团购商品表)
    1.模板中时间插件使用
    2.入库操作
=============================admin模块===============================
#### m.主后台团购商品列表页
    1.团购商品管理/商家团购提交 进行审核 admin/deal/apply
        a.
    2.显示审核后的团购列表(分页)        admin/deal/index
    3.搜索
#### n,xss攻击
    1.<script>alert('xss攻击')</script>
    2.解决：a.htmlentities()
        b. tp5自带：input('post.','','Htmlentities');
            同时在富文本编辑器里面 会两次转译
            反转译($bisData.description|html_entity_decode)
        c. application/config  配置 'default_filter'         => 'htmlentities',
    3.商户添加分店信息 bis/location/add
      商家入驻申请 bis/register/index
      商家团购提交 bis/deal/add
#### o.推荐位添加功能 （o2o_featured）admin模块
    1.application/extra/featured 放推荐位相关配置
    2.推荐位列表功能 (展示分页,搜索)
#### p.前台模块 index模块   (debug  CTRL+SHIFT+X)
    1.tp5验证码使用：
       a. 进入根目录
        composer require topthink/think-captcha
       b.模板中 {:captcha_img()}   helper.php(captcha_img)
       c.控制器判断验证码是否正确
    2.用户注册 index/user/register
      用户登录          index/user/login
    3.首页header头
        a.完成城市数据填充
        b.用户状态
    4.  首页展示数据
        1.分类数据填充        //  难点
        2.首页大图，广告位
        3.展示商品数据
            a.application/common.php
    5.商品详情页 index/detail/index
        1.倒计时
        2.地图
            a.extend文件下map.php
            b.
        3.循环分店  // todo
        4.消费提示，商家介绍
    6.商品列表页 index/list/index
        1.分类获取
        2.排序
        3.分页
            appends($params)
    7.订单流程   index/order/index
        1.流程
            详情页抢购->订单确认页->订单入库->二维码->微信支付->异步通知
        2.订单确认页面 index/order/confirm
        3.在common.php 添加创建订单号方法

#### q.   日志问题
    1.tp5日志
        a.F:\thinkphp5\thinkphp\library\think\Log.php
    2.php错误日志
        a.变量调试
        b.sql调试
            halt($data);
        c.浏览器控制台
        d.性能调试
            echo $a = time();
            echo $b = time();
            echo $b-$a;
            tp5:debug('begin');     // 仅仅是标识  获取程序执行时间
                debug('end');
                echo debug('begin','end','m');exit;  // 返回秒 加第三个参数返回内存
        e.trace调试
    3.web服务器日志,mysql日志

#### r.mysql time
    website： http://www.cnblogs.com/wenzichiqingwa/archive/2013/03/05/2944485.html
    1.SELECT COUNT(*) FROM USER WHERE registerDate >= CURDATE() AND registerDate < DATE_SUB(CURDATE(),INTERVAL -1 DAY);
    2.select unix_timestamp('2008-08-08');
    3.select FROM_UNIXTIME(1156219870);
    4.Select UNIX_TIMESTAMP('2017-06-04 06:58:31');

 s。https://zhidao.baidu.com/question/375423031.html   










   