create table member(
id varchar(30)  not null,
pass varchar(100) not null,
name varchar(20) not null,
hp varchar(20),
addr varchar(80),
email varchar(100),
primary key(id)
)engine=innoDB charset=utf8;