-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema greta
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema greta
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `greta` DEFAULT CHARACTER SET utf8mb4 ;
USE `greta` ;

-- -----------------------------------------------------
-- Table `greta`.`enseignants`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`enseignants` (
  `code_p` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom_p` VARCHAR(45) NULL,
  `grade` TINYINT NULL DEFAULT 0,
  `embauche` DATE NULL,
  PRIMARY KEY (`code_p`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`matieres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`matieres` (
  `code_m` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom_m` VARCHAR(45) NOT NULL,
  `coeff` TINYINT NULL DEFAULT 1,
  `code_p` SMALLINT NOT NULL,
  PRIMARY KEY (`code_m`),
  INDEX `fk_matieres_enseignants_idx` (`code_p` ASC) VISIBLE,
  CONSTRAINT `fk_matieres_enseignants`
    FOREIGN KEY (`code_p`)
    REFERENCES `greta`.`enseignants` (`code_p`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'enseignants_code_p';


-- -----------------------------------------------------
-- Table `greta`.`etudiants`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`etudiants` (
  `code_e` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom_e` VARCHAR(45) NOT NULL,
  `ddn` DATE NULL,
  `sexe` CHAR(1) NULL,
  PRIMARY KEY (`code_e`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`etudie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`etudie` (
  `code_e` SMALLINT NOT NULL,
  `matieres_code_m` SMALLINT NOT NULL,
  PRIMARY KEY (`code_e`, `matieres_code_m`),
  INDEX `fk_etudiants_has_matieres_matieres1_idx` (`matieres_code_m` ASC) VISIBLE,
  INDEX `fk_etudiants_has_matieres_etudiants1_idx` (`code_e` ASC) VISIBLE,
  CONSTRAINT `fk_etudiants_has_matieres_etudiants1`
    FOREIGN KEY (`code_e`)
    REFERENCES `greta`.`etudiants` (`code_e`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_etudiants_has_matieres_matieres1`
    FOREIGN KEY (`matieres_code_m`)
    REFERENCES `greta`.`matieres` (`code_m`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
