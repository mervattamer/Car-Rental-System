USE Car_Rental_System;

INSERT INTO `office`(`office_id`, `location`) VALUES ('1','Alexandria');
INSERT INTO `office`(`office_id`, `location`) VALUES ('2','Cairo');
INSERT INTO `office`(`office_id`, `location`) VALUES ('3','Rome');
INSERT INTO `office`(`office_id`, `location`) VALUES ('4','Paris');

INSERT INTO `admin`(`email`, `password`) VALUES ('admin123@gmail.com','admin123');
INSERT INTO `admin`(`email`, `password`) VALUES ('admin_7amada@gmail.com','admin_7amada_tany');


INSERT INTO `car`(`plate_id`, `model`, `year`, `price_per_day`, `office_id`) VALUES ('123','audi a3','2022','2000.99','1');
INSERT INTO `car`(`plate_id`, `model`, `year`, `price_per_day`, `office_id`) VALUES ('124','audi a4','2022','2100.99','1');
INSERT INTO `car`(`plate_id`, `model`, `year`, `price_per_day`, `office_id`) VALUES ('125','audi a5','2022','2200.99','2');
INSERT INTO `car`(`plate_id`, `model`, `year`, `price_per_day`, `office_id`) VALUES ('126','audi r8','2022','2400.99','2');
INSERT INTO `car`(`plate_id`, `model`, `year`, `price_per_day`, `office_id`) VALUES ('127','mercedes G class','2022','3400.99','3');
INSERT INTO `car`(`plate_id`, `model`, `year`, `price_per_day`, `office_id`) VALUES ('128','merceds E class','2022','2400.99','4');


INSERT INTO `status`(`plate_id`, `status`) VALUES ('123','available');
INSERT INTO `status`(`plate_id`, `status`) VALUES ('124','available');
INSERT INTO `status`(`plate_id`, `status`) VALUES ('125','available');
INSERT INTO `status`(`plate_id`, `status`) VALUES ('126','available');
INSERT INTO `status`(`plate_id`, `status`) VALUES ('127','available');
INSERT INTO `status`(`plate_id`, `status`) VALUES ('128','available');





