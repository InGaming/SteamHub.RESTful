- [准备工作](#dev-environment-pre-reqs)
- [设置开发环境](#setup-dev-environment)
- [提交指南](#submitting-changes-pull-requests)

<a name="dev-environment-pre-reqs">
# 开发环境预先要求

> {info} 如果你是在 Windows 下开发,除了手动部署虚拟机外,我们也推荐你使用 Homestead 作为开发环境.

* OS: Ubuntu(Linux)
* PHP: 7.1+
* Composer: Latest
* MySQL: 5.7
* Redis: 4.0.9+
* Schedule: True


---

<a name="setup-dev-environment">
## 设置开发环境

~~~shell

// 请先 Fork 一份主存储库到自己的项目下
$ git clone <forked-steamhub-repo>

// 进入刚刚 Fork 好的存储库
$ cd <forked-steamhub-repo>

// 选择你想要进行开发的分支,我们的所有开发的增量更新都会合并到 Dev 分支,如果有其他单独功能,请切换到新分支再进行 PR.
$ git checkout <branch name>

// 安装依赖
$ composer install

// 设置本地环境连接
> 创建文件 .env
> 填写数据库,redis 账户密码,并且开启 
> APP_ENV=local
> APP_DEBUG=TRUE

// 执行迁移,迁移过程有些繁琐,我们正在解决这个问题,请查看: https://github.com/InGaming/SteamHub.RESTful/issues/7

$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed

~~~

<a name="submitting-changes-pull-requests">
## 提交指南

> {info} 提交格式应遵守 `<type>: <subject>` 或者 `<type>(scope): <subject>`

* feat: Commits that result in a new features or functionalities. Backwards 
* compatible features will release with the next MINOR whereas breaking changes will 
* be in the next MAJOR. The body of a commit with breaking changes must begin with 
* BREAKING CHANGE, followed by a description of how the API has changed.
* fix: Commits that provide fixes for bugs within vuetify's codebase.
* docs: Commits that provide updates to the docs.
* style: Commits that do not affect how the code runs, these are simply changes to formatting.
* refactor: Commits that neither fixes a bug nor adds a feature.
* perf: Commits that improve performance.
* test: Commits that add missing or correct existing tests.
* chore: Other commits that dont modify main or test files.
* revert: Commits that revert previous commits.
