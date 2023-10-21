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

CREATE TABLE user_speciality(
idUser INT NOT NULL,
idSpeciality INT NOT NULL
) engine=InnoDB;



CREATE TABLE user_admin(
admin_user_id INT NOT NULL,
createdAt DATETIME NOT NULL
) engine=InnoDB;

CREATE TABLE user_agent(
userAg_user_id INT NOT NULL,
agent_code_ident INT NOT NULL
) engine=InnoDB;

CREATE TABLE user_target(
userTarg_user_id INT NOT NULL,
userTarg_code_name_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE user_contact(
userCont_user_id INT NOT NULL,
userCont_code_name_id INT NOT NULL
) engine=InnoDB;



CREATE TABLE missionType(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL
) engine=InnoDB;

CREATE TABLE hideout(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
hideoutCode VARCHAR(100) NOT NULL,
hideoutAddress TEXT(255) NOT NULL,
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

CREATE TABLE mission_agents(
mA_mission_id INT NOT NULL,
agents INT NOT NULL
) engine=InnoDB;


CREATE TABLE mission_mType(
missionType_mission_id INT NOT NULL,
missionType_mType_id INT NOT NULL
) engine=InnoDB;


CREATE TABLE mission_contacts(
mission_id INT NOT NULL,
mission_contact_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_targets(
mission_id INT NOT NULL,
mission_target_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_hideouts(
mission_hideout_id INT NOT NULL
) engine=InnoDB;

CREATE TABLE mission_specialities(
mission_speciality_id INT NOT NULL
) engine=InnoDB;





