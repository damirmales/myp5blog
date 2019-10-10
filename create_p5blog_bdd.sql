-- -----------------------------------------------------
-- Schema p5blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `p5blog` DEFAULT CHARACTER SET utf8 ;
USE `p5blog` ;

-- -----------------------------------------------------
-- Table `p5blog`.`Articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `p5blog`.`Articles` (
  `articles_id` INT NOT NULL,
  `titre` VARCHAR(45) NOT NULL,
  `chapo` VARCHAR(45) NULL,
  `description` VARCHAR(255) NOT NULL,
  `date` DATETIME NULL,
  `rubrique` VARCHAR(45) NULL,
  PRIMARY KEY (`articles_id`))
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `p5blog`.`Commentaires`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `p5blog`.`Commentaires` (
  `commentaire_id` INT NOT NULL,
  `contenu` VARCHAR(255) NULL,
  `date` DATETIME NULL,
  `Articles_articles_id` INT NOT NULL,
  PRIMARY KEY (`commentaire_id`, `Articles_articles_id`),
  CONSTRAINT `fk_Commentaires_Articles`
    FOREIGN KEY (`Articles_articles_id`)
    REFERENCES `p5blog`.`Articles` (`articles_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

