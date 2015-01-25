# gulp-tutorial
phpの為のgulp入門

[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/ytake/gulp-tutorial.svg?style=flat)](https://scrutinizer-ci.com/g/ytake/gulp-tutorial/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/54c4fe480a18c34b3800007c/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54c4fe480a18c34b3800007c)
[![Dependency Status](https://www.versioneye.com/user/projects/54c4fe480a18c3cf470000c0/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54c4fe480a18c3cf470000c0)  

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e603c1c7-3f19-4b9c-a6e6-9a78eae583af/big.png)](https://insight.sensiolabs.com/projects/e603c1c7-3f19-4b9c-a6e6-9a78eae583af)

## install
node.jsが必要です。  
公式からダウンロードするか、OSのパッケージ等をご利用ください  
http://nodejs.org/

## npm
node.jsのパッケージマネージャです  
gulpとbowerをグローバルでインストールしますが、  
お使いの環境等に合わせて下さい
```bash
$ npm install -g gulp
$ npm install -g bower
# 本サンプルで利用するライブラリ全てをプロジェクト配下にインストール
$ npm install
```
node.jsライブラリのディレクトリはnode_modules配下です  
bowerは`.bowerrc`を利用してcomposerと同様にvendor/bower_componentsに配置されます。
## composer
```bash
$ composer install
```
## gulp tasks
■built in server
```bash
$ gulp boot
```
■default
bower install, ファイル配置, コンパイル, phpunitなどが含まれています
