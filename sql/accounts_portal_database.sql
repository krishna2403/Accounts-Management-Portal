DROP DATABASE IF EXISTS accounts_management;
CREATE DATABASE accounts_management;
USE accounts_management;

CREATE TABLE Employee (
	employeeID int NOT NULL AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    employeeName varchar(100) AS (CONCAT_WS(' ', firstName, lastName)),
    dateOfJoin date,
    loan decimal(4, 2),
    housing varchar(10),
    accountNumber int NOT NULL,
    ifscCode varchar(11),
    password varchar(30),
    brach varchar(50),
    PRIMARY KEY(employeeID)
);

CREATE TABLE admins (
    adminID int NOT NULL UNIQUE AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    adminName varchar(100) AS (CONCAT_WS(' ', firstName, lastName)),
    adminEmail varchar(100),
    adminPWD varchar(100),
    PRIMARY KEY(adminID)
);

CREATE TABLE designation (
    desName varchar(40) NOT NULL UNIQUE,
	basicPay int,
    PRIMARY KEY(desName)
);

CREATE TABLE transactions (
	transactionID varchar(40) NOT NULL,
    modeOfTransaction varchar(30),
    salSlipNo int,
    eID int,
    FOREIGN KEY(eID) REFERENCES employee(employeeID),
    PRIMARY KEY(transactionID)
);

CREATE TABLE attendance (
	eID int NOT NULL UNIQUE,
    month int,
    year int,
    presentDays int,
    absentDays int,
    FOREIGN KEY(eID) REFERENCES employee(employeeID)
);