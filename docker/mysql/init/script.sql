GRANT SESSION_VARIABLES_ADMIN ON *.* TO 'dbuser'@'%';

FLUSH PRIVILEGES;

create database yiibase_test;

GRANT ALL PRIVILEGES ON `yiibase_test`.* TO `root`@`%`;
GRANT ALL PRIVILEGES ON `yiibase_test`.* TO `dbuser`@`%`;

