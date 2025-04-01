DROP TABLE IF EXISTS `connexion`;
CREATE TABLE `connexion` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL -- À hacher avant insertion !
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `formulaire`;
CREATE TABLE `formulaire` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `prenom` VARCHAR(100) NOT NULL,
  `naissance` DATE NOT NULL, -- Correction de VARCHAR(100) en DATE
  `email` VARCHAR(100) NOT NULL UNIQUE, -- Ajout de UNIQUE
  `telephone` VARCHAR(20) DEFAULT NULL -- Taille réduite, car 100 est trop grand
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

