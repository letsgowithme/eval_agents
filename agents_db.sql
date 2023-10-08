CREATE DATABASE agents_db CHARACTER SET utf8 COLLATE utf8_general_ci;

use agents_db;

CREATE TABLE nationality(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
lastname VARCHAR(100) NOT NULL,
firstname VARCHAR(100) NOT NULL,
birthdate DATE NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL,
roles JSON NOT NULL
) engine=InnoDB;

CREATE TABLE user_nationality(
user_id INT NOT NULL,
nationality_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE code_name(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE admin(
admin_user_id INT NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL,
createdAt DATETIME NOT NULL
) engine=InnoDB;

CREATE TABLE user_admin(
admin_user_id INT NOT NULL
) engine=InnoDB;


CREATE TABLE target(
target_user_id INT NOT NULL,
target_code_name_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE contact(
contact_user_id INT NOT NULL,
contact_code_name_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE speciality(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE agent(
agent_user_id INT NOT NULL,
agent_code_ident INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_type(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE status(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE country(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE refuge(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
code INT NOT NULL,
address TEXT NOT NULL,
type VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE refuge_country(
refuge_country_id INT NOT NULL
) engine=InnoDB;


CREATE TABLE mission(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT NOT NULL,
start_date DATETIME NOT NULL,
end_date DATETIME NOT NULL,
) engine=InnoDB;

CREATE TABLE mission_code_name(
mission_code_name_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_country(
mission_country_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_type(
mission_type_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_agent(
mission_agent_id INT NOT NULL
) engine=InnoDB;


CREATE TABLE mission_status(
mission_status_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_contact(
mission_contact_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_target(
mission_target_id INT NOT NULL
) engine=InnoDB;


CREATE TABLE mission_refuge(
mission_refuge_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_speciality(
mission_speciality_id INT NOT NULL
) engine=InnoDB;

