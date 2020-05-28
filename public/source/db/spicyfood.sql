-- Create table user --

CREATE TABLE user (
	id BIGINT(20) PRIMARY KEY,
	user_login VARCHAR(60),
	user_pass VARCHAR(255),
	user_name VARCHAR(50),
	user_email VARCHAR(100),
	user_url VARCHAR(100),
	user_registered DATETIME,
	user_status INT(11)
)

-- Create table taxamony
CREATE TABLE taxamonies(
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(200),
	slug VARCHAR(200),
	description LONGTEXT,
	img_thumbnail VARCHAR(255),
	has_child INT(11),
	parent_id BIGINT(20)
)

CREATE TABLE post_tags(
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT, 
	title VARCHAR(200),
	slug VARCHAR(255),
	description LONGTEXT
)

CREATE TABLE categories(
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(200),
	slug VARCHAR(255),
	description LONGTEXT,
	img_thumbnail VARCHAR(255),
	has_child INT(11),
	parent_id BIGINT(20)
)

CREATE TABLE incredents(
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
	incredent_name VARCHAR(200),
	incredent_slug VARCHAR(255)
)
spicyfoodcategories