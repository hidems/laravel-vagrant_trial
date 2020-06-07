create table IF not exists posts (
  id int not null auto_increment primary key,
  slug varchar(255) unique,
  body text
) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

insert into posts (slug, body) values ('my-first-post', 'hello, this is my first post.');