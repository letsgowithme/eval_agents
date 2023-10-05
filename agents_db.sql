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
type VARCHAR(100) NOT NULL,
refuge_country_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT NOT NULL,
start_date DATETIME NOT NULL,
end_date DATETIME NOT NULL,
mission_code_name_id INT NOT NULL,
mission_country_id INT NOT NULL,
mission_type_id INT NOT NULL,
mission_agent_id INT NOT NULL,
mission_status_id INT NOT NULL,
mission_contact_id INT NOT NULL,
mission_target_id INT NOT NULL,
mission_refuge_id INT NOT NULL,
mission_speciality_id INT NOT NULL
) engine=InnoDB;


ALTER TABLE user_nationality ADD CONSTRAINT FK_user_id FOREIGN KEY (user_id) REFERENCES FK_user(id);
ALTER TABLE user_nationality ADD CONSTRAINT FK_nationality_id FOREIGN KEY (nationality_id) REFERENCES FK_nationality(id);
ALTER TABLE admin ADD CONSTRAINT FK_admin_user_id FOREIGN KEY (admin_user_id) REFERENCES FK_admin_user(id);
ALTER TABLE target ADD CONSTRAINT FK_target_code_name_id FOREIGN KEY (target_code_name_id) REFERENCES FK_target_code_name(id);
ALTER TABLE target ADD CONSTRAINT FK_target_user_id FOREIGN KEY (target_user_id) REFERENCES FK_target_user(id);
ALTER TABLE contact ADD CONSTRAINT FK_contact_code_name_id FOREIGN KEY (contact_code_name_id) REFERENCES FK_contact_code_name(id);
ALTER TABLE contact ADD CONSTRAINT FK_contact_user_id FOREIGN KEY (contact_user_id) REFERENCES FK_contact_user(id);

ALTER TABLE agent ADD CONSTRAINT FK_agent_user_id FOREIGN KEY (agent_user_id) REFERENCES FK_agent_user(id);

ALTER TABLE refuge ADD CONSTRAINT FK_refuge_country_id FOREIGN KEY (refuge_country_id) REFERENCES FK_refuge_country(id);
ALTER TABLE mission ADD CONSTRAINT FK_mission_code_name_id FOREIGN KEY (mission_code_name_id) REFERENCES FK_mission_code_name(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE mission ADD CONSTRAINT FK_mission_country_id FOREIGN KEY (mission_country_id) REFERENCES FK_mission_country(id);

ALTER TABLE mission ADD CONSTRAINT FK_mission_type_id FOREIGN KEY (mission_type_id) REFERENCES FK_mission_type(id);
ALTER TABLE mission ADD CONSTRAINT FK_mission_agent_id FOREIGN KEY (mission_agent_id) REFERENCES FK_mission_agent(id);
ALTER TABLE mission ADD CONSTRAINT FK_mission_status_id FOREIGN KEY (mission_status_id) REFERENCES FK_mission_status(id);
ALTER TABLE mission ADD CONSTRAINT FK_mission_contact_id FOREIGN KEY (mission_contact_id) REFERENCES FK_mission_contact(id);

ALTER TABLE mission ADD CONSTRAINT FK_mission_target_id FOREIGN KEY (mission_target_id) REFERENCES FK_mission_target(id);
ALTER TABLE mission ADD CONSTRAINT FK_mission_refuge_id FOREIGN KEY (mission_refuge_id) REFERENCES FK_mission_refuge(id);
ALTER TABLE mission ADD CONSTRAINT FK_mission_speciality_id FOREIGN KEY (mission_speciality_id) REFERENCES FK_mission_speciality(id);






















