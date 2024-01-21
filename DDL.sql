CREATE DATABASE Car_Rental_System;

USE Car_Rental_System;

CREATE Table car(
    plate_id int(20) PRIMARY key,
    model VARCHAR(100),
    `year` int(20),
    price_per_day float(10),
    office_id int(20)
);

CREATE Table reservation(
    Reserve_id int(20) PRIMARY key AUTO_INCREMENT,
    plate_id int(20),
    SSN int(20),
    reserve_date DATE,
    pickup_date DATE,
    return_date DATE,
    amount_left float(10)
);

CREATE Table office(
    office_id int(20) PRIMARY KEY,
    `location` VARCHAR(100)
);

CREATE Table `status`(
    plate_id int(20),
    `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `status` VARCHAR(100),
    PRIMARY KEY(plate_id,`time`)
);

CREATE TABLE `user`(
    SSN int(20) PRIMARY KEY,
    email VARCHAR(100),
    `password` VARCHAR(100),
    phone VARCHAR(11),
    fname VARCHAR(20),
    lname VARCHAR(20),
    balance float(10),
    UNIQUE(email),
    UNIQUE(phone)
);

CREATE table payments(
    `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    SSN int(20),
    amount float(10),
    PRIMARY KEY(`time`,SSN)
);

CREATE TABLE `admin`(
    email VARCHAR(100) PRIMARY KEY,
    `password` VARCHAR(100)
);

ALTER Table car
ADD FOREIGN KEY (office_id) REFERENCES office(office_id);

ALTER Table reservation
ADD FOREIGN KEY (plate_id) REFERENCES car(plate_id);

ALTER Table reservation
ADD FOREIGN KEY (SSN) REFERENCES `user`(SSN);

ALTER Table `status`
ADD FOREIGN KEY (plate_id) REFERENCES car(plate_id);

ALTER Table payments
ADD FOREIGN KEY (SSN) REFERENCES `user`(SSN);
