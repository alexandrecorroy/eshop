-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 27 Mars 2015 à 10:16
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Structure de la table `eshop_categories`
--

CREATE TABLE IF NOT EXISTS `eshop_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `name_categorie` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `eshop_categories`
--

INSERT INTO `eshop_categories` (`id`, `left`, `right`, `name_categorie`) VALUES
(1, 1, 26, '[CATEGORIES]'),
(4, 3, 4, 'Jeux PS4'),
(21, 2, 9, 'PS4'),
(22, 10, 17, 'Xbox One'),
(24, 5, 6, 'Accessoires PS4'),
(25, 11, 12, 'Jeux Xbox One'),
(26, 13, 14, 'Accessoires Xbox One'),
(28, 18, 25, 'Wii U'),
(29, 19, 20, 'Jeux Wii U'),
(30, 7, 8, 'Consoles'),
(31, 15, 16, 'Consoles'),
(32, 21, 22, 'Accessoires Wii U'),
(33, 23, 24, 'Consoles');

-- --------------------------------------------------------

--
-- Structure de la table `eshop_coupons`
--

CREATE TABLE IF NOT EXISTS `eshop_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `reduc_pourcentage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `eshop_coupons`
--

INSERT INTO `eshop_coupons` (`id`, `code`, `reduc_pourcentage`) VALUES
(1, '5POURCENT', 5),
(2, '20POURCENT', 20);

-- --------------------------------------------------------

--
-- Structure de la table `eshop_orders`
--

CREATE TABLE IF NOT EXISTS `eshop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `date_achat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_products_price` float NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `shipping_cost` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_info` varchar(256) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(64) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `eshop_orders_details`
--

CREATE TABLE IF NOT EXISTS `eshop_orders_details` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `name_product` varchar(256) NOT NULL,
  `price_product` float NOT NULL,
  `quantity` int(11) NOT NULL,
  UNIQUE KEY `unique` (`id_order`,`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eshop_products`
--

CREATE TABLE IF NOT EXISTS `eshop_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `name_product` varchar(256) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `date_product` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `eshop_products`
--

INSERT INTO `eshop_products` (`id`, `id_categorie`, `name_product`, `short_description`, `long_description`, `price`, `stock`, `date_product`) VALUES
(27, 4, 'RESIDENT EVIL : REVELATIONS 2', 'Claire et Moira vont-elles s&rsquo;en sortir vivantes et d&eacute;couvrir les raisons de leur pr&eacute;sence sur cette &icirc;le abandonn&eacute;e ?', '&lt;p&gt;R&amp;eacute;alis&amp;eacute; comme une s&amp;eacute;rie d&amp;rsquo;&amp;eacute;pisodes terrifiants, Resident Evil : Revelations 2 s&amp;rsquo;articule autour de quatre aventures vendues s&amp;eacute;par&amp;eacute;ment, qui propose chacune un cliffhanger (fin ouverte) des plus tendus.&lt;/p&gt;\r\n&lt;p&gt;L&amp;rsquo;histoire de Resident Evil : Revelations 2 met en sc&amp;egrave;ne l&amp;rsquo;une des h&amp;eacute;ro&amp;iuml;nes pr&amp;eacute;f&amp;eacute;r&amp;eacute;es des fans de la licence : Claire Redfield. La belle fait son grand retour parmi les horreurs qui l&amp;rsquo;ont hant&amp;eacute;e dans le pass&amp;eacute;. Apr&amp;egrave;s avoir surv&amp;eacute;cu &amp;agrave; l&amp;rsquo;incident de Racoon City survenu dans les &amp;eacute;pisodes pr&amp;eacute;c&amp;eacute;dents, Claire travaille d&amp;eacute;sormais pour Terra Save, une organisation qui lutte contre le bioterrorisme.&lt;/p&gt;\r\n&lt;p&gt;Moira Burton, nouvelle recrue et fille du l&amp;eacute;gendaire Barry Burton, attend sa f&amp;ecirc;te de bienvenue, lorsque des forces arm&amp;eacute;es non identifi&amp;eacute;es d&amp;eacute;barquent dans les bureaux de l&amp;rsquo;organisation. Claire et Moira sont assomm&amp;eacute;es et se r&amp;eacute;veillent quelques heures plus tard d&amp;eacute;tenues dans un lieu glauque, sombre, et qui semble abandonn&amp;eacute;. Elles vont devoir travailler ensemble pour d&amp;eacute;couvrir qui les a kidnapp&amp;eacute;es et &amp;agrave; quelles fins&amp;hellip;&lt;/p&gt;\r\n&lt;p&gt;Claire et Moira vont-elles s&amp;rsquo;en sortir vivantes et d&amp;eacute;couvrir les raisons de leur pr&amp;eacute;sence sur cette &amp;icirc;le abandonn&amp;eacute;e ?&lt;/p&gt;', 44.99, 1000, '2015-03-24 18:54:31'),
(28, 4, 'BLADESTORM NIGHTMARE', 'Plongez au coeur de la guerre de Cent Ans !', '<p>Bladestorm : Nightmare est un jeu d’action/stratégie dans lequel vous dirigez votre armée pendant la période de la guerre de Cent Ans.</p>\r\n<p>Vous incarnez un mercenaire et combattez du côté des Français ou des Anglais, et n’hésitez pas à changer de camp selon vos ambitions personnelles. Menez une armée de centaines de soldat à travers les plus grandes batailles de la Guerre de Cent ans.</p>\r\n<p>Avec le mode Nightmare, découvrez un scénario mélangeant éléments historiques et de Fantasy. Incarnez plus de 30 personnages, fictifs ou historiques, comme Jeanne d’Arc ou le Prince Noir.</p>\r\n<p>• Plongez en pleine guerre de Cent ans dans la peau d’un mercenaire, et contrôlez jusqu’à 4 troupes de 50 soldats (mêlée, montée, à distance)</p>\r\n<p>• Dans le Mode Nightmare, incarnez plus de 30 personnages et contrôlez 9 types de troupes fantastiques (Dragons, squelettes, gobelins, géants ou démons)</p>\r\n<p>• Créez votre mercenaire grâce au mode édition, et partagez-le avec les autres joueurs</p>\r\n<p>• Multijoueur en ligne, en coopération ou en versus, et cross play/cross save entre la version PS4 et la version digitale PS3.</p>', 59.99, 1000, '2015-03-24 19:00:13'),
(33, 4, 'BATTLEFIELD HARDLINE', 'Battlefield Hardline est un jeu de tir &agrave; la premi&egrave;re personne dont l&rsquo;action se d&eacute;roule au c&oelig;ur de la guerre contre le crime que se livrent policiers et criminels.', '<p>Battlefield Hardline est clairement un affrontement entre criminels et policiers dans un monde ou crime et vengeance sont omniprésents.</p>\r\n<p>Une mise en scène du gameplay spectaculaire à l’image des grandes séries policières.</p>\r\n<p>Un nouveau système de jeu solo mis au point par Visceral Games</p>\r\n<p>Utilisez les classes de personnages pour la première fois dans un mode solo.</p>\r\n<p>Lorsque vous vous rendez dans le mode multijoueur, vous pouvez utiliser l’argent récolté.</p>\r\n<p>Le meilleur de Battlefield et de DICE dans un tout nouvel environnement unique.</p>\r\n<p> </p>\r\n<p>Contenu – 5 nouveaux modes multijoueurs</p>\r\n<p>Destruction – Des décors destructibles comme dans Battlefield, le tout dans un univers urbain.</p>\r\n<p>Arme – Une large variété incluant des armes militaires, de l’équipement tactique de police et des gadgets fictifs.</p>\r\n<p>Véhicules – Muscle car, avions privés, véhicules de la SWAT, hélicoptères blindés, et bien d’autres.</p>', 69.99, 1000, '2015-03-24 19:44:31'),
(34, 4, 'TOUKIDEN KIWAMI', 'Etes-vous pr&ecirc;t &agrave; faire face &agrave; ces redoutables d&eacute;mons ?', '<p>Avec Toukiden : Kiwami, l’éditeur Tecmo Koei créé un univers fantasy unique composé d''éléments traditionnels japonais.</p>\r\n<p>Par les créateurs de la série des Dynasty Warriors, Toukiden Kiwami vous met dans la peau d''un chasseur de démons, les « Oni ». Vous commencez votre aventure au village d''Utakata, où des quêtes vous attendent et détermineront l’avenir de l’humanité.</p>\r\n<p>Etes-vous prêt à faire face à ces redoutables démons ?</p>\r\n<p>Toukiden Kiwami double le contenu du Toukiden d''origine avec de nombreux nouveaux contenus et un tout nouveau scénario. La version PS4 bénéficie d’un gameplay repensé et d’une refonte graphique.</p>\r\n<p>• Créez un assassin unique et partez à la chasse de dangereux démons sur fond de fresque historique japonaise et de fantasy</p>\r\n<p>• Choisissez des alliés parmi de nombreux personnages, ou faites équipes avec des amis pour des sessions en coopération jusqu’à 4 joueurs.</p>\r\n<p>• Un contenu doublé : de nouveaux chapitres, de nouveaux Oni, de nouveaux champs de bataille et bien plus ! Relevez le défi du nouveau mode de difficulté “Ultimate”</p>\r\n<p>• Importez vos sauvegardes depuis le Toukiden Original. Cross play entre les versions PS4 et PS Vita de Toukiden Kiwami</p>', 59.99, 10, '2015-03-26 19:49:45'),
(35, 4, 'TOMB RAIDER D&Eacute;FINITIVE EDITION', 'Tomb Raider : Definitive Edition est un jeu d''action et d''aventure qui voit une jeune Lara Croft inexp&eacute;riment&eacute;e devenir une combattante endurcie pour survivre.', '<p>Tomb Raider : Definitive Edition est un jeu d''action et d''aventure qui voit une jeune Lara Croft inexpérimentée devenir une combattante endurcie pour survivre.</p>\r\n<p>La "Definitive Edition" comprend tous les contenus téléchargeables, ainsi que des versions numériques du comic de Dark Horse, du livret d''illustrations Brady Games et des vidéos de développement "Final Hours".</p>\r\n<p>Lara Croft présentée en haute définition et avec un maximum de détails :</p>\r\n<p>-  Lara a été entièrement remodélisée.</p>\r\n<p>-  La technologie TRESS FX reproduit de façon réaliste les cheveux et leurs mouvements en animant séparément chaque mèche.</p>\r\n<p>-  Les jeux d''ombres et de lumières ont été retravaillés.</p>\r\n<p>Un monde physique animé grâce à une toute nouvelle architecture matérielle :</p>\r\n<p>- L''univers du jeu prend vie de façon dynamique via une simulation physique complexe des arbres, des feuillages, des vêtements, de la météo, de l''éclairage et des effets.</p>\r\n<p>- Les résolutions des textures ont été multipliées par quatre.</p>\r\n<p>- Les personnages et les ennemis ont été améliorés, et les décors rendus encore plus destructibles.</p>', 39.99, 1000, '2015-03-26 19:53:23'),
(36, 4, 'DESTINY EDITION VANGUARD', 'Les cr&eacute;ateurs de Halo et l''&eacute;diteur de Call of Duty vous pr&eacute;sentent Destiny.', '<p>L''armurerie Vanguard</p>\r\n<p>Dans Destiny, le plus important est de posséder les armes et l''équipement nécessaire pour vivre la meilleure expérience de jeu possible. Tout au long du jeu, vous devez récupérer ces équipements qui vont faire que vous allez monter en grade. Grâce à cette version spéciale, vous allez être récompensé et pourrez avoir accès à l''armurerie Vanguard (armurerie dans de l''avant-garde dans le jeu). Vous pourrez acheter de l''équipement avancé.</p>\r\n<p>Les créateurs de Halo et l''éditeur de Call of Duty vous présentent Destiny.</p>\r\n<p>Dans Destiny, vous incarnez un Gardien de la dernière cité sur Terre, capable de manier lincroyable puissance du Voyageur. Explorez les vestiges de notre système solaire, des dunes de Mars aux jungles luxuriantes de Vénus. Triomphez de nos ennemis. Récupérez ce que nous avons perdu. Devenez une légende.</p>\r\n<p>Tout changea à l''arrivée du Voyageur. Il fut à l''origine d''un Âge d''or qui permit à notre civilisation de s''implanter dans tout le système solaire. Mais cela ne pouvait pas durer. Quelque chose nous mit à terre et nous brisa. Les survivants bâtirent une cité sous le Voyageur, avant de repartir explorer nos anciens mondes, où seuls de mortels ennemis les attendaient.</p>\r\n<p>Vous êtes un Gardien, protecteur du dernier havre de vie sur Terre, armé de pouvoirs incroyables. Vous devez défendre la Cité. Vaincre nos ennemis. Et retrouver tout ce que nous avons perdu. </p>\r\n<p>- Créez votre personnage, puis forgez votre légende en triomphant de puissants ennemis et en gagnant des armes, de l''équipement et des véhicules, tous uniques et personnalisables.</p>\r\n<p>- Offrant une variété de jeu inédite, un FPS qui redéfinit le genre et rompt avec les conventions des campagnes en solo, des modes multijoueurs compétitifs et coopératifs, et les associe à vos réseaux sociaux.</p>\r\n<p>Un nouvel univers</p>\r\n<p>Embarquez dans une nouvelle aventure épique à la narration cinématographique. Percez les mystères de notre univers et récupérez tout ce que nous avons perdu à la chute de notre Âge dor. </p>\r\n<p>De nouvelles façons de jouer</p>\r\n<p>La prochaine évolution des jeux de tir à la première personne associe pour la première fois campagne narrative, mode coopératif et multijoueur compétitif, événements publics mêlés à des activités personnelles de façon totalement homogène et fluide, dans un gigantesque univers persistant en ligne. Aventurez-vous seul ou faîtes équipe avec des amis. Cest à vous de choisir.</p>\r\n<p>Créez votre propre légende</p>\r\n<p>Personnalisez et améliorez tous les aspects de votre apparence et de votre équipement à laide de combinaisons quasi illimitées darmures, armes et tenues. Jouez avec votre personnage customisé dans tous les modes de jeu, que ce soit dans les aspects solo, ou missions coopératives, espaces multijoueurs compétitifs, sociaux et publics.</p>', 69.99, 500, '2015-03-26 19:56:07'),
(37, 4, 'THE WITCHER III : WILD HUNT', 'The Witcher 3', '<p>Découvrez The Witcher III : Traque Sauvage, un jeu de rôle fantastique proposant une histoire non linéaire centrée sur les personnages et se déroulant dans un monde ouvert offrant au joueur des combats tactiques et des environnements riches et vivants.</p>\r\n<p>Un monde open-world immense et riche, avec une pléthore de monstres à tuer.</p>\r\n<p>Une histoire romanesque ponctuée de choix cornéliens qui offre plus 100 heures de jeu.</p>\r\n<p>Un système de combat dynamique où vos reflexes sont mis à rude épreuve face à des ennemis intelligents.</p>\r\n<p>Des graphismes à couper le souffle</p>\r\n<p>Surprise :</p>\r\n<p>Dès le 25 Février 2015, CD PROJEKT RED publiera le premier bundle de DLC contenant un set d''armure Témérienne pour Geralt de Riv et sa monture ainsi qu''un pack Barbes et coiffures pour personnaliser votre héros. Suite à cela, chaque semaine sera l''occasion de découvrir un nouveau pack de 2 DLC, et ce, toujours gratuitement.</p>', 69.99, 800, '2015-03-26 19:58:00'),
(38, 4, 'BATMAN ARKHAM KNIGHT', 'Un chevalier surgit hors de la nuit', '<p>La Special Edition contient:</p>\r\n<p>Un Steelbook</p>\r\n<p>Skin exclusive Batman Première Apparition</p>\r\n<p>Les challenges maps Harley Quinn </p>\r\n<p>Bonus exclusif de précommande : Pack Epouvantail</p>\r\n<p>Batman : Arkham Knight constitue le dernier volet de la trilogie. Développé exclusivement pour les plateformes nouvelle génération, Batman: Arkham Knight présente par ailleurs une version inédite, conçue par Rocksteady, de la Batmobile. L''ajout de ce véhicule légendaire offre aux joueurs une expérience de jeu Batman complète alors qu''ils parcourront tout Gotham City, sur terre et dans les airs. Dans ce final, Batman affronte la menace ultime qui pèse sur la ville qu''il a juré de protéger. L''Épouvantail est de retour et, avec lui, un nombre impressionnant de super-vilains.</p>\r\n<p>"Devenez Batman" – Vivez pleinement l''expérience Batman alors que le Chevalier noir entame la dernier chapitre de la trilogie. Les joueurs peuvent devenir les meilleurs enquêteurs du monde grâce à l''ajout de la Batmobile et à l''amélioration de certaines fonctions caractéristiques de la série comme le système de combat "FreeFlow", la furtivité, les enquêtes médico-légales et la navigation.</p>\r\n<p>Les débuts de la Batmobile – La Batmobile prend enfin vie avec un design original et tout un arsenal de gadgets high-tech à son bord. Conçu pour être conduit dans tout l''environnement du jeu et pour passer du mode poursuite à grande vitesse au mode combat militaire, ce véhicule légendaire est un élément central de ce nouvel opus, et permet aux joueurs de foncer à tombeau ouvert dans les rues de Gotham City à la poursuite des plus dangereux vilains. Ce véhicule emblématique améliore par ailleurs les capacités de Batman dans bien des domaines, qu''il s''agisse de navigation ou de médecine légale, ou bien du combat et de résolution d''énigmes, créant ainsi une complémentarité parfaite entre l''homme et la machine.</p>\r\n<p>La conclusion épique de la trilogie Arkham de Rocksteady – Batman: Arkham Knight sème le chaos dans Gotham City. Les escarmouches avec délits de fuite de Batman: Arkham Asylum, qui dégénéraient en conspiration contre les prisonniers dans Batman: Arkham City, se transforment aujourd''hui en ultime épreuve de force pour l''avenir de Gotham. Le futur de la ville est en effet plus qu''incertain, avec le retour de l''Épouvantail, bientôt rejoint par le Chevalier d''Arkham, un personnage totalement inédit dans l''univers de Batman, ainsi que par une foule de super-vilains comme Harley Quinn, le Pingouin, Double-Face et l''Homme-mystère. </p>\r\n<p>Explorez tout Gotham City – Pour la toute première fois, les joueurs vont pouvoir explorer les moindres recoins de Gotham City grâce à un monde de jeu entièrement libre et ouvert. Gotham City fait ici plus de cinq fois la taille qu''elle avait dans Batman: Arkham City, et est représentée avec ce même souci du détail, qui caractérise les jeux de la série Arkham. </p>\r\n<p>Des missions secondaires passionnantes – Les joueurs peuvent plonger en totale immersion dans le chaos ambiant des rues de Gotham et rencontrer, à cette occasion, nombre de génies du crime. À eux de choisir ensuite entre se concentrer sur l''élimination de certaines cibles en particulier ou poursuivre l''intrigue centrale du jeu.</p>\r\n<p>De nouveaux gadgets et de nouvelles options de combat – Les joueurs ont à leur disposition plus de mouvements de combat et de gadgets high-tech qu''avant. La nouvelle compétence "gadgets en vol" permet à Batman de déployer des gadgets comme le batarang, le bat-grappin ou la tyrolienne tout en planant, alors que la ceinture de Batman inclut désormais tous les nouveaux gadgets qui lui permettront d''approfondir toujours plus ses investigations médico-légales, ses incursions furtives et ses compétences au combat.</p>', 74.99, 1500, '2015-03-26 19:59:38'),
(39, 4, 'DEAD ISLAND 2', 'L&rsquo;&eacute;pid&eacute;mie d&eacute;barque sur les c&ocirc;tes californiennes', '<p>Plusieurs mois après les évènements qui se sont déroulés à Banoi, les États-Unis se voient obligés de mettre l’« État doré » en quarantaine. Désormais zone interdite, la Californie est devenue un paradis sanglant pour les renégats qui cherchent l’aventure, la gloire et un nouveau départ. Combinant les éléments clés de Dead Island comme le combat rapproché immersif, l’action et le jeu de rôle, Dead Island 2 propose des armes artisanales incroyables et une galerie de personnages hauts en couleur qui permettront d’explorer des lieux emblématiques tels le Golden Gate ou la célèbre promenade du bord de mer de Venice Beach, en Californie du sud.</p>\r\n<p>Développé avec l’Unreal Engine 4, Dead Island 2 permet de retrouver un mode multijoueur libre dans lequel jusqu’à huit joueurs peuvent coopérer, s’affronter ou simplement coexister. Les différentes classes offrent une jouabilité variée : du combattant orienté action au chasseur favorisant la discrétion, chaque personnage propose un style de jeu qui lui est propre. Un système très détaillé de compétences donne aux joueurs les moyens de personnaliser leur héros et leur armement.</p>\r\n<p>Faites votre choix parmi un panel de héros immunisés contre le virus, tous impatients de plonger la tête la première dans l’apocalypse mort-vivante.</p>\r\n<p>Affrontez des hordes de zombies ainsi que des ennemis humains : participez à des combats rapprochés d’une intensité viscérale.</p>\r\n<p>Des meuleuses motorisées aux machettes électriques, à vous de décider comment démembrer ces zombies de manière efficace.</p>\r\n<p>Des affrontements contre les zombies regroupant jusqu’à 8 joueurs, permettant de rejoindre ou quitter librement les aventures partagées du groupe.</p>', 69.99, 700, '2015-03-26 20:01:05'),
(40, 4, 'DARK SOULS II', 'Une derni&egrave;re le&ccedil;on', '<p>Scholar of the First Sin contient le jeu Dark Souls II, ses 3 DLC déjà cultes et du tout nouveau contenu : une aventure inouïe qui vous emmènera de Majula au monde glacé de Frozen Eleum Loyce.</p>\r\n<p>Plongez sans plus attendre dans l’expérience exceptionnelle de Scholar of the First Sin, relevez des défis inédits et découvrez des événements ainsi que des PNJ originaux. L’univers enrichi de Dark Souls II et son mode en ligne amélioré vous attendent, mais attention : de nouveaux ennemis mortels sont tapis dans l’ombre.</p>\r\n<p>Embarquez pour un voyage en immersion totale dans le monde fascinant de Dark Souls II.</p>', 59.99, 400, '2015-03-26 20:02:52'),
(41, 4, 'WOLFENSTEIN THE OLD BLOOD', 'Double dose de Blazkowicz', '<p>En 1946, les Nazis sont sur le point de remporter la Seconde Guerre mondiale. Afin de renverser la situation, B.J. Blazkowicz doit partir pour une mission épique en deux temps au fin fond de la Bavière...</p>\r\n<p>Dans la première partie de Wolfenstein: The Old Blood - Rudi Jäger et la tanière des loups - B.J. Blazkowicz affronte un gardien de prison fou alors qu''il tente de pénétrer dans le château de Wolfenstein pour y dérober les coordonnées de la base du général Strasse.</p>\r\n<p>Dans la deuxième partie – Les sombres secrets de Helga von Schabbs – notre héros explorera la ville de Wulfburg toujours à la recherche des coordonnées pour trouver Strasse. Il y découvrira un archéologue nazi obnubilé par ses recherches déterre d''anciens et mystérieux artéfacts aux pouvoirs maléfiques.  </p>\r\n<p>Caractéristiques principales :</p>\r\n<p>De l''action !</p>\r\n<p>Redécouvrez l''expérience du jeu de combat à la première personne de MachineGames en utilisant de toutes nouvelles armes inspirées du matériel nazi comme le fusil à verrou, le fusil à pompe de 1946 ou encore le Kampfpistole lance-grenades. Découvrez votre potentiel caché avec une toute nouvelle liste d’options adaptés à la fois pour l''action chargée d''adrénaline comme pour les assassinats en toute discrétion.</p>\r\n<p>De l''aventure !</p>\r\n<p>Explorez des petits villages de campagne allemande, des vallées et montagnes reliées entre elles par des téléphériques et des ponts, des catacombes effrayantes et, bien sûr, l''emblématique château de Wolfenstein ! Utilisez les doubles barres à mine en métal pour escalader ce monde de long en large.</p>\r\n<p>Des frissons !</p>\r\n<p>Affrontez tout un tas de nouveaux ennemis comme les légions de super-soldats, les troupes de choc d''élite, les drones, ainsi que les abominations nazies les plus terribles qu''il vous reste à découvrir.</p>', 19.99, 1000, '2015-03-26 20:03:54'),
(42, 4, 'PURE CHESS', 'L''&eacute;chec n''est pas une option', '<p>Faites l’expérience de l’un des plus anciens jeux de société avec la technologie la plus moderne. N’importe qui, à tout âge, peut jouer à Pure Chess, mais seuls quelques-uns peuvent le maîtriser. La question est la suivante : Êtes-vous un grand maître en devenir ?</p>', 19.99, 49, '2015-03-26 20:06:56'),
(43, 24, 'MANETTE DUALSHOCK 4', 'La DUALSHOCK 4, entre classique et innovation', '<p>La DUALSHOCK 4, entre classique et innovation</p>\r\n<p>La manette de la PS4 prend le nom de DUALSHOCK 4. Elle est dotée de sticks analogiques creux, pour un meilleur contrôle. Les gâchettes analogiques ont également été redessinées. Quant aux boutons Start et Select, ils cèdent la place à deux autres fonctions. Un bouton Share permet le partage instantané d''informations sur les réseaux sociaux, dont Facebook et Ustream. Le second bouton, Option, regroupe les menus.</p>\r\n<p>Des fonctions de détection de mouvement et de vibration améliorées sont aussi au programme. Autre amélioration : l''ajout d''un pavé tactile similaire à celui situé au dos de la PS Vita.</p>\r\n<p>Impossible enfin de ne pas remarquer la barre lumineuse sur la tranche de la manette. Comme pour le Move, elle permet notamment de situer le contrôleur dans l''espace. Une prise casque et un haut-parleur sont également intégrés.</p>', 59.99, 1000, '2015-03-27 07:46:58'),
(44, 24, 'MANETTE DUALSHOCK 4 BLEUE', 'La manette DualShock 4 propose des innovations con&ccedil;ues pour garantir des exp&eacute;riences de jeu toujours plus immersives.', '<p>La manette DualShock 4 propose des innovations conçues pour garantir des expériences de jeu toujours plus immersives, à travers notamment un système de détection de mouvements à six axes.</p>\r\n<p>Elle est dotée de sticks analogiques creux, pour un meilleur contrôle. Les gâchettes analogiques ont également été redessinées. Quant aux boutons Start et Select, ils cèdent la place à deux autres fonctions. Un bouton Share permet le partage instantané d''informations sur les réseaux sociaux, dont Facebook et Ustream. Le second bouton, Option, regroupe les menus.</p>\r\n<p>Des fonctions de détection de mouvement et de vibration améliorées sont aussi au programme. Autre amélioration : l''ajout d''un pavé tactile similaire à celui situé au dos de la PS Vita.</p>', 59.99, 800, '2015-03-27 07:48:57'),
(46, 24, 'MANETTE DUALSHOCK 4 ROUGE', 'La manette DualShock 4 propose des innovations con&ccedil;ues pour garantir des exp&eacute;riences de jeu toujours plus immersives', '<p>La manette DualShock 4 propose des innovations conçues pour garantir des expériences de jeu toujours plus immersives, à travers notamment un système de détection de mouvements à six axes.</p>\r\n<p>Elle est dotée de sticks analogiques creux, pour un meilleur contrôle. Les gâchettes analogiques ont également été redessinées. Quant aux boutons Start et Select, ils cèdent la place à deux autres fonctions. Un bouton Share permet le partage instantané d''informations sur les réseaux sociaux, dont Facebook et Ustream. Le second bouton, Option, regroupe les menus.</p>\r\n<p>Des fonctions de détection de mouvement et de vibration améliorées sont aussi au programme. Autre amélioration : l''ajout d''un pavé tactile similaire à celui situé au dos de la PS Vita.</p>', 59.99, 800, '2015-03-27 07:51:36'),
(47, 30, 'PLAYSTATION 4 BLANCHE', 'Playstation 4 500 Go Blanche', '<p>Contenu du pack :</p>\r\n<p>- Une PlayStation 4 blanche</p>\r\n<p>- Une manette DUALSHOCK 4</p>\r\n<p>- Un câble HDMI</p>\r\n<p>- Un câble USB</p>\r\n<p>- Alimentation</p>\r\n<p>- Casque audio mono</p>\r\n<p>La console</p>\r\n<p>- Disque dur 500 Go</p>\r\n<p>- Lecteur Blu-ray (DVD)</p>\r\n<p>- Poids : 2,8 Kg</p>\r\n<p>- Dimension : 275×53×305 mm</p>\r\n<p>- 2 ports USB 3.0</p>\r\n<p>- Port HDMI</p>\r\n<p>- Ethernet, Wi-Fi, Bluetooth, Digital Out (optique), Auxiliaire (x1)</p>\r\n<p>Centré sur les joueurs, inspiré par les développeurs</p>\r\n<p>Le système PS4 a été conçu pour offrir aux joueurs PlayStation les meilleurs jeux et les expériences les plus immersives. Spécialement pensé pour répondre à leurs besoins, la PS4 permet aussi aux plus grands développeurs de jeux du monde de laisser libre cours à leur créativité.</p>\r\n<p>La PS4 connecte également le joueur de manière fluide au vaste monde dexpériences de PlayStation à travers le système et les espaces mobiles, ainsi que PlayStation Network (PSN).</p>\r\n<p>L''architecture du système PS4 se distingue par ses hautes performances et sa facilité de développement. Elle repose sur une puissante puce modifiée à huit coeurs x86-64 et un processeur graphique de pointe.</p>\r\n<p>La PS4 est doté de 8 Go de mémoire système unifiée facilitant la création de jeux et augmentant la richesse de contenu possible sur la plateforme. La mémoire est de type GDDR5. Elle offre au système une bande passante de 176 Go/seconde et accroît encore sa performance graphique.</p>\r\n<p>Pour les joueurs, le tout se traduit par des graphismes haute-fidélité détaillés et une expérience de jeu immersive au-delà de toute espérance.</p>\r\n<p>Expériences de jeu partagées</p>\r\n<p>- Les interactions sociales sont au coeur des expériences PS4.</p>\r\n<p>- Doté dun système de compression et décompression vidéo dédié permanent qui permet de télécharger instantanément des vidéos de jeu.</p>\r\n<p>- Les joueurs peuvent partager leurs victoires épiques d''un simple geste. Il suffit d''appuyer sur la touche « SHARE » (partager) de la manette, scanner les dernières minutes de jeu, les annoter et reprendre la partie.</p>\r\n<p>- Les joueurs peuvent lier leur compte Facebook à leur compte Sony Entertainment Network. Les utilisateurs peuvent développer leurs connexions en jouant en coopération ou en dialoguant via l''espace de discussion Cross-game.</p>\r\n<p>Écrans secondaires PS4</p>\r\n<p>- Prise en charge des écrans secondaires, comme le système PS Vita, les smartphones et les tablettes, pour permettre aux joueurs d''emporter leurs contenus favoris où qu''ils aillent. Les joueurs peuvent ainsi porter leurs jeux PS4 sur leur PS Vita.</p>\r\n<p>- Une nouvelle application de SCE appelée « PlayStation App » permettra aux appareils iPhone, iPad, smartphones et tablettes AndroidTM de devenir des écrans secondaires.</p>\r\n<p>Jeu immédiat</p>\r\n<p>- La PS4 réduit considérablement la latence séparant les joueurs de leurs contenus. Elle intègre une fonctionnalité de « suspend mode » (suspens) qui la maintient en état de veille tout en préservant la session de jeu. Le temps aujourd''hui nécessaire pour démarrer le système et charger une partie sauvegardée appartiendra bientôt au passé. Le joueur appuie sur la touche d''alimentation et retrouve instantanément sa partie là où il l''avait quittée. De plus, l''utilisateur peut lancer plusieurs applications, dont un navigateur internet, alors qu''il joue à un jeu sur PS4.</p>\r\n<p>Le système PS4 permet également de télécharger ou de mettre à jour des jeux en tâche de fond ou en veille. Il va même encore plus loin en offrant la possibilité de jouer à un jeu numérique alors qu''il est en cours de téléchargement.</p>\r\n<p>Du contenu ciblé et personnalisé</p>\r\n<p>- Grâce aux nouveaux menus, le joueur peut parcourir les informations liées aux jeux partagées par ses amis, regarder simplement ses amis jouer ou obtenir des informations sur du contenu recommandé (jeux, émissions de télévision, films).</p>', 399.99, 750, '2015-03-27 07:55:04'),
(48, 30, 'PLAYSTATION 4 (PS4)', 'La PlayStation 4 est la nouvelle console de chez Sony, celle qui vient remplacer la PlayStation 3. Bref, c''est du solide !', '<p>Contenu du pack :</p>\r\n<p>- Une PlayStation 4</p>\r\n<p>- Une manette DUALSHOCK 4</p>\r\n<p>- Un câble HDMI</p>\r\n<p>- Un câble USB</p>\r\n<p>- Alimentation</p>\r\n<p>- Casque audio mono</p>\r\n<p>La console</p>\r\n<p>- Disque dur 500 Go</p>\r\n<p>- Lecteur Blu-ray (DVD)</p>\r\n<p>- Poids : 2,8 Kg</p>\r\n<p>- Dimension : 275×53×305 mm</p>\r\n<p>- 2 ports USB 3.0</p>\r\n<p>- Port HDMI</p>\r\n<p>- Ethernet, Wi-Fi, Bluetooth, Digital Out (optique), Auxiliaire (x1)</p>\r\n<p>Centré sur les joueurs, inspiré par les développeurs</p>\r\n<p>Le système PS4 a été conçu pour offrir aux joueurs PlayStation les meilleurs jeux et les expériences les plus immersives. Spécialement pensé pour répondre à leurs besoins, la PS4 permet aussi aux plus grands développeurs de jeux du monde de laisser libre cours à leur créativité.</p>\r\n<p>La PS4 connecte également le joueur de manière fluide au vaste monde dexpériences de PlayStation à travers le système et les espaces mobiles, ainsi que PlayStation Network (PSN).</p>\r\n<p>Larchitecture du système PS4 se distingue par ses hautes performances et sa facilité de développement. Elle repose sur une puissante puce modifiée à huit curs x86-64 et un processeur graphique de pointe.</p>\r\n<p>La PS4 est doté de 8 Go de mémoire système unifiée facilitant la création de jeux et augmentant la richesse de contenu possible sur la plateforme. La mémoire est de type GDDR5. Elle offre au système une bande passante de 176 Go/seconde et accroît encore sa performance graphique.</p>\r\n<p> </p>\r\n<p>Pour les joueurs, le tout se traduit par des graphismes haute-fidélité détaillés et une expérience de jeu immersive au-delà de toute espérance.</p>\r\n<p>Expériences de jeu partagées</p>\r\n<p>- Les interactions sociales sont au cur des expériences PS4.</p>\r\n<p>- Doté dun système de compression et décompression vidéo dédié permanent qui permet de télécharger instantanément des vidéos de jeu.</p>\r\n<p>- Les joueurs peuvent partager leurs victoires épiques dun simple geste. Il suffit dappuyer sur la touche « SHARE » (partager) de la manette, scanner les dernières minutes de jeu, les annoter et reprendre la partie.</p>\r\n<p>- Les joueurs peuvent lier leur compte Facebook à leur compte Sony Entertainment Network. Les utilisateurs peuvent développer leurs connexions en jouant en coopération ou en dialoguant via lespace de discussion Cross-game.</p>\r\n<p>Écrans secondaires PS4</p>\r\n<p>- Prise en charge des écrans secondaires, comme le système PS Vita, les smartphones et les tablettes, pour permettre aux joueurs demporter leurs contenus favoris où quils aillent. Les joueurs peuvent ainsi porter leurs jeux PS4 sur leur PS Vita.</p>\r\n<p>- Une nouvelle application de SCE appelée « PlayStation App » permettra aux appareils iPhone, iPad, smartphones et tablettes AndroidTM de devenir des écrans secondaires.</p>\r\n<p>Jeu immédiat</p>\r\n<p>- La PS4 réduit considérablement la latence séparant les joueurs de leurs contenus. Elle intègre une fonctionnalité de « suspend mode » (suspens) qui la maintient en état de veille tout en préservant la session de jeu. Le temps aujourdhui nécessaire pour démarrer le système et charger une partie sauvegardée appartiendra bientôt au passé. Le joueur appuie sur la touche dalimentation et retrouve instantanément sa partie là où il lavait quittée. De plus, lutilisateur peut lancer plusieurs applications, dont un navigateur internet, alors quil joue à un jeu sur PS4.</p>\r\n<p>Le système PS4 permet également de télécharger ou de mettre à jour des jeux en tâche de fond ou en veille. Il va même encore plus loin en offrant la possibilité de jouer à un jeu numérique alors quil est en cours de téléchargement.</p>\r\n<p>Du contenu ciblé et personnalisé</p>\r\n<p>- Grâce aux nouveaux menus, le joueur peut parcourir les informations liées aux jeux partagées par ses amis, regarder simplement ses amis jouer ou obtenir des informations sur du contenu recommandé (jeux, émissions de télévision, films).</p>', 399.99, 500, '2015-03-27 07:58:07'),
(49, 25, 'SCREAMRIDE', 'Le grand frisson', '<p>Construisez et testez les montagnes russes les plus extrêmes.</p>\r\n<p>Au programme : des centaines d''éléments de construction personnalisables, des destructions ultra-réalistes, des cinématiques de collisions, des niveaux à déverrouiller, des classements du jeu et mondiaux. Dans ScreamRide, vous pouvez innover en toute liberté afin de provoquer des sensations extrêmes. Endossez pleinement votre rôle pour terminer les niveaux de multiples façons : les pilotes doivent faire preuve d''une précision chirurgicale, les ingénieurs doivent résoudre des défis de construction de taille et les experts en démolitions doivent occasionner un maximum de dégâts. Quel parcours choisirez-vous ?</p>', 39.99, 200, '2015-03-27 08:01:28'),
(50, 25, 'DRAGON BALL XENOVERSE', 'Un nouveau super guerrier dans la famille ?', '<p>Goku repart au combat !</p>\r\n<p>Centré sur un nouveau personnage lié à Yamcha, Trunks et bien d’autres, Dragon Ball Xenoverse vous replonge dans les plus célèbres combats de la série. Parviendrez-vous à modifier le cours de l’Histoire ? Vous découvrirez également une cité mystérieuse, une jouabilité totalement remaniée, de splendides animations et bien d’autres nouveautés qui seront bien dévoilées !</p>\r\n<p>COMBATS DE NOUVELLE GÉNÉRATION – Retrouvez votre manga favori sur PlayStation 4 et Xbox One, mais aussi sur PlayStation 3 et Xbox 360.</p>\r\n<p>IMMERSION TOTALE – Plongez-vous dans l’univers de la célèbre série.</p>\r\n<p>NOUVEL ENVIRONNEMENT – Découvrez une étrange ville futuriste où le temps vient tout juste de reprendre son cours normal.</p>\r\n<p>COMBATTANT MYSTÉRIEUX – Un voyageur énigmatique équipé d’un scouter se transforme en Super Saiyan… S’agit-il d’un autre survivant du cataclysme de la planète Vegeta ?</p>\r\n<p>COMBATS DE LÉGENDE – Retrouvez tous les plus grands combats de la série… et les plus redoutables adversaires : Vegeta, Freezer, Cell et bien d’autres encore !</p>\r\n<p>JOUABILITÉ AMÉLIORÉE – Des combats plus intenses et plus techniques que jamais !</p>\r\n<p>EXPRESSIONS FACIALES – Les expressions faciales des combattants évoluent au fil de la bataille.</p>', 69.99, 350, '2015-03-27 08:02:16'),
(51, 25, 'DYING LIGHT', 'Dying Light est un jeu de survival horror et d''action &agrave; la premi&egrave;re personne dont l''histoire se d&eacute;roule dans un vaste monde ouvert infest&eacute; de dangers', '<p>- Le premier pack "Cuisine et Cargo" qui regroupe 2 missions hardcore. Explorez des couloirs inquiétants infestés de zombies. Utilisez l''infiltration ou le combat afin de piller une gare de marchandises remplie d''infectés. Attention, ce pack ne sera activé que le 10 mars 2015.</p>\r\n<p>- Le deuxième pack Kit de Survie Extrême. Trois tenues spéciales pour customiser votre personnage. Quatre armes uniques qui vous permettront de massacrer du zombie en masse. Collectez les nouvelles tenues et les nouvelles armes d''un seul et même coup.</p>\r\n<p>Dying Light est un jeu de survival horror et d''action à la première personne dont l''histoire se déroule dans un vaste monde ouvert infesté de dangers. Le jour, les joueurs explorent un vaste environnement urbain en essayant désespérément d''y trouver toutes sortes de provisions et d''armes pour se protéger de la population infectée en perpétuelle croissance. La nuit, les infectés se montrent plus agressifs et plus violents et les chasseurs deviennent les proies. Les prédateurs qui n''apparaissent qu''après le coucher du soleil sont plus terrifiants encore. Les joueurs doivent utiliser toutes les ressources à leur disposition pour tenter de survivre jusqu''aux premières lueurs du jour.</p>\r\n<p>Survivez jusqu''au matin – Le jour, les joueurs peuvent se déplacer librement, et récupérer des provisions ou des armes. Mais à la nuit tombée, le monde subit une transformation radicale : le chasseur devient la proie et, tandis que les infectés deviennent plus agressifs et déferlent en nombre, quelque chose de bien plus effrayant s''éveille pour traquer les proies.</p>\r\n<p>Déplacements en course libre – Qu''ils soient en train de traquer une proie ou d''échapper à des prédateurs, dans Dying Light, les joueurs pourront évoluer en toute liberté dans l’environnement. Sautez d''immeuble en immeuble, grimpez le long des murs et frappez vos ennemis par surprise !</p>\r\n<p>Bienvenue dans la zone de quarantaine – L''histoire de Dying Light se déroule dans un monde ouvert très vaste composé d''environnements variés et peuplé d’ennemis en tous genres. Dans cette lutte désespérée pour la survie, les ressources se font rares et les infectés sont loin de représenter l’unique menace.</p>\r\n<p>Corps à corps brutal ou combat à distance – Affrontez les ennemis au corps à corps à l''aide d''une large gamme d''armes légères ou lourdes comprenant des couteaux, des battes, des haches, des marteaux et d’autres armes plus surprenantes, ou utilisez des armes à feu pour éliminer vos ennemis à distance.</p>\r\n<p>Choisissez votre style de jeu – Dying Light comprend quatre personnages jouables que vous pouvez entièrement personnaliser et faire évoluer en fonction de votre style de jeu.</p>\r\n<p>Fabriquez vos propres armes – Pourquoi utiliser une simple clé à molette alors que vous pouvez en faire une arme redoutable en l''entourant de fil barbelé électrifié ? Le système de création d''armes de Dying Light permet aux joueurs de créer à volonté de nouvelles armes et pièces d''équipement plus puissantes, ainsi que des munitions spécialisées.</p>\r\n<p>Un gameplay unique et des graphismes à couper le souffle – Dying Light est le premier jeu qui utilise Chrome Engine 6, un moteur graphique de pointe développé par Techland et entièrement conçu pour fonctionner avec les consoles nouvelle génération, DirectX 11 et de nombreuses autres technologies avancées.</p>', 69.99, 375, '2015-03-27 08:04:13'),
(52, 26, 'CARTE XBOX LIVE 50 EUROS', 'Carte permettant de cr&eacute;diter un compte Xbox Live de 50 euros.', '<p>- Carte permettant de créditer un compte Xbox Live de 50 euros.</p>\r\n<p>- Achetez du contenu téléchargeable (jeux, extensions, musiques, films, etc.) pour Xbox 360 et Xbox One.</p>\r\n<p>Avec le Xbox Live, entrez dans une nouvelle dimension de jeu. Jouez aux jeux compatibles Xbox Live en mode multijoueur sur Internet via un accès haut débit (câble ou DSL) et défiez des joueurs du monde entier, 24h/24, 365 jours par an. Sur Xbox Live, vous pouvez créer votre identité unique (le Gamertag) et forger votre réputation à travers le monde, retrouver facilement vos amis, parler tout en jouant avec le micro-casque Xbox Communicator (non inclus) et même télécharger du contenu de jeu exclusif.</p>\r\n<p>- Grâce aux cartes Xbox, profitez de Xbox Video et Xbox Music sur Xbox 360 et Xbox One.</p>\r\n<p>- Utilisez vos cartes Xbox sur vos console Xbox 360 et Xbox One mais aussi sur votre PC,smartphone ou tablette !</p>\r\n<p>Lorsque vous utilisez une carte cadeau Xbox, sa valeur s''ajoute directement à votre compte Microsoft en devise locale. Ainsi, si vous disposez d''une carte de 25 €, cette somme s''ajoutera à votre compte Microsoft lorsque vous utiliserez la carte.</p>\r\n<p>Que vous possédiez une console Xbox 360 ou une Xbox One, ces cartes sont valables.</p>', 50, 120, '2015-03-27 08:19:41'),
(53, 26, 'MANETTE SANS FIL XBOX ONE', 'Ressentez les crashs et les chocs en haute d&eacute;finition gr&acirc;ce aux vibrations des nouvelles g&acirc;chettes &agrave; impulsion.', '<p>Ressentez les crashs et les chocs en haute définition grâce aux vibrations des nouvelles gâchettes à impulsion. Améliorez votre précision avec des sticks analogiques ré-imaginés et un tout nouveau pavé directionnel.</p>\r\n<p>Caractéristiques :</p>\r\n<p>- Nouvelles gâchettes à impulsion, qui vibrent, pour un réalisme et une immersion saisissantes</p>\r\n<p>- Nouveau pavé directionnel optimisé pour tous les types de jeux</p>\r\n<p>- Nouveaux sticks analogiques plus précis et réactifs</p>\r\n<p>- Nouveau signal radio pour un transfert de données plus rapide</p>\r\n<p>- Conçue pour sadapter à toutes les tailles de mains</p>\r\n<p>- Prenez la manette et jouez ! Kinect reconnait directement qui tient quelle manette</p>\r\n<p>- Jouez sans contrainte et en toute liberté avec la technologie sans fil*</p>\r\n<p>* Jusqu''à 9 mètres</p>\r\n<p>Contenu :</p>\r\n<p>- Manette sans fil.</p>\r\n<p>- Deux piles LR6 AA.</p>', 54.99, 175, '2015-03-27 08:20:30');
INSERT INTO `eshop_products` (`id`, `id_categorie`, `name_product`, `short_description`, `long_description`, `price`, `stock`, `date_product`) VALUES
(54, 31, 'XBOX ONE', 'Xbox One a &eacute;t&eacute; con&ccedil;u pour devenir la pi&egrave;ce centrale de votre salon.', '<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">La contenu du pack</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Disque dur 500 go</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Lecteur Blu-ray et DVD, Wi-Fi</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Capteur Kinect</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- 1 manette sans fil</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Câbles HDMI.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- 2 Piles LR6 AA</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Un Micro-Casque filaire</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Alimentation</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Le design</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Xbox One a été conçu pour devenir la pièce centrale de votre salon.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Une architecture unique</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Microsoft a crée un système d''exploitation de jeu et l''a marié à un système d''exploitation Windows. Fini le temps où vous deviez changer la source sur votre téléviseur pour passer d''une émission de TV à un jeu vidéo. Maintenant, vous pouvez démarrer une multitude d''applications en même temps que vous jouez, sans nuire à la performance de la console.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">console multitâches</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- La console Xbox One se réveille instantanément, pour être prête quand vous l''êtes. Parce que moins de temps à attendre c''est plus de temps pour jouer.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Basculez instantanément d''un jeu à une émission TV, à de la musique ou à des applications. Désormais, vous navez plus à arrêter une expérience avant den commencer une nouvelle.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Vous avez toujours rêvé pouvoir tchater avec un ami sur Skype pendant que vous regardiez un match de football ? Avec le mode Snap, vous pourrez faire les deux en même temps. Sur le même écran.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Ordinateur dans votre salon</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Les caractéristiques techniques donnent l''impression d''avoir un super-ordinateur dans votre salon. Mais la puissance brute n''est rien sans la vitesse.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Xbox Live</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Découvrez la puissance du Cloud avec le Xbox Live nouvelle génération, le réseau qui unit chaque membre de la communauté Xbox. Il vous connecte également à des milliers de jeux, musiques, émissions TV, films et retransmissions sportives. C''est une source de puissance illimitée qui se renforce avec le temps. Toujours plus fort, vos jeux et votre profil sont stockés dans le Cloud. Ainsi vous pouvez utiliser n''importe quelle console Xbox One comme si c''était la vôtre.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Votre abonnement au Xbox Live Gold fonctionnera à la fois sur Xbox 360 et Xbox One.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Vous souhaitez voir le score d''un match en plein milieu d''une partie sur votre console ? Pas de problème. Avec la reprise automatique, votre partie est suspendue exactement là où vous vous arrêtez. Vous pouvez revenir exactement au même endroit. Vous pouvez même démarrer un film ou un jeu sur une Xbox One et finir sur une autre.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Avec Xbox One, vous pouvez jouer immédiatement pendant que les jeux s''installent. Les mises à jour s''installent automatiquement en tâche de fond, pour que vos jeux et divertissements ne soient jamais interrompus.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Kinect</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Le système Kinect est plus précis, plus rapide, plus intuitif. Connectez vous à votre profil automatiquement en rentrant dans la pièce. Avancez dans un jeu avec des gestes simples. Naviguez dans vos applications favorites grâce au son de votre voix. C''est un tout nouveau capteur Kinect et une toute nouvelle génération de divertissements.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Nouvelle technologie de capture du champ de vision</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">- Avec Kinect Real Vision, la toute nouvelle technologie de capture du champ de vision, le capteur étend considérablement ses possibilités. Une toute nouvelle caméra infrarouge permet de vous voir dans le noir. Kinect utilise également une technologie 3D géométrique très avancée. Kinect peut même détecter si vous perdez l''équilibre.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Nouvelle technologie de capture de mouvement</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Kinect reconnait les gestes les plus subtils. Ainsi, d''un simple mouvement de votre main résulte un contrôle très précis retranscrit dans votre jeu ou application. Que vous soyez debout ou assis.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Nouvelle techonologie de reconnaissance vocale</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Kinect Real Voice, la nouvelle technologie de reconnaissance vocale de Kinect cible les sons importants, grâce à une toute nouvelle série de micros. Une isolation du bruit permet à Kinect de savoir qui écouter même dans une pièce occupée par de nombreuses personnes. Et, pour la première fois, vous pouvez utiliser votre voix pour démarrer n''importe quelle expérience Xbox One, pour que vous puissiez rapidement passer d''une chose à une autre.</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Xbox SmartGlass</span></font></p>\r\n<p><font color="#3e3e3e" face="Open Sans, sans-serif"><span style="font-size: 14px; line-height: 21px;">Xbox SmartGlass transforme votre smartphone ou votre tablette en un second écran qui interagit avec votre Xbox One. Naviguez avec lécran tactile, mettez en pause et reprenez votre film préféré ou encore agrandissez, déplacez ou entrez du texte dans un navigateur Internet sur votre TV.</span></font></p>', 499.99, 780, '2015-03-27 08:25:21'),
(55, 29, 'MARIO PARTY 10', 'Plus on est de fous. . .', '<p>Mario Party 10, le dernier opus de la série Mario Party, nous propose son lot de minijeux multijoueur dans le Royaume Champignon sur Wii U.</p>\r\n<p>En plus de pouvoir jouer à quatre joueurs comme dans les titres précédents, Mario Party 10 propose des minijeux s''adressant à jusqu''à cinq joueurs uniquement jouables sur Wii U : un joueur contrôle Bowser sur le Wii U GamePad pour chasser les autres joueurs incarnant Mario et d''autres personnages du Royaume Champignon. Le jeu est également prévu pour être compatible avec les amiibo.</p>', 39.99, 175, '2015-03-27 08:32:51'),
(56, 29, 'WATCH DOGS', 'Watch_Dogs vous plonge au coeur de la ville hyper-connect&eacute;e de Chicago. . .', '<p>Watch_Dogs vous plonge au coeur de la ville hyper-connectée de Chicago, dans laquelle votre smartphone vous donne le contrôle de tout ce qui est connecté au réseau : des caméras de surveillance aux feux de signalisation, en passant par le réseau électrique. </p>\r\n<p>Incarnez Aiden Pearce, un hacker hanté par son passé et lancé dans une vendetta contre les responsables du massacre de sa famille. Dans votre quête de justice, la ville elle-même devient une arme mortelle et vous en détenez maintenant le contrôle !</p>\r\n<p>- Piratez et contrôlez la ville à laide de votre smartphone : manipulez les feux de circulation pour provoquer un accident, coupez le courant pour créer le chaos, ou stoppez un train pour monter à bord et échapper aux forces de l''ordre. Tout ce qui est connecté au réseau peut devenir votre arme.</p>\r\n<p>-  Neutralisez vos ennemis brutalement à coup de matraque, ou utilisez lune des 30 armes disponibles dans des fusillades nerveuses et spectaculaires.</p>\r\n<p>-  Prenez le volant de plus de 65 véhicules bénéficiant dune physique et dune conduite minutieusement travaillées, et ressentez ladrénaline de courses-poursuites intenses et spectaculaires.</p>\r\n<p> Grâce à la puissance du tout nouveau moteur de jeu Disrupt, plongez dans une monde urbain réaliste, et observez limpact instantané de vos actions sur toute la ville et sa population.</p>', 59.99, 280, '2015-03-27 08:34:42'),
(57, 29, 'PLANES 2', 'Planes 2 est le jeu vid&eacute;o inspir&eacute; du film d&rsquo;animation. Le jeu de Disney Interactive embarque les joueurs dans une s&eacute;rie de missions et de courses a&eacute;riennes au c&ocirc;t&eacute; de Dusty, ce petit [...]', '<p>Planes 2 est le jeu vidéo inspiré du film d’animation. Le jeu de Disney Interactive embarque les joueurs dans une série de missions et de courses aériennes au côté de Dusty, ce petit avion au grand cœur.</p>\r\n<p>Aide Dusty et ses amis à lutter contre des incendies massifs dans plus de 30 missions de sauvetage !</p>\r\n<p>Protège le parc national de Piston Peak et retrouve les lieux mythiques de la série en incarnant l’un des 8 héros de l’équipe de choc.</p>\r\n<p>Fais preuve d’esprit d’équipe en utilisant les capacités uniques de chacun de tes coéquipiers lors de 12 missions spéciales !</p>\r\n<p>Collectionne les trophées en effectuant des figures impressionnantes et débloque tes héros préférés lors des entrainements. </p>', 39.99, 150, '2015-03-27 08:35:51'),
(58, 32, 'VOLANT WII U', 'La Wii U accueille le Wii Wheel.', '<p>La Wii U accueille le Wii Wheel, un volant intégrant la télécommande Wii U qui a donné naissance à une nouvelle manière de piloter et apporter de nouveaux défis aux habitués de la saga tout en permettant aux novices de se mettre en selle facilement et de manière intuitive.</p>\r\n<p>Compatible uniquement avec les jeux adéquats Wii U.</p>', 9.99, 75, '2015-03-27 08:40:13'),
(59, 32, 'MANETTE NUNCHUK WII U NOIRE', 'Connectez le Nunchuk &agrave; la t&eacute;l&eacute;commande Wii U et tenez-vous pr&ecirc;t.', '<p>Connectez le Nunchuk à la télécommande Wii U et tenez-vous prêt. Vous venez de vous immerger dans un nouveau monde où le jeu prend enfin tout son sens. Vous obtenez ainsi deux appareils à la précision remarquable. Ils deviennent votre épée et votre bouclier pour défendre Hyrule dans The Legend of Zelda : Twilight Princess. Ce sont les armes qui vous permettent de vous frayer un chemin dans les corridors exigus de Metroid Prime 3 : Corruption et le monde hostile de Yakuzas de Red Steel.</p>\r\n<p>Le Nunchuk et l''accéléromètre intégré vont donner un nouveau souffle au jeu vidéo. Dans les jeux de tir à la 1ere personne, le périphérique servira à se déplacer et la télécommande Wii dans la main droite permettra de déplacer l''arme et de tirer plus naturellement. Dans un jeu de football américain, vous pourrez déplacer votre quarterback avec le Nunchuk tout en cherchant un receveur à qui lancer le ballon avec la télécommande Wii.</p>', 19.99, 80, '2015-03-27 08:41:59'),
(60, 33, 'PACK NINTENDO WII U BASIC', 'Tout pour bien d&eacute;buter l''aventure Skylanders sur Wii U. . .', '<p>Contenu de la version Basic</p>\r\n<p>- Une console Wii U blanche, avec 8 Go de mémoire</p>\r\n<p>- Le GamePad Wii U</p>\r\n<p>- 2 blocs dalimentation (un pour la console, un pour le Gamepad)</p>\r\n<p>- Un câble HDMI</p>\r\n<p>- Le pack de démarrage Skylanders Trap Team (voir ci-dessous pour la description complète)</p>\r\n<p>Plus grande que la Wii, plus arrondie, la Wii U est la première console HD de Nintendo. Elle est dotée d''un port HDMI et permet tous les types d''affichage, du 480i au 1080p. On peut également la connecter à un téléviseur via câble Component Wii, RGB Wii ou S-Vidéo Wii. Elle est équipée en Wi-Fi et propose un lecteur pour carte SD et 4 ports USB 2.0 (2 en façade, 2 à l''arrière) qui recevront un adaptateur Ethernet, une clé USB ou un disque dur externe.</p>\r\n<p>La manette Wii U</p>\r\n<p>Ce qui fait tout l''intérêt de la Wii U, celui qui donne à nouveau à Nintendo une longueur d''avance sur la concurrence, c''est bien évidemment le fameux GamePad, un écran tactile de 6,2 pouces (15,24 cm) entouré de boutons traditionnels :</p>\r\n<p> Deux sticks analogiques</p>\r\n<p> Une croix directionnelle à gauche</p>\r\n<p> Quatre boutons A/B/X/Y en croix</p>\r\n<p> Start/+ et Select/-</p>\r\n<p> Boutons R et L en positions habituelles</p>\r\n<p> Deux boutons ZR et ZL un peu en dessous, façon gâchettes</p>\r\n<p> Un bouton TV permet de « rendre » l''écran du salon à ceux qui veulent regarder les programmes et de continuer sa partie sur l''écran du GamePad, ou d''utiliser celui-ci pour changer de chaîne.</p>\r\n<p>En liaison sans fil avec la console (infrarouge), le GamePad, assez léger, possède une autonomie de 5 heures et se recharge sur un socle dédié. On peut en connecter au maximum deux à la Wii U. Sa prise en main est très confortable, mais il faut reconnaître qu''il risque d''être mal adaptée aux petites mains des plus jeunes joueurs, qui apprécieront cependant la possibilité de jouer en tactile. Le GamePad ouvre clairement de nouvelles possibilités de jeu, qui vont emmener les joueurs dans des territoires jusqu''à présents insoupçonnés.</p>\r\n<p>Rétrocompatibilité</p>\r\n<p>Côté accessoires, télécommandes Wii ou Wii Plus, Nunchuk, Wii Balance Board et manette classique sont compatibles. Une nouvelle manette Wii U Pro permet aux gamers de tenir en main une manette classique avec ses 10 boutons, 2 joysticks et croix directionnelle, indispensable pour certains jeux.</p>\r\n<p>Contenu du pack de démarrage :</p>\r\n<p>· Le jeu vidéo Skylanders Trap Team</p>\r\n<p>· Le Portail Traptanium – Placez les Skylanders sur le NOUVEAU Portail Traptanium pour leur donner vie</p>\r\n<p>· La figurine Snap Shot : Comme Snap Shot, tous les nouveaux Skylanders Trap Masters peuvent capturer les ennemis plus facilement grâce à leurs puissantes armes en Cristal</p>\r\n<p>· La figurine Food Fight – Un Skylander inédit avec des pouvoirs et une personnalité unique</p>\r\n<p>· 2 Pièges en Cristal – Combattez vos ennemis puis capturez-les dans les Pièges en Cristal afin de les utilisez à vos côtés !</p>\r\n<p>· Le Poster Collector des Personnages – Construisez la Trap Team Ultime : plus de 60 Skylanders à collectionner et plus de 40 ennemis à capturer !</p>\r\n<p>· Cartes à Collectionner – Pour en savoir plus sur les pouvoirs et les capacités de chaque Skylander !</p>\r\n<p>Le jeu</p>\r\n<p>Avec Skylanders Trap Team, les Maîtres du Portail peuvent partir traquer et défaire les Vilains les plus recherchés des Skylands, et les sortir du jeu pour les amener dans leur salon, en les capturant dans des Pièges en Cristal magiques.</p>\r\n<p>Les joueurs peuvent ensuite les renvoyer dans le jeu pour les incarner et les faire combattre à leurs côtés. Le jeu inclut le Portail TraptaniumTM, un nouvel anneau d’énergie magique qui permet aux enfants non seulement de donner vie à leurs Skylanders, mais également d’emprisonner les Vilains grâce aux Pièges en Cristal.</p>\r\n<p>Une fois leurs ennemis vaincus, les joueurs peuvent insérer un Piège en Cristal dans le nouveau portail pour les capturer. Ils peuvent également entendre les méchants à l’intérieur du piège, une innovation qui donne un supplément de vie aux personnages.</p>\r\n<p>Cette nouvelle façon de jouer offre également aux joueurs la possibilité de passer de la peau d’un héros Skylander à celle d’un de leurs ennemis à tout moment. Les fans peuvent emporter leurs Pièges en Cristal et leurs personnages Skylanders chez leurs amis pour des parties en mode coopératif et des aventures amusantes sur tous les types de consoles.</p>', 229.99, 75, '2015-03-27 08:45:56');

-- --------------------------------------------------------

--
-- Structure de la table `eshop_products_comments`
--

CREATE TABLE IF NOT EXISTS `eshop_products_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `eshop_products_comments`
--

INSERT INTO `eshop_products_comments` (`id`, `id_user`, `id_product`, `comment`, `rating`, `date_comment`, `visibility`) VALUES
(15, 2, 33, 'Excellent Jeu ! J''ai ador&eacute; ! Digne successeur de BF4.', 5, '2015-03-24 19:46:19', 1),
(16, 2, 27, 'J''ai vraiment eu tr&egrave;s peur ! Un peu mou quand m&ecirc;me d''o&ugrave; l''&eacute;toile en moins.', 4, '2015-03-24 20:09:03', 0);

-- --------------------------------------------------------

--
-- Structure de la table `eshop_products_images`
--

CREATE TABLE IF NOT EXISTS `eshop_products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `path` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- Contenu de la table `eshop_products_images`
--

INSERT INTO `eshop_products_images` (`id`, `id_product`, `path`) VALUES
(32, 27, 'assets/images/ccb9a3d55cb24b5017f1f30b0ad01577.jpg'),
(33, 27, 'assets/images/d4d57f0dabd4e648fa6143c2635ccc8e.jpg'),
(34, 27, 'assets/images/0f6dd09b45f5ecda7ef8b37aad7faba4.jpg'),
(35, 27, 'assets/images/d8aa78553f16d86fb10528373d4d1d6b.jpg'),
(36, 33, 'assets/images/ebfcc863c29771cb7c430debdf0d702d.jpg'),
(37, 33, 'assets/images/189442d61e71b416de1c87a711d36f57.jpg'),
(38, 33, 'assets/images/5b04cc95c49597ae12dbcaf15a7ec91b.jpg'),
(39, 33, 'assets/images/b818eb6f8cd47a4c2f09f6fece25a1f2.jpg'),
(40, 34, 'assets/images/3f985a9ea06bf48435f28f708c5e9a6f.jpg'),
(41, 34, 'assets/images/5ad4d040365832efcb550d8b201775af.jpg'),
(42, 34, 'assets/images/a6700a966893333fc8ae213d2c319ab5.jpg'),
(43, 34, 'assets/images/4dbf061d2c48fd00852724e90aa62185.jpg'),
(44, 35, 'assets/images/199bb70d74bfd4273dc2901a3ebe240b.jpg'),
(45, 35, 'assets/images/4952e495aa3d56ea0109f31c56f2f43e.jpg'),
(46, 35, 'assets/images/af06fb9ed35bf77be800a24e4b25d5cb.jpg'),
(47, 35, 'assets/images/492d938183bd1080ecfe16d21201e85e.jpg'),
(48, 35, 'assets/images/6e48377d7c782574300d23d9d6645a68.jpg'),
(49, 36, 'assets/images/1f8a831986075493eb1d174cd99634f2.jpg'),
(50, 36, 'assets/images/9ab5c0a7e7ce8cc77e7f8e01ddeac80c.jpg'),
(51, 36, 'assets/images/f9920271d6156e9dca24d89c5017628e.jpg'),
(52, 36, 'assets/images/2685f1916ef20b9273abecea383398f3.jpg'),
(53, 36, 'assets/images/868ffdcb301fffca3bd020074eac5ae6.jpg'),
(54, 37, 'assets/images/f070e156a0d4705fcf1d43c40150eec1.jpg'),
(55, 37, 'assets/images/4dc6b2c464cbe435b68d06cdb1ec4d00.jpg'),
(56, 37, 'assets/images/98bdb21cc14f2220b19225b5c395bcbc.jpg'),
(57, 37, 'assets/images/916e8d340664b99301dba4bf3dffb94e.jpg'),
(58, 37, 'assets/images/53f02958e434b84b3d9ce4b9c2c3adfb.jpg'),
(59, 38, 'assets/images/1773878d994fba515a2bd2d170ba9580.jpg'),
(60, 38, 'assets/images/5d312d4ed91754968e6af15ff7acb703.jpg'),
(61, 38, 'assets/images/7f79390ebaa928463e2e154c56c6415a.jpg'),
(62, 38, 'assets/images/12b15def0d125ce9e9481e71cb1b94c0.jpg'),
(63, 39, 'assets/images/a51ab1b9fe04291847859dfe881def6c.jpg'),
(64, 39, 'assets/images/767e1affd0c7e16105c457565fe0190e.jpg'),
(65, 39, 'assets/images/8a373b0c30fce5924a9fb311aec6fa04.jpg'),
(66, 39, 'assets/images/cc5a639711effd8162be9954735b3869.jpg'),
(67, 40, 'assets/images/1cfb978512b605f88b2587f39437654d.jpg'),
(68, 40, 'assets/images/32b0543ad5873df03226253db287aed2.jpg'),
(69, 40, 'assets/images/63bac702baf0eb9267b3a6880f3981d1.jpg'),
(70, 42, 'assets/images/ba229f4bb031824ef21a30374ce44566.jpg'),
(71, 42, 'assets/images/86f990a31dfe075c97087b0d5406e70e.jpg'),
(72, 42, 'assets/images/19a3ecb2b8e149560b0a6e3afeeea66d.jpg'),
(73, 43, 'assets/images/dce2f3fba85db7e03b09a959a76b5496.jpg'),
(74, 43, 'assets/images/ad91c5a29120ecad81b408244108bbea.jpg'),
(75, 43, 'assets/images/a4cc645b25b130cf382ce314a050e037.jpg'),
(76, 43, 'assets/images/0aa914f1ad2102a3d885b191a1db905c.jpg'),
(77, 44, 'assets/images/1891c95ea1f7db88dde84e6017160a03.jpg'),
(78, 44, 'assets/images/c651f35229467e3bdd22a5e0adce34ab.jpg'),
(79, 44, 'assets/images/b631db022a52162d95e49d31180204f9.jpg'),
(84, 46, 'assets/images/91a47e4004546424c96a712c5e4317fb.jpg'),
(85, 46, 'assets/images/3eed31ac198bead9cb47d7c058c62a88.jpg'),
(86, 46, 'assets/images/205b98089d99fe3a5f77b939bb90df1a.jpg'),
(87, 46, 'assets/images/df3a85432cbd8dc6991f15aaa12afa31.jpg'),
(88, 47, 'assets/images/194090d023c822a466b14cf422e7040f.jpg'),
(89, 48, 'assets/images/6bcbe784c6d406a14b03a5c8a7996422.jpg'),
(90, 49, 'assets/images/524d37bd1fce416e01d14343903b6acd.jpg'),
(91, 49, 'assets/images/7aa69550c1e792cd848f9aefb28d578f.jpg'),
(92, 49, 'assets/images/d707f5e90d1d2afec93973932ce5ebcb.jpg'),
(93, 49, 'assets/images/f4c98e1c7eea5e38587d3869f2abddcf.jpg'),
(94, 50, 'assets/images/2655171139b4729845c8614e30ac1ab1.jpg'),
(95, 50, 'assets/images/ebcd902fddf0c3865c7582855499cbea.jpg'),
(96, 50, 'assets/images/37f6433d8dd4d14d8709fa157f81783d.jpg'),
(97, 50, 'assets/images/58805bf1e4832d305454730f6cf6a8c1.jpg'),
(98, 51, 'assets/images/aea6403fbb626b22059b3eeed4b54d17.jpg'),
(99, 51, 'assets/images/4193dd04a386e0ff8d389a3eeff9dce6.jpg'),
(100, 51, 'assets/images/4cf285e4f447962c6abfbacb92c5f42b.jpg'),
(101, 51, 'assets/images/00e4dbfa42e145a3bde838ccad8c2a8b.jpg'),
(102, 52, 'assets/images/3f360fbf2aeac96ec3f1f5bd56cd9cfe.png'),
(103, 52, 'assets/images/46221b3b73844845ec2e54133e48bffa.png'),
(104, 54, 'assets/images/f4b4ffb428a69a41cdd0b9346960364f.png'),
(105, 55, 'assets/images/6e39bbdb195c2623dc6c8bd8706a1bdf.jpg'),
(106, 55, 'assets/images/10c247923261e590da38cf1429ae3be7.jpg'),
(107, 55, 'assets/images/6069ba9d3ca8f1b898e6d4b7bb7630ea.jpg'),
(108, 56, 'assets/images/0485ef6c3a7e6c5a8d4b44e076e5ebe9.jpg'),
(109, 56, 'assets/images/d53d13f4aec9bfaff028004c4e66883c.jpg'),
(110, 56, 'assets/images/4edeaaf0c0164e6665960f5ab3415aba.jpg'),
(111, 56, 'assets/images/215739fe2f69337a85a699b65c9da5ba.jpg'),
(112, 57, 'assets/images/61c4db350de98f335b370f40c0901e20.jpg'),
(113, 57, 'assets/images/7f01c9cce8aecd49c40e4bb8d6e56341.jpg'),
(114, 57, 'assets/images/3b48723c3a76f28b0e8ec02d6225a95b.jpg'),
(115, 57, 'assets/images/20a1113a0b256ae88a6cf0b82e5ac753.jpg'),
(116, 59, 'assets/images/e43e81c9816316dabd55f928d81a7099.jpg'),
(117, 60, 'assets/images/f1a3fd31e489216f0853502392bc8401.jpg'),
(118, 60, 'assets/images/32eed6b351e0fda98d14b4d97aef8417.jpg'),
(119, 60, 'assets/images/a2817c13207a3054efaa822f5f0132fe.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `eshop_products_vignette`
--

CREATE TABLE IF NOT EXISTS `eshop_products_vignette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `path` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `eshop_products_vignette`
--

INSERT INTO `eshop_products_vignette` (`id`, `id_product`, `path`) VALUES
(28, 27, 'assets/vignette/d95f57280260c867cf5a9fb86d57207b.jpg'),
(31, 28, 'assets/vignette/b367a7d1fe74ced79c72424ce97a4f62.jpg'),
(32, 33, 'assets/vignette/1d2546cc493d37739ad4dd89ea700f68.jpg'),
(33, 34, 'assets/vignette/d9c65d54d7db764bad16da57a2eb5477.jpg'),
(34, 35, 'assets/vignette/1b147cd1ff70cdfb80ab52930727902c.jpg'),
(36, 36, 'assets/vignette/630a1fbd480c68843a8c20164afd8dc3.jpg'),
(37, 37, 'assets/vignette/b13e3da10a136826f19e51892bac2af8.jpg'),
(38, 38, 'assets/vignette/1e1848fcd1ec1c6d9bd22f40f4d92b73.jpg'),
(39, 39, 'assets/vignette/1832e5473fb3d5ac3b41f3539d5e6f70.jpg'),
(40, 40, 'assets/vignette/9363520d1a1280810433d492a39b3f14.jpg'),
(41, 41, 'assets/vignette/87c295b340d6631a60a89f2a484c2565.jpg'),
(42, 42, 'assets/vignette/e1986ccdc4d79faf6818ec8230c9889c.jpg'),
(44, 43, 'assets/vignette/c230a29b24c8e8a0c4ddb8e6543dc8f8.jpg'),
(45, 44, 'assets/vignette/8a1d6f1e9d10c8d60f74e2a361066aed.jpg'),
(47, 46, 'assets/vignette/413cfb5d5a33b52cea14ae2029503266.jpg'),
(49, 47, 'assets/vignette/315e4ca1c0b0c6cd230e9fbec86167e3.jpg'),
(50, 48, 'assets/vignette/ea9d9cabf5d46674ccac9873b855f21a.jpg'),
(51, 49, 'assets/vignette/5e6f4a88ccf66ff1312a4c78d3411e1d.jpg'),
(53, 50, 'assets/vignette/d957f8840d38ebb022e513e8a499a931.jpg'),
(54, 51, 'assets/vignette/7fbbefe32fd28efed0de3ce934700dbd.jpg'),
(55, 52, 'assets/vignette/48008ddb065d4400ed3c91fce361d7fd.jpg'),
(57, 53, 'assets/vignette/d71dfcb35230aff28b3b9c72c2a01c45.jpg'),
(58, 54, 'assets/vignette/af1ecde941d701d28eadf8cfc93e845e.jpg'),
(59, 55, 'assets/vignette/1342f9eccacf7098a5349c77d1a45f18.jpg'),
(60, 56, 'assets/vignette/5d8f03fe07c44f479a381426d26cced1.jpg'),
(61, 57, 'assets/vignette/266cf0fc22b47c1c063d8335a6ce075c.jpg'),
(62, 58, 'assets/vignette/b4285397ed28ecbdbacd2caaee581d68.jpg'),
(63, 59, 'assets/vignette/28c14e7892f485c2b7c5b5baa232cd5b.jpg'),
(64, 60, 'assets/vignette/e4c997464f4fde73c15602712899c467.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `eshop_shipping`
--

CREATE TABLE IF NOT EXISTS `eshop_shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  `cost` float NOT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `eshop_shipping`
--

INSERT INTO `eshop_shipping` (`id`, `name`, `description`, `cost`, `priority`, `active`) VALUES
(1, 'La Poste', 'Livraison standard par La Poste. Réception en 48/72h.', 4.99, 0, 1),
(2, 'Chronopost', 'Livraison 24h chrono. Traitement prioritaire.', 11.99, 1, 1),
(7, 'TNT', 'Livraison en seulement 24h. Traitement prioritaire de votre commande.', 14.95, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `eshop_users`
--

CREATE TABLE IF NOT EXISTS `eshop_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `ip_register` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `eshop_users`
--

INSERT INTO `eshop_users` (`id`, `login`, `email`, `password`, `ip_register`, `status`, `date_register`) VALUES
(1, 'admin', 'admin@mail.fr', '$2y$10$FbIbXYDNpMGSIRa2SCHl/.aJUoAeo6THwlUTSiHroF78ZWa0rAit2', '192.168.0.1', 1, '2015-03-15 10:14:54'),
(2, 'user', 'yorkknew@hotmail.fr', '$2y$10$vRdNT4ewl7yUDI87uGe0iugPQhYL9Ev8uPlSao2yvOicJ7abJOR4y', '127.0.0.1', 0, '2015-03-16 19:28:58');

-- --------------------------------------------------------

--
-- Structure de la table `eshop_users_details`
--

CREATE TABLE IF NOT EXISTS `eshop_users_details` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(64) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `eshop_users_details`
--

INSERT INTO `eshop_users_details` (`id_user`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`) VALUES
(2, 'Nom', 'Prénom', 'XY rue des rossignols', 75001, 'Paris', '0123456789');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
