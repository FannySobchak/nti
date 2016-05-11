
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- actualite
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `actualite`;

CREATE TABLE `actualite`
(
    `id_actu` INTEGER NOT NULL AUTO_INCREMENT,
    `contenu` VARCHAR(500),
    `date_actu` DATE NOT NULL,
    `id_user` INTEGER NOT NULL,
    PRIMARY KEY (`id_actu`),
    INDEX `FK_actualite_id_user` (`id_user`),
    CONSTRAINT `FK_actualite_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- cours
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cours`;

CREATE TABLE `cours`
(
    `id_cours` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`id_cours`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- enseigner
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `enseigner`;

CREATE TABLE `enseigner`
(
    `id_user` INTEGER NOT NULL,
    `id_cours` INTEGER NOT NULL,
    PRIMARY KEY (`id_user`,`id_cours`),
    INDEX `FK_enseigner_id_cours` (`id_cours`),
    CONSTRAINT `FK_enseigner_id_cours`
        FOREIGN KEY (`id_cours`)
        REFERENCES `cours` (`id_cours`),
    CONSTRAINT `FK_enseigner_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- epreuve
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `epreuve`;

CREATE TABLE `epreuve`
(
    `id_epreuve` INTEGER NOT NULL AUTO_INCREMENT,
    `dateEpreuve` DATE NOT NULL,
    `intitule` VARCHAR(25),
    `id_cours` INTEGER NOT NULL,
    PRIMARY KEY (`id_epreuve`),
    INDEX `FK_epreuve_id_cours` (`id_cours`),
    CONSTRAINT `FK_epreuve_id_cours`
        FOREIGN KEY (`id_cours`)
        REFERENCES `cours` (`id_cours`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- etudiant
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `etudiant`;

CREATE TABLE `etudiant`
(
    `id_user` INTEGER NOT NULL,
    `id_session` INTEGER NOT NULL,
    PRIMARY KEY (`id_user`),
    INDEX `FK_etudiant_id_session` (`id_session`),
    CONSTRAINT `FK_etudiant_id_session`
        FOREIGN KEY (`id_session`)
        REFERENCES `session` (`id_session`),
    CONSTRAINT `FK_etudiant_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fichier
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fichier`;

CREATE TABLE `fichier`
(
    `id_fichier` INTEGER NOT NULL AUTO_INCREMENT,
    `chemin` VARCHAR(25) NOT NULL,
    `id_user` INTEGER NOT NULL,
    `id_cours` INTEGER NOT NULL,
    PRIMARY KEY (`id_fichier`),
    INDEX `FK_fichier_id_user` (`id_user`),
    INDEX `FK_fichier_id_cours` (`id_cours`),
    CONSTRAINT `FK_fichier_id_cours`
        FOREIGN KEY (`id_cours`)
        REFERENCES `cours` (`id_cours`),
    CONSTRAINT `FK_fichier_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- note
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `note`;

CREATE TABLE `note`
(
    `id_note` INTEGER NOT NULL AUTO_INCREMENT,
    `note` FLOAT NOT NULL,
    `id_epreuve` INTEGER NOT NULL,
    `id_session` INTEGER NOT NULL,
    `id_user` INTEGER NOT NULL,
    PRIMARY KEY (`id_note`),
    UNIQUE INDEX `id_epreuve` (`id_epreuve`),
    UNIQUE INDEX `id_session` (`id_session`),
    UNIQUE INDEX `id_user` (`id_user`),
    CONSTRAINT `FK_note_id_epreuve`
        FOREIGN KEY (`id_epreuve`)
        REFERENCES `epreuve` (`id_epreuve`),
    CONSTRAINT `FK_note_id_session`
        FOREIGN KEY (`id_session`)
        REFERENCES `session` (`id_session`),
    CONSTRAINT `FK_note_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- page
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page`
(
    `id_page` INTEGER NOT NULL AUTO_INCREMENT,
    `titre_page` VARCHAR(25) NOT NULL,
    `id_user` INTEGER NOT NULL,
    PRIMARY KEY (`id_page`),
    INDEX `FK_page_id_user` (`id_user`),
    CONSTRAINT `FK_page_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- prof
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `prof`;

CREATE TABLE `prof`
(
    `id_user` INTEGER NOT NULL,
    PRIMARY KEY (`id_user`),
    CONSTRAINT `FK_prof_id_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `user` (`id_user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- session
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session`
(
    `id_session` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(25) NOT NULL,
    `date_inscription` DATE NOT NULL,
    PRIMARY KEY (`id_session`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id_user` INTEGER NOT NULL AUTO_INCREMENT,
    `nom` CHAR(25),
    `prenom` CHAR(25) NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `mdp` VARCHAR(40) NOT NULL,
    `tel` VARCHAR(25),
    `droit` INTEGER NOT NULL,
    `photo` VARCHAR(25),
    PRIMARY KEY (`id_user`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
