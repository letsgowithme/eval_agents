CREATE DATABASE agents_db CHARACTER SET utf8 COLLATE utf8_general_ci;

USE agents_db;

CREATE TABLE person(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
lastname VARCHAR(100) NOT NULL,
firstname VARCHAR(100) NOT NULL,
birthdate DATE NOT NULL,
nationality VARCHAR(100) NOT NULL,
country VARCHAR(100) NOT NULL,
codeName VARCHAR(100) NOT NULL
UNIQUE(codeName_c)
) engine=InnoDB;

CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
roles JSON NOT NULL,
password VARCHAR(255) NOT NULL,
email VARCHAR(50) NOT NULL,
) engine=InnoDB;

CREATE TABLE agents(
id_user_agent INT NOT NULL,
specialities VARCHAR(255),
code_id VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE contacts(
id_user_contact INT NOT NULL,

) engine=InnoDB;

CREATE TABLE targets(
id_user_target INT NOT NULL,
) engine=InnoDB;

CREATE TABLE speciality(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;


CREATE TABLE hideout(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
code VARCHAR(100) NOT NULL,
address TEXT(255) NOT NULL,
city VARCHAR(100) NOT NULL,
country VARCHAR(100) NOT NULL,
hideoutType VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE mission(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT NOT NULL,
startDate DATETIME NOT NULL,
endDate DATETIME NOT NULL,
country VARCHAR(100) NOT NULL,
missionStatus ENUM('En préparation', 'En cours', 'Terminé', 'Échec') NOT NULL,
codeName VARCHAR(50) NOT NULL
) engine=InnoDB;


CREATE TABLE missionType(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;


CREATE TABLE user_speciality(
userId INT NOT NULL,
user_specialities VARCHAR(255) NOT NULL
) engine=InnoDB;

ALTER TABLE user_speciality ADD CONSTRAINT FK_userId FOREIGN KEY (userId) REFERENCES user(id);

CREATE TABLE mission_speciality(
mission_Id INT NOT NULL,
mis_spec_id INT NOT NULL
) engine=InnoDB;


ALTER TABLE mission_speciality ADD CONSTRAINT FK_mission_Id FOREIGN KEY (mission_Id) REFERENCES mission(id);

ALTER TABLE mission_speciality ADD CONSTRAINT FK_mis_spec_id FOREIGN KEY (mis_spec_id) REFERENCES speciality(id);

CREATE TABLE mission_hideouts(
missionId INT NOT NULL,
mis_hideouts VARCHAR(255) NOT NULL
) engine=InnoDB;

ALTER TABLE mission_hideouts ADD CONSTRAINT FK_missionId FOREIGN KEY (missionId) REFERENCES mission(id);


CREATE TABLE mission_agents(
ma_mission_id INT NOT NULL,
agents VARCHAR(255) NOT NULL
) engine=InnoDB;

ALTER TABLE mission_agents ADD CONSTRAINT FK_ma_mission_id FOREIGN KEY (ma_mission_id) REFERENCES mission(id);

CREATE TABLE mission_contacts(
mc_mission_id INT NOT NULL,
contacts VARCHAR(255) NOT NULL
) engine=InnoDB;

ALTER TABLE mission_contacts ADD CONSTRAINT FK_mc_mission_id FOREIGN KEY (mc_mission_id) REFERENCES mission(id);

CREATE TABLE mission_targets(
mt_mission_id INT NOT NULL,
targets VARCHAR(255) NOT NULL
) engine=InnoDB;

ALTER TABLE mission_targets ADD CONSTRAINT FK_mt_mission_id FOREIGN KEY (mt_mission_id) REFERENCES mission(id);


CREATE TABLE mission_missionType(
mmt_missionId INT NOT NULL,
mmt_missionTypeId INT NOT NULL
) engine=InnoDB;

ALTER TABLE mission_missionType ADD CONSTRAINT FK_mmt_missionId FOREIGN KEY (mmt_missionId) REFERENCES mission(id);

ALTER TABLE mission_missionType ADD CONSTRAINT FK_mmt_missionTypeId FOREIGN KEY (mmt_missionTypeId) REFERENCES missionType(id);

