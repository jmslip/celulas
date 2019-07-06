-- MySQL Script generated by MySQL Workbench
-- sáb 06 jul 2019 20:43:58 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema smallgroups
-- -----------------------------------------------------
-- Banco de dados do sistema de celulas
DROP SCHEMA IF EXISTS `smallgroups` ;

-- -----------------------------------------------------
-- Schema smallgroups
--
-- Banco de dados do sistema de celulas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `smallgroups` DEFAULT CHARACTER SET utf8 ;
USE `smallgroups` ;

-- -----------------------------------------------------
-- Table `smallgroups`.`profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`profiles` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`profiles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL,
  `description` VARCHAR(60) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`users` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `remember_token` VARCHAR(100) NULL,
  `email_verified_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `id_profile` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_profile1_idx` (`id_profile` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_users_profile1`
    FOREIGN KEY (`id_profile`)
    REFERENCES `smallgroups`.`profiles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`people`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`people` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`people` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `lastname` VARCHAR(60) NULL,
  `birthday` DATE NULL,
  `phone` VARCHAR(45) NULL,
  `cellphone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `street` VARCHAR(100) NOT NULL,
  `number` INT NOT NULL,
  `neiborhood` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `state` CHAR(2) NOT NULL,
  `cep` CHAR(8) NULL,
  `leader` TINYINT(1) NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `id_user` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_people_users_idx` (`id_user` ASC),
  CONSTRAINT `fk_people_users`
    FOREIGN KEY (`id_user`)
    REFERENCES `smallgroups`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`small_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`small_groups` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`small_groups` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `street` VARCHAR(45) NOT NULL,
  `number` VARCHAR(45) NOT NULL,
  `neiborhood` VARCHAR(45) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `state` CHAR(2) NOT NULL,
  `cep` CHAR(8) NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`peoplexsmallgroups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`peoplexsmallgroups` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`peoplexsmallgroups` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `leader` TINYINT(1) NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `id_people` INT NOT NULL,
  `id_small_group` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_peoplexsmallgruops_people1_idx` (`id_people` ASC),
  INDEX `fk_peoplexsmallgruops_small_groups1_idx` (`id_small_group` ASC),
  CONSTRAINT `fk_peoplexsmallgruops_people1`
    FOREIGN KEY (`id_people`)
    REFERENCES `smallgroups`.`people` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_peoplexsmallgruops_small_groups1`
    FOREIGN KEY (`id_small_group`)
    REFERENCES `smallgroups`.`small_groups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`ministrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`ministrations` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`ministrations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `description` MEDIUMTEXT NOT NULL,
  `number` INT NOT NULL,
  `attachment` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`ministrationsxusers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`ministrationsxusers` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`ministrationsxusers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_ministration` INT NOT NULL,
  `id_user` INT NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ministrations_has_users_users1_idx` (`id_user` ASC),
  INDEX `fk_ministrations_has_users_ministrations1_idx` (`id_ministration` ASC),
  CONSTRAINT `fk_ministrations_has_users_ministrations1`
    FOREIGN KEY (`id_ministration`)
    REFERENCES `smallgroups`.`ministrations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ministrations_has_users_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `smallgroups`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`files` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`files` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '		',
  `name` VARCHAR(45) NOT NULL,
  `path` VARCHAR(255) NOT NULL,
  `type` VARCHAR(15) NOT NULL,
  `size` INT NOT NULL,
  `ministrations_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_file_ministrations1_idx` (`ministrations_id` ASC),
  CONSTRAINT `fk_file_ministrations1`
    FOREIGN KEY (`ministrations_id`)
    REFERENCES `smallgroups`.`ministrations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`messages` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smallgroups`.`messagesxusers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `smallgroups`.`messagesxusers` ;

CREATE TABLE IF NOT EXISTS `smallgroups`.`messagesxusers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `id_message` INT NOT NULL,
  `id_user` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_has_users_users1_idx` (`id_user` ASC),
  INDEX `fk_messages_has_users_messages1_idx` (`id_message` ASC),
  CONSTRAINT `fk_messages_has_users_messages1`
    FOREIGN KEY (`id_message`)
    REFERENCES `smallgroups`.`messages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_has_users_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `smallgroups`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
