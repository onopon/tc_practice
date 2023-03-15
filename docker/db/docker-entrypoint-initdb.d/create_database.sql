CREATE DATABASE IF NOT EXISTS tc_practice;
CREATE DATABASE IF NOT EXISTS tc_practice_testing;
GRANT ALL ON tc_practice.* TO 'tc_user'@'%' WITH GRANT OPTION;
GRANT ALL ON tc_practice_testing.* TO 'tc_user'@'%' WITH GRANT OPTION;
