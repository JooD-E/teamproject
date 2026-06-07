create table board(
   num int not null auto_increment,
   id varchar(30) not null,
   name  varchar(20) not null,
   subject varchar(100) not null,
   content text not null,
   regist_day varchar(20),
   hit int,
   is_html varchar(1),
   file_name varchar(100),
   primary key(num)
)engine=innoDB charset=utf8;