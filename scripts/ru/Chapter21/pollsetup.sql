create database poll;

use poll;

create table poll_results (
  id int not null primary key auto_increment, 
  candidate varchar(30),
  num_votes int
);

insert into poll_results (candidate, num_votes) values
  ('Илья Муромец', 0),
  ('Добрыня Никитич', 0),
  ('Алеша Попович', 0)
;

grant all privileges
on poll.*
to poll@localhost
identified by 'poll';