CREATE DATABASE agents_db CHARACTER SET utf8 COLLATE utf8_general_ci;

use agents_db;

CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
lastname VARCHAR(100) NOT NULL,
firstname VARCHAR(100) NOT NULL,
birthdate DATE NOT NULL,
email VARCHAR(50) NOT NULL,
nationality VARCHAR(100) NOT NULL,
codeName VARCHAR(100) NOT NULL,
userType VARCHAR(100) NOT NULL,
specialities VARCHAR(255),
roles JSON NOT NULL,
password VARCHAR(255) NOT NULL,
createdAt DATE NOT NULL 
) engine=InnoDB;

CREATE TABLE speciality(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;


CREATE TABLE hideout(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
code VARCHAR(100) NOT NULL,
address TEXT(255) NOT NULL,
hideoutType VARCHAR(100) NOT NULL,
country VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE mission(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TEXT NOT NULL,
startDate DATETIME NOT NULL,
endDate DATETIME NOT NULL,
country VARCHAR(100) NOT NULL,
missionStatus VARCHAR(50) NOT NULL,
codeName VARCHAR(50) NOT NULL
) engine=InnoDB;


CREATE TABLE missionType(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;


CREATE TABLE user_speciality(
userId INT NOT NULL,
idSpeciality INT NOT NULL
) engine=InnoDB;

ALTER TABLE user_speciality ADD CONSTRAINT FK_idUser FOREIGN KEY (idUser) REFERENCES user(id);

ALTER TABLE user_speciality ADD CONSTRAINT FK_idSpeciality FOREIGN KEY (idSpeciality) REFERENCES speciality(id);


CREATE TABLE mission_speciality(
mission_Id INT NOT NULL,
id_Speciality INT NOT NULL
) engine=InnoDB;

ALTER TABLE mission_speciality ADD CONSTRAINT FK_mission_Id FOREIGN KEY (mission_Id) REFERENCES mission(id);

ALTER TABLE mission_speciality ADD CONSTRAINT FK_id_Speciality FOREIGN KEY (id_Speciality) REFERENCES speciality(id);

ALTER TABLE mission ADD CONSTRAINT FK_idMissionType FOREIGN KEY (idMissionType) REFERENCES missionType(id);

CREATE TABLE mission_hideouts(
missionId INT NOT NULL,
idHideout INT NOT NULL
) engine=InnoDB;

ALTER TABLE mission_hideouts ADD CONSTRAINT FK_missionId FOREIGN KEY (missionId) REFERENCES mission(id);

ALTER TABLE mission_hideouts ADD CONSTRAINT FK_idHideout FOREIGN KEY (idHideout) REFERENCES hideout(id);

DROP TABLE IF EXISTS user_admin ;
CREATE TABLE user_admin(
userId INT NOT NULL,
createdAt DATETIME NOT NULL
) engine=InnoDB;

CREATE TABLE user_agent(
userId INT NOT NULL,
agent_code_ident INT NOT NULL
) engine=InnoDB;


CREATE TABLE user_target(
userId INT NOT NULL,
userTarg_code_name_id INT NOT NULL
) engine=InnoDB;





DROP TABLE IF EXISTS mission_missionType;
CREATE TABLE mission_missionType(
mmt_missionId INT NOT NULL,
mmt_missionTypeId INT NOT NULL
) engine=InnoDB;

ALTER TABLE mission_missionType ADD CONSTRAINT FK_mmt_missionId FOREIGN KEY (mmt_missionId) REFERENCES mission(id);

ALTER TABLE mission_missionType ADD CONSTRAINT FK_mmt_missionTypeId FOREIGN KEY (mmt_missionTypeId) REFERENCES missionType(id);

DROP TABLE IF EXISTS mission_contacts;
CREATE TABLE mission_contacts(
mission_id INT NOT NULL,
mission_contact_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_targets(
mission_id INT NOT NULL,
mission_target_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_agents(
mA_mission_id INT NOT NULL,
agents INT NOT NULL
) engine=InnoDB;

ALTER TABLE mission ADD COLUMN idMissionType INT NOT NULL;


