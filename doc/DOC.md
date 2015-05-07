#CloudDisk
>这是我的毕业设计，基于php的在线存储系统，类似于百度网盘的一种东西。

##软件方案:LNMP
```mermaid
graph TD;
Client-->Nginx;
Nginx-->PHP;

```
###Linux
1.简介
2.安装
3.配置
4.测试
###Nginx
1.简介
2.安装
3.配置
4.测试
###MySql
1.简介
2.安装
3.配置
4.测试

~~~sql

create table users(
	id int primary key not null auto_increment,
    username char(20) not null,
    password char(32) not null,
    email char(50),
    text varchar(50),
    size_used bigint default 0,
    size_max bigint default 20000000000,
    level int default 0
    );
+-----------+-------------+------+-----+-------------+----------------+
| Field     | Type        | Null | Key | Default     | Extra          |
+-----------+-------------+------+-----+-------------+----------------+
| id        | int(11)     | NO   | PRI | NULL        | auto_increment |
| username  | char(20)    | NO   |     | NULL        |                |
| password  | char(32)    | NO   |     | NULL        |                |
| email     | char(50)    | YES  |     | NULL        |                |
| text      | varchar(50) | YES  |     | NULL        |                |
| size_used | bigint(20)  | YES  |     | 0           |                |
| size_max  | bigint(20)  | YES  |     | 20000000000 |                |
| level     | int(11)     | YES  |     | 0           |                |
+-----------+-------------+------+-----+-------------+----------------+

create table files(
	id int primary key not null auto_increment,
	user_id int not null,
	filename char(50) not null,
	filetype char(50),
	uploadtime datetime,
	modifytime datetime,
	path char(128) not null,
	foreign key (user_id) references users(id)
	);
+------------+-----------+------+-----+---------+----------------+
| Field      | Type      | Null | Key | Default | Extra          |
+------------+-----------+------+-----+---------+----------------+
| id         | int(11)   | NO   | PRI | NULL    | auto_increment |
| user_id    | int(11)   | NO   | MUL | NULL    |                |
| filename   | char(50)  | NO   |     | NULL    |                |
| filetype   | char(50)  | YES  |     | NULL    |                |
| uploadtime | datetime  | YES  |     | NULL    |                |
| modifytime | datetime  | YES  |     | NULL    |                |
| path       | char(128) | NO   |     | NULL    |                |
| size       | int(11)   | YES  |     | NULL    |                |
+------------+-----------+------+-----+---------+----------------+

delimiter $
create trigger file_added
after insert on files
for each row
begin
	update users set size_used=size_used+new.size where id=new.user_id;
end$


delimiter $
create trigger file_deleted
after delete on files
for each row
begin
	update users set size_used=size_used-old.size where id=old.user_id;
end$

~~~
###PHP
1.简介
2.安装
3.配置
4.测试

##软件实现:MVC

- ####MVC
- ####PHPixie
