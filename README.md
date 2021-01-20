# Yurikoto第一版API实现

## 介绍

通过原生PHP实现，如果您有任何建议或改进想法，欢迎提交issue或pr。

第二版计划中，计划采用Springboot开发。有概率没有第二版。

[Yurikoto主页](https://yurikoto.com)

## 自托管指南

### 伪静态

```nginx
if (!-e $request_filename){
    rewrite ^(.*)$ /index.php;
}
```

### 依赖

需要安装PHPredis拓展，并解锁相应函数。具体可[上网搜索](https://www.google.com/search?sxsrf=ALeKk02Lz3NkpxySJupR12Ij0eBNoFBp0Q%3A1611114350957&ei=bqcHYLvWObvFmAWs9LfgAw&q=PHP+install+redis&oq=PHP+install+redis&gs_lcp=CgZwc3ktYWIQAzICCAAyAggAMgQIABAeMgQIABAeMgQIABAeMgYIABAFEB4yBggAEAUQHjIGCAAQCBAeMgYIABAIEB4yBggAEAgQHjoECCMQJzoECAAQQ1Dm3gNYh48EYPSTBGgAcAB4AIABwgGIAdUIkgEDMC42mAEAoAEBqgEHZ3dzLXdpesABAQ&sclient=psy-ab&ved=0ahUKEwi7xdLUzKnuAhW7IqYKHSz6DTwQ4dUDCA0&uact=5)。

### 配置文件

部署前，需要修改`config/config.template.php`，并将其重命名为`config.php`。

### 数据库

需要您创建数据库后，通过[资源仓库](https://github.com/yurikoto/yurikoto-resources)中提供的SQL文件导入表。

