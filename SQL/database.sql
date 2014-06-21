-- Create a database before importing this

-- Users table for logins and registers
CREATE TABLE users
(
	ID int auto_increment,
	Username varchar(15) not null,
	Password varchar(50) not null,
	Picture varchar(500) not null,
	IP varchar(15) not null,
	PRIMARY KEY(ID)
) ENGINE = INNODB;
-- Cakes/Texts for posting includes user referencing
CREATE TABLE cakes
(
	ID int auto_increment,
	Name nvarchar(100) not null,
	contents text not null,
	CakeDate date not null,
	userID int not null,
	syntax varchar(50) default null,
	PRIMARY KEY(ID),
	FOREIGN KEY (userID)
    REFERENCES users(ID)
) ENGINE = INNODB;
