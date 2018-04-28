
CREATE DATABASE IF NOT EXISTS golf;
USE golf;


CREATE TABLE event_types (
  event_type_id     INT          PRIMARY KEY   AUTO_INCREMENT,
  event_type_name   VARCHAR(10)  NOT NULL      UNIQUE,
  event_type_description  TEXT   NOT NULL
);
CREATE TABLE events (
  event_id          INT              PRIMARY KEY AUTO_INCREMENT,
  event_date        DATE             NOT NULL,
  event_location    VARCHAR(30)      NOT NULL,
  event_type_id     INT
);

CREATE TABLE event_attendees (
  student_id        INT              NOT NULL,
  event_id          INT              NOT NULL,
  donation_amount   DECIMAL(9,2)     NOT NULL,
  CONSTRAINT pk_event_attendees PRIMARY KEY(student_id, event_id)
);

CREATE TABLE graduates (
  student_id        INT              PRIMARY KEY AUTO_INCREMENT,
  student_name      VARCHAR(30)      NOT NULL,
  student_phone     VARCHAR(30)      NOT NULL,
  student_email     VARCHAR(30)      NOT NULL
);

CREATE TABLE degree_graduates (
  student_id        INT              NOT NULL,
  degree_id         INT              NOT NULL,
  year_optained     VARCHAR(4)       NOT NULL,
  CONSTRAINT pk_degree_graduates PRIMARY KEY(student_id, degree_id)
);

CREATE TABLE student_degrees (
  degrees_id        INT          PRIMARY KEY   AUTO_INCREMENT,
  degree_title      VARCHAR(10)  NOT NULL,
  degree_type       VARCHAR(10)  NOT NULL
);