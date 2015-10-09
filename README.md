# Login_1DV608
Interface repository for 1DV608 assignment 2 and 4

0. Download the repository

1. Create a new database.

2. enter the following sql command to create the table:

CREATE TABLE `member` (
  `Username` varchar(40) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Password` varchar(40) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

3. Enter the hostname, databasename, username and password in Settings.php.

4. Run the application on your webserver 


