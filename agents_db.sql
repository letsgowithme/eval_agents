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
nationality_id INT NOT NULL,
FOREIGN KEY (nationality_id) REFERENCES nationality(id)
) engine=InnoDB;

CREATE TABLE code_name(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE admin(
user_id INT NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL,
createdAt DATETIME NOT NULL,
FOREIGN KEY (user_id) REFERENCES user(id)
) engine=InnoDB;

CREATE TABLE target(
user_id INT NOT NULL,
code_name_id INT NOT NULL,
FOREIGN KEY(code_name_id) REFERENCES code_name(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
) engine=InnoDB;

CREATE TABLE contact(
user_id INT NOT NULL,
code_name_id INT NOT NULL,
FOREIGN KEY(code_name_id) REFERENCES code_name(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
) engine=InnoDB;

CREATE TABLE speciality(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE agent(
user_id INT NOT NULL,
code_ident INT NOT NULL,
FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
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
type VARCHAR(100) NOT NULL,
country_id INT NOT NULL,
FOREIGN KEY (country_id) REFERENCES country(id)
) engine=InnoDB;

CREATE TABLE mission(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT NOT NULL,
start_date DATETIME NOT NULL,
end_date DATETIME NOT NULL,
code_name_id INT NOT NULL,
country_id INT NOT NULL,
mission_type_id INT NOT NULL,
agent_id INT NOT NULL,
status_id INT NOT NULL,
contact_id INT NOT NULL,
target_id INT NOT NULL,
refuge_id INT NOT NULL,
speciality_id INT NOT NULL,
FOREIGN KEY(code_name_id) REFERENCES code_name(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(country_id) REFERENCES country(id),
FOREIGN KEY(mission_type_id) REFERENCES mission_type(id),
FOREIGN KEY(agent_id) REFERENCES agent(user_id),
FOREIGN KEY(status_id) REFERENCES status(id),
FOREIGN KEY(contact_id) REFERENCES contact(user_id),
FOREIGN KEY(target_id) REFERENCES target(user_id),
FOREIGN KEY(refuge_id) REFERENCES refuge(id),
FOREIGN KEY(speciality_id) REFERENCES speciality(id)
) engine=InnoDB;






























