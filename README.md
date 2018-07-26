# Your Tasty Storager 
一个简单的PHP文件床工具。使用本人开发的php框架<a href="https://github.com/sapphirell/model-php">model-php</a>进行开发。
仅需PHP即可启动。<br />
① sudo apt-get install -y php7.0 (如已安装则跳过此步骤,输入php -v确定是否安装。) <br />
② cd ~ && git clone https://github.com/sapphirell/Your-Tasty-Storager.git <br />
③ php -S 127.0.0.1:80 完成启动。 <br />

# 配置
打开config.ini 文件进行详细配置。

#自定义接口
/App/Route.php 中配置相对应的路由
#自带上传接口
file的name参数为image,地址为/upload_file,method为GET。
测试/index