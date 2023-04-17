CREATE DATABASE traincker;
​

CREATE TABLE `station` (
  `id` int UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL);
  
  CREATE TABLE `train` (
  `id` int UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  `departure` varchar(255) NOT NULL,
  `arrival` varchar(255) NOT NULL
  );
  
  
  
  CREATE TABLE `transit` (
  `id` int UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `station_id` int NOT NULL,
  `train_id` int NOT NULL,
  `time` time NOT NULL DEFAULT '00:00:00');