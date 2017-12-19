drop table if exists Region;
drop table if exists Element;
drop table if exists Series;
drop table if exists Study;
drop table if exists Request;
drop table if exists Wears;
drop table if exists Period;
drop table if exists Reading;
drop table if exists Sensor;
drop table if exists Device;
drop table if exists Doctor;
drop table if exists Patient;

create table Patient(
	number integer,
	name varchar(255),
	birthday date,
	address varchar(255),
	primary key(number)
);

insert into Patient values
(3, 'Snaff',  '2001-01-15', 'Smeckle Lane 3'),
(4, 'Gurdel',  '2015-01-15', 'Swing Road 46'),
(5, 'Ajax',  '2301-01-15', 'Portugal 7'),
(6, 'Jif',  '1945-01-15', 'Açores A'),
(7, 'Kik',  '2301-01-15', 'Portugal 7'),
(15, 'Matt',  '2001-01-15', 'Smeckle Lane -1'),
(11, 'Mott',  '2001-01-15', 'Smeckle Lane -2'),
(10, 'Mitt',  '2001-01-15', 'Smeckle Lane 3'),
(1, 'Joaoo',  '2015-01-15', 'Swing Road 46'),
(8, 'Sina',  '2301-01-15', 'Portugal 7'),
(2, 'Jone',  '1945-01-15', 'Açores A');


create table Doctor(
	number integer,
	doctor_id integer,
	primary key(doctor_id),
	foreign key(number)references Patient(number)
);
insert into Doctor values
(3, 2),
(1, 1),
(5, 3),
(11, 4);

create table Device(
	serialnum varchar(255),
	manufacturer varchar(255),
	model varchar(255),
	primary key(serialnum, manufacturer)
);
insert into Device values
('Ma12', 'MattCorp',  'A7F'),
('Mo20', 'MottCorp',  'A8F'),
('Mo21', 'MottCorp',  'A7F'),
('Mo22', 'MottCorp',  'A7F'),
('Mo36', 'MottCorp',  'MMMM'),
('Mi1', 'MittCorp',  'fda'),
('B12', 'Bosch',  '346'),
('df34', 'Heineken',  'PilsnerTron'),
('B34', 'Bosch',  '346'),
('B33', 'Bosch',  '132'),
('B32', 'Bosch',  '756'),
('Bk46', 'Bock',  'X32'),
('b57', 'Ding',  'abc123'),
('Medi1', 'Medtronic',  'MX1'),
('Medi2', 'Medtronic',  'MX1'),
('Medi3', 'Medtronic',  'MX2'),
('Medi4', 'Medtronic',  'MX1'),
('Medi5', 'Medtronic',  'MX1');
insert into Device values('Medi7', 'Medtronic', 'MX2');
insert into Device values('Medi6', 'Medtronic', 'MX2');

create table Sensor(
	serialnum varchar(255),
	manufacturer varchar(255),
	units varchar(255),
	primary key(serialnum, manufacturer),
	foreign key(serialnum, manufacturer) references Device(serialnum, manufacturer)
);
insert into Sensor values
('Medi1', 'Medtronic',  'MX1'),
('Medi2', 'Medtronic',  'MX1'),
('Medi3', 'Medtronic',  'MX2'),
('Medi4', 'Medtronic',  'MX1'),
('Medi5', 'Medtronic',  'MX1'),
('Medi6', 'Medtronic',  'MX2'),
('Medi7', 'Medtronic',  'MX2'),
('Ma12', 'MattCorp',  'Kg'),
('Mo20', 'MottCorp',  'LDL cholesterol in mg/dL'),
('Mo36', 'MottCorp',  'LDL cholesterol in mg/dL'),
('Mo21', 'MottCorp',  'LDL cholesterol in mg/dL'),
('Mo22', 'MottCorp',  'LDL cholesterol in mg/dL'),
('B12', 'Bosch',  'rpm'),
('df34', 'Heineken',  'alc%'),
('B34', 'Bosch',  'rpm'),
('Bk46', 'Bock',  'km'),
('Mi1', 'MittCorp',  'Pa'),
('b57', 'Ding',  'C'),
('B33', 'Bosch',  'rpm'),
('B32', 'Bosch',  'rpm');

create table Reading(
	serialnum varchar(255),
	manufacturer varchar(255),
	datetime timestamp,
	value float,
	primary key(serialnum, manufacturer,datetime),
	foreign key(serialnum,manufacturer) references Sensor(serialnum,manufacturer)
);
insert into Reading values
('Ma12', 'MattCorp',  '2001-01-15 12:03:24 UTC', 12.3),
('Ma12', 'MattCorp',  '2001-01-15 12:03:28 UTC', 12.7),
('Ma12', 'MattCorp',  '2001-01-15 12:03:32 UTC', 13.6),
('Ma12', 'MattCorp',  '2001-01-15 12:03:36 UTC', 11234.1),
('Ma12', 'MattCorp',  '2001-01-15 12:03:40 UTC', 12.3),
('Mo20', 'MottCorp',  '2001-02-15 18:23:01 UTC', 2.0),
('Mo20', 'MottCorp',  '2017-11-01 18:23:01 UTC', 201.0),
('Mo20', 'MottCorp',  '2017-11-01 18:27:02 UTC', 253.0),
('Mo21', 'MottCorp',  '2017-10-01 18:22:03 UTC', 234.0),
('Mo21', 'MottCorp',  '2017-10-01 18:22:04 UTC', 234.0),
('Mo21', 'MottCorp',  '2017-19-01 18:17:05 UTC', 234.0),
('Mo21', 'MottCorp',  '2017-11-01 18:18:06 UTC', 234.0),
('Mo21', 'MottCorp',  '2017-05-01 18:19:07 UTC', 103.0),
('Mo22', 'MottCorp',  '2017-05-01 18:20:08 UTC', 145.0),
('Mo22', 'MottCorp',  '2017-06-01 18:21:09 UTC', 1354.0),
('Mo20', 'MottCorp',  '2017-03-01 18:22:01 UTC', 115.0),
('Mo36', 'MottCorp',  '2017-10-01 18:23:03 UTC', 22.0),
('Mo36', 'MottCorp',  '2017-07-01 18:24:04 UTC', 134.0),
('Mi1', 'MittCorp',  '2001-01-15 10:02:02 UTC', 12.3),
('Mo36', 'MottCorp',  '2001-01-15 18:24:04 UTC', 12.3),
('B12', 'Bosch',  '2001-01-15 18:24:04 UTC', 12.3),
('df34', 'Heineken',  '2001-01-15 18:24:04 UTC', 12.3),
('B34', 'Bosch',  '1995-06-30 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-07-20 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-08-20 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-09-20 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-10-20 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-11-20 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-12-20 12:03:40 UTC', 100.0),
('B34', 'Bosch',  '1995-12-24 12:03:40 UTC', 100.0);


create table Period(
	start timestamp,
	end timestamp,
	primary key(start, end)
);
insert into Period values
('1995-06-30 00:00:00 UTC','1999-06-30 00:00:00 UTC'),
('1995-06-30 00:00:00 UTC','2007-02-03 00:00:00 UTC'),
('1980-06-30 00:00:00 UTC','2000-01-01 00:00:00 UTC'),
('1999-06-01 00:00:00 UTC','2000-07-01 00:00:00 UTC'),
('2016-10-01 00:00:00 UTC','2018-10-02 00:00:00 UTC'),
('2016-10-01 00:00:00 UTC','2018-10-03 00:00:00 UTC'),
('2016-10-01 00:00:00 UTC','2018-10-04 00:00:00 UTC'),
('2016-10-01 00:00:00 UTC','2018-10-05 00:00:00 UTC'),
('2016-10-01 00:00:00 UTC','2018-10-06 00:00:00 UTC'),
('2001-06-30 00:00:00 UTC','2001-07-22 00:00:00 UTC');


create table Wears(
	start timestamp,
	end timestamp,
	patient integer,
	serialnum varchar(255),
	manufacturer varchar(255),
	primary key(start, end, patient),
	foreign key(start, end) references Period(start, end),
	foreign key(patient) references Patient(number),
	foreign key(serialnum, manufacturer) references Sensor(serialnum, manufacturer)
);

insert into Wears values('2016-10-01 00:00:00 UTC','2018-10-05 00:00:00 UTC',4,'Medi4', 'Medtronic');
insert into Wears values('2016-10-01 00:00:00 UTC','2018-10-06 00:00:00 UTC',5,'Medi5', 'Medtronic');
insert into Wears values('2001-06-30 00:00:00 UTC','2001-07-22 00:00:00 UTC',10,'Mi1', 'MittCorp');
insert into Wears values('1980-06-30 00:00:00 UTC','2000-01-01 00:00:00 UTC',15,'B12', 'Bosch');
insert into Wears values('1999-06-01 00:00:00 UTC','2000-07-01 00:00:00 UTC',1,'df34', 'Heineken');
insert into Wears values('1995-06-30 00:00:00 UTC','1999-06-30 00:00:00 UTC', 10, 'B34', 'Bosch');
insert into Wears values('1995-06-30 00:00:00 UTC','2007-02-03 00:00:00 UTC',11,'Mo20', 'MottCorp');
insert into Wears values('2016-10-01 00:00:00 UTC','2018-10-02 00:00:00 UTC',1,'Medi1', 'Medtronic');
insert into Wears values('2016-10-01 00:00:00 UTC','2018-10-03 00:00:00 UTC',2,'Medi2', 'Medtronic');
insert into Wears values('2016-10-01 00:00:00 UTC','2018-10-04 00:00:00 UTC',3,'Medi3', 'Medtronic');


create table Request(
	request_number integer,
	patient_id integer,
	requesting_doctor_id integer,
	date date,
	primary key(request_number),
	foreign key(patient_id)references Patient(number),
	foreign key(requesting_doctor_id)references Doctor(doctor_id)
);
insert into Request values
(1,10,2,'2016-01-05'),
(2,11,2,'2016-03-02'),
(3,1,1,'2016-08-01'),
(4,10,3,'2016-01-25'),
(5,10,3,'2016-01-26'),
(6,2,1,'2016-01-26');

create table Study(
	request_number integer,
	description varchar(255),
	date date,
	performing_doctor_id integer,
	serialnum varchar(255),
	manufacturer varchar(255),
	primary key(request_number, description),
	foreign key(request_number)references Request(request_number),
	foreign key(performing_doctor_id)references Doctor(doctor_id),
	foreign key(serialnum,manufacturer) references Device(serialnum,manufacturer)
);
insert into Study values
(1,'Nothing important','2017-02-05',2,'Medi1','Medtronic'),
(2, 'Radiography1','2017-02-05',1,'Medi2','Medtronic'),
(2, 'Radiography2','2017-02-05',1,'Medi3','Medtronic'),
(2, 'Radiography3','2017-02-05',1,'Medi4','Medtronic'),
(2, 'Radiography4','2014-03-05',3, 'Medi5','Medtronic'),
(2, 'Radiography5','2017-02-05',1,'Medi1','Medtronic'),
(6, 'RadiographyS1','2017-02-05',2,'Medi2','Medtronic'),
(6, 'RadiographyS2','2017-02-05',2,'Medi3','Medtronic'),
(6, 'RadiographyS3','2017-02-05',2,'Medi4','Medtronic'),
(6, 'RadiographyS4','2017-03-05',3, 'Medi5','Medtronic'),
(6, 'RadiographyS5','2017-02-05',2,'Medi1','Medtronic'),
(3, 'Xray','2016-06-05',3, 'Mi1', 'MittCorp'),
(4, 'Bone Breaking','2016-09-05',4, 'df34', 'Heineken');

create table Series(
	series_id integer,
	name varchar(255),
	base_url varchar(255),
	request_number integer,
	description varchar(255),
	primary key(series_id),
	foreign key(request_number,description) references Study(request_number,description)
);
insert into Series values
(100,'Radio11', 'https://www.medibase.com/data/radio11', 2, 'Radiography1'),
(101,'Radio12', 'https://www.medibase.com/data/radio12', 2, 'Radiography1'),
(102,'Radio13', 'https://www.medibase.com/data/radio13', 2, 'Radiography1'),
(103,'Radio14', 'https://www.medibase.com/data/radio14', 2, 'Radiography1'),
(104,'Radio15', 'https://www.medibase.com/data/radio15', 2, 'Radiography1'),
(200, 'Nada1','https://www.medibase.com/data/nada1', 1, 'Nothing important'),
(300, 'Xray1','https://www.medibase.com/data/xray1', 3, 'Xray'),
(400, 'bb','https://www.medibase.com/data/bones', 4, 'Bone Breaking');

create table Element(
	series_id integer,
	elem_index integer,
	primary key(series_id, elem_index),
	foreign key(series_id)references Series(series_id)
);
insert into Element values
(100, 0),
(100, 1),
(100, 2),
(100, 3),
(101, 0),
(101, 1),
(102, 0),
(103, 0),
(103, 1),
(103, 2),
(104, 0),
(200, 0),
(300, 0),
(400, 0);

create table Region(
	series_id integer,
	elem_index integer,
	x1 float,
	x2 float,
	y1 float,
	y2 float,
	primary key(series_id, elem_index, x1, x2, y1, y2 ),
	foreign key(series_id,elem_index) references Element(series_id, elem_index)
);

insert into Region values(100,0, 0.0,0.2, 0.0,1.0);
insert into Region values(100,3, 0.1,0.3, 0.3,0.4);
insert into Region values(102,0, 0.0,1.0, 0.2,1.0);
insert into Region values(103,1, 0.0,1.0, 0.1,0.3);
insert into Region values(103,2, 0.3,0.4, 0.0,0.3);
insert into Region values(104,0, 0.3,0.4, 0.0,0.2);
insert into Region values(400,0, 0.0,1.0, 0.0,1.0);

# Question 3)
select distinct p.number, p.name 
from Patient as p, Device as d, Sensor as s, Reading as r, Wears as w
where s.units = 'LDL cholesterol in mg/dL'
and r.value > 200.0
and w.patient = p.number
and w.serialnum = s.serialnum
and s.serialnum = r.serialnum
and s.manufacturer = r.manufacturer;

# Question 4)
SELECT p.name, count
FROM Patient AS p, Request AS r, Study AS s, 
(SELECT count(distinct serialnum) AS count 
FROM Device 
WHERE manufacturer = "Medtronic") AS dcount 
WHERE r.request_number = s.request_number 
AND YEAR(s.date) = YEAR(NOW()) 
AND manufacturer = "Medtronic" 
AND p.number = r.patient_id 
GROUP BY patient_id  
HAVING count(distinct s.serialnum) = count;

# Question 5i)
drop trigger if exists check_prescribing_doctor;

delimiter $$

create trigger check_prescribing_doctor before insert on Study
for each row
begin
declare requesting_doctor int;
select distinct r.requesting_doctor_id from Request as r where r.request_number = new.request_number into requesting_doctor;
if (requesting_doctor = new.performing_doctor_id) then
signal sqlstate '45000' SET MESSAGE_TEXT = 'Requesting doctor is the same as the performing doctor.';
end if;
end$$

delimiter ;

# Question 5ii)
drop trigger if exists check_overlapping_periods;
delimiter $$

create trigger check_overlapping_periods before insert on Wears
for each row
begin
if exists (select * from Wears
             where new.serialnum = Wears.serialnum
             and Wears.start <= new.end
             and Wears.end >= new.start) then
   signal sqlstate '45000' SET MESSAGE_TEXT = 'Overlaps with existing period.';
end if;
end$$

delimiter ;


# Question 6)
drop function if exists region_overlaps_element;

delimiter $$

create function region_overlaps_element(series_id int, i int, x1 float, y1 float, x2 float, y2 float) 
returns bool 
begin 
declare rx1, rx2, ry1, ry2 float;
SELECT r.x1, r.x2, r.y1, r.y2 INTO rx1, rx2, ry1, ry2
FROM Region as r 
WHERE r.series_id = series_id
AND r.elem_index = i; 
if ((x1 BETWEEN rx1 AND rx2) OR (x1 BETWEEN rx2 AND rx1))
AND ((y1 BETWEEN ry1 AND ry2) OR (y1 BETWEEN ry2 AND ry1)) THEN
	return 1;
end if;
if ((x2 BETWEEN rx1 AND rx2) OR (x2 BETWEEN rx2 AND rx1))
AND ((y2 BETWEEN ry1 AND ry2) OR (y2 BETWEEN ry2 AND ry1)) THEN
	return 1;
end if;
return 0; 

end$$

delimiter ;
