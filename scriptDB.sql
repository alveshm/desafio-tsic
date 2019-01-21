-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema desafio_tsic
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `desafio_tsic` ;

-- -----------------------------------------------------
-- Schema desafio_tsic
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `desafio_tsic` DEFAULT CHARACTER SET latin1 ;
USE `desafio_tsic` ;

-- -----------------------------------------------------
-- Table `desafio_tsic`.`documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desafio_tsic`.`documentos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `docu_tota` INT(11) NOT NULL,
  `docu_conf` ENUM('S', 'N') NOT NULL DEFAULT 'N',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `desafio_tsic`.`items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desafio_tsic`.`items` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_docu` INT(10) UNSIGNED NOT NULL,
  `item_prod` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `items_item_docu_foreign` (`item_docu` ASC) VISIBLE,
  INDEX `items_item_prod_foreign` (`item_prod` ASC) VISIBLE)
ENGINE = MyISAM
AUTO_INCREMENT = 197
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `desafio_tsic`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desafio_tsic`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 69
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `desafio_tsic`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desafio_tsic`.`password_resets` (
  `email` VARCHAR(191) NOT NULL,
  `token` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `desafio_tsic`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desafio_tsic`.`produtos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prod_desc` VARCHAR(191) NOT NULL,
  `prod_valo` DOUBLE(8,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `desafio_tsic`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desafio_tsic`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `isAdmin` ENUM('1', '0') NOT NULL,
  `name` VARCHAR(191) NOT NULL,
  `email` VARCHAR(191) NOT NULL,
  `password` VARCHAR(191) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE)
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

USE `desafio_tsic`;

DELIMITER $$
USE `desafio_tsic`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `desafio_tsic`.`atualiza_total_vendas`
AFTER INSERT ON `desafio_tsic`.`items`
FOR EACH ROW
BEGIN
    UPDATE documentos
       SET docu_tota = docu_tota + 1
	 WHERE documentos.id = NEW.item_docu;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
