-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 avr. 2026 à 14:26
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vue` int(11) NOT NULL DEFAULT 0,
  `status` enum('brouillon','publié') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brouillon',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `id_user`, `id_categorie`, `titre`, `description`, `tag`, `vue`, `status`, `slug`, `likes`, `media`, `featured`, `created_at`, `updated_at`) VALUES
(9, 1, 4, 'Piscines & Loisirs', '<p>Sécuriser et entretenir votre bassin : les bonnes pratiques pour une piscine durable et sans danger</p><p>Avoir une piscine chez soi est un véritable plaisir : détente, moments en famille, loisirs et confort au quotidien. Cependant, pour profiter pleinement de votre bassin sur le long terme, il est essentiel de garantir sa sécurité et de l’entretenir correctement. Une piscine mal sécurisée ou mal entretenue peut rapidement devenir dangereuse et entraîner des coûts importants de réparation.</p><p>Dans cet article, découvrez les conseils indispensables pour sécuriser et entretenir votre piscine, tout en préservant la qualité de l’eau et la durée de vie de vos équipements.</p><p>1. Pourquoi sécuriser sa piscine est indispensable ?</p><p>La piscine est un espace de loisir, mais elle représente également un risque, notamment pour les enfants. Les accidents domestiques liés aux piscines restent fréquents, surtout en période de forte chaleur.</p><p>Sécuriser votre bassin permet :</p><p>de prévenir les noyades et chutes accidentelles,<br>de respecter les obligations légales dans plusieurs pays,<br>d’éviter les intrusions,<br>de protéger votre piscine des saletés extérieures.</p><p>Une bonne sécurité, combinée à un entretien régulier, garantit une utilisation sereine de votre piscine.</p><p>2. Les équipements essentiels pour sécuriser votre piscine<br>a) La barrière de protection</p><p>La barrière est l’un des systèmes les plus efficaces pour empêcher l’accès au bassin. Elle doit être suffisamment haute et dotée d’un portail sécurisé.</p><p>C’est une solution idéale si vous avez des enfants ou si votre piscine est située dans une zone facilement accessible.</p><p>b) La couverture de sécurité</p><p>La couverture ou bâche de sécurité protège le bassin tout en limitant l’évaporation de l’eau et l’accumulation de feuilles ou poussières.</p><p>Elle présente plusieurs avantages :</p><p>sécurité renforcée,<br>meilleure propreté,<br>réduction des coûts d’entretien.<br>c) L’alarme de piscine</p><p>L’alarme est un dispositif pratique qui détecte les chutes ou mouvements dans l’eau. Elle ne remplace pas la surveillance humaine, mais elle agit comme une protection supplémentaire.</p><p>d) L’abri de piscine</p><p>L’abri est une solution haut de gamme, mais très efficace. Il permet de sécuriser totalement la piscine, tout en protégeant l’eau des intempéries et en prolongeant la saison de baignade.</p><p>3. Les règles de sécurité à respecter au quotidien</p><p>Même avec un équipement de sécurité, certaines habitudes sont indispensables.</p><p>Voici les bonnes pratiques à appliquer :</p><p>Ne jamais laisser un enfant sans surveillance près de la piscine.<br>Ranger les jouets flottants après utilisation pour éviter d’attirer les enfants.<br>Installer une zone antidérapante autour du bassin.<br>Prévoir une perche, une bouée et une trousse de secours à proximité.<br>Éviter de courir sur la plage de piscine.</p><p>La sécurité repose avant tout sur la vigilance et la prévention.</p><p>4. L’entretien régulier : la clé d’une piscine propre et saine</p><p>Une piscine propre ne dépend pas uniquement du filtre. Elle nécessite une routine d’entretien rigoureuse.</p><p>a) Nettoyage du bassin</p><p>Pour éviter les dépôts et les algues :</p><p>utilisez une épuisette pour enlever les feuilles,<br>brossez les parois et le fond régulièrement,<br>passez l’aspirateur ou un robot de piscine au moins une fois par semaine.</p><p>Un bassin bien nettoyé réduit la consommation de produits chimiques.</p><p>b) Filtration : le cœur du système</p><p>La filtration est l’élément principal pour maintenir une eau claire. En été, il est conseillé de faire fonctionner la pompe plusieurs heures par jour.</p><p>En général :</p><p>plus il fait chaud, plus la filtration doit être longue,<br>une eau trouble est souvent liée à une filtration insuffisante.</p><p>Pensez aussi à nettoyer régulièrement le panier du skimmer et le préfiltre de la pompe.</p><p>5. Surveiller l’équilibre de l’eau : un geste incontournable</p><p>Une eau bien équilibrée évite :</p><p>les irritations de la peau et des yeux,<br>la formation d’algues,<br>la corrosion des équipements.<br>a) Le pH</p><p>Le pH doit rester stable. Une eau trop acide ou trop basique devient agressive et inefficace face aux bactéries.</p><p>b) Le chlore ou désinfectant</p><p>Le chlore est l’un des désinfectants les plus utilisés. Il élimine les microbes et garantit une eau saine.</p><p>D’autres solutions existent :</p><p>brome (plus doux),<br>électrolyse au sel,<br>oxygène actif.<br>c) L’alcalinité et la dureté de l’eau</p><p>Une alcalinité correcte stabilise le pH. La dureté, quant à elle, limite les dépôts de calcaire.</p><p>Pour un entretien efficace, il est conseillé de tester l’eau au moins une fois par semaine.</p><p>6. Prévenir les algues et l’eau verte</p><p>L’eau verte est l’un des problèmes les plus fréquents en piscine. Elle est souvent causée par :</p><p>une filtration trop faible,<br>un désinfectant insuffisant,<br>un pH mal réglé,<br>une chaleur excessive.</p><p>Pour éviter cela :</p><p>utilisez un traitement préventif anti-algues,<br>couvrez votre bassin lorsque vous ne l’utilisez pas,<br>vérifiez la qualité de l’eau régulièrement.</p><p>Si l’eau devient verte, il faut agir rapidement avec un traitement choc adapté.</p><p>7. L’entretien des équipements : une étape souvent négligée</p><p>Les équipements doivent être entretenus pour fonctionner correctement et durer longtemps.</p><p>a) Filtre à sable, filtre à cartouche ou filtre à diatomées</p><p>Chaque filtre a ses spécificités :</p><p>le filtre à sable nécessite un contre-lavage,<br>la cartouche doit être nettoyée et remplacée périodiquement,<br>la diatomée demande plus de rigueur mais offre une excellente finesse de filtration.<br>b) Pompe et skimmers</p><p>Une pompe qui force ou fait du bruit peut signaler un encrassement. Nettoyez régulièrement les paniers et surveillez la pression du filtre.</p><p>c) Chauffage et éclairage</p><p>Si vous utilisez un système de chauffage, veillez à ce qu’il soit protégé du calcaire et correctement ventilé. Pour l’éclairage, vérifiez l’étanchéité des projecteurs.</p><p>8. Hivernage : protéger votre piscine pendant la saison froide</p><p>Lorsque la baignade n’est plus fréquente, il est conseillé de préparer votre piscine pour l’hiver.</p><p>Deux solutions existent :</p><p>a) Hivernage actif</p><p>La filtration continue de fonctionner au ralenti et l’eau est entretenue régulièrement.</p><p>b) Hivernage passif</p><p>La piscine est mise à l’arrêt complet, avec une couverture adaptée et un traitement spécial.</p><p>L’hivernage protège les équipements contre le gel et évite les mauvaises surprises au retour des beaux jours.</p>', NULL, 0, 'publié', 'piscines-loisirs-1775815383', 0, 'blog/fgpnuz84r7TrcIH7vgtGXZvDJOSDUghnEpye3bFa.jpg', 0, '2026-04-10 09:03:04', '2026-04-10 09:03:04'),
(11, 1, 2, 'Les 5 zones à fort potentiel pour investir à Cotonou', '<p>Les 5 zones à fort potentiel pour investir à Cotonou</p><p>Cotonou n’est pas seulement la capitale économique du Bénin : c’est aussi l’un des marchés immobiliers les plus dynamiques de la sous-région. Entre l’urbanisation accélérée, la demande croissante en logements modernes et la montée des investissements privés, la ville devient un terrain stratégique pour celles et ceux qui souhaitent bâtir un patrimoine solide.</p><p>Mais dans l’immobilier, tout se joue sur un point essentiel : l’emplacement. Acheter au bon endroit, au bon moment, peut transformer un simple achat en véritable opportunité de rentabilité.</p><p>Voici 5 zones à fort potentiel à Cotonou, à surveiller de près si vous souhaitez investir intelligemment.</p><p>1. Fidjrossè : la valeur sûre qui ne cesse de monter</p><p>Quand on parle d’immobilier à Cotonou, Fidjrossè s’impose comme une évidence. Quartier côtier, apprécié pour son cadre de vie et sa proximité avec la plage, Fidjrossè attire une clientèle variée : familles, expatriés, entrepreneurs et touristes.</p><p>Ce qui fait la force de Fidjrossè, c’est son équilibre entre confort résidentiel et dynamisme économique. Les logements y trouvent rapidement preneur, notamment en location meublée ou longue durée.</p><p>Pourquoi investir ici ?</p><p>Forte demande locative<br>Quartier recherché par les expatriés<br>Potentiel intéressant pour les résidences modernes et les appartements</p><p>👉 Fidjrossè est un choix stratégique pour un investissement sécurisé et durable.</p><p>2. Akpakpa : l’eldorado discret en pleine transformation</p><p>Longtemps sous-estimé, Akpakpa connaît depuis quelques années une montée en puissance progressive. Ce quartier vaste et densément peuplé bénéficie d’une localisation stratégique : proche du centre-ville, avec un accès direct vers plusieurs axes importants.</p><p>Aujourd’hui, Akpakpa attire les investisseurs qui recherchent des terrains encore accessibles et un marché locatif extrêmement actif. Avec l’amélioration progressive des infrastructures et des routes, la valeur foncière suit naturellement la tendance.</p><p>Pourquoi investir ici ?</p><p>Prix souvent plus abordables que dans d’autres zones<br>Forte demande en logements<br>Zone idéale pour immeubles locatifs ou maisons à louer</p><p>👉 Akpakpa, c’est l’investissement malin : moins cher aujourd’hui, plus rentable demain.</p><p>3. Haie Vive : le quartier premium au fort rendement locatif</p><p>Haie Vive est l’un des quartiers les plus prestigieux de Cotonou. Très fréquenté, bien structuré et proche de zones commerciales importantes, il attire une clientèle haut de gamme : cadres, diplomates, expatriés, entreprises et touristes d’affaires.</p><p>C’est également un secteur réputé pour son animation, ses restaurants, ses hôtels et ses commerces. Résultat : la demande en location y est constante, et les biens immobiliers gardent une excellente valeur sur le long terme.</p><p>Pourquoi investir ici ?</p><p>Quartier premium avec forte attractivité<br>Excellent rendement locatif sur les appartements modernes<br>Zone idéale pour location meublée ou bureaux</p><p>👉 Haie Vive est parfaite pour ceux qui veulent investir dans l’immobilier haut standing.</p><p>4. Agla : le potentiel en expansion pour les investisseurs visionnaires</p><p>Agla est l’un des quartiers les plus actifs et en croissance de Cotonou. Sa popularité vient notamment de sa position stratégique : proche du centre-ville tout en restant accessible.</p><p>C’est une zone où la demande de logements est forte, notamment pour les familles et les jeunes actifs. De plus, la densification urbaine pousse naturellement les prix à la hausse, ce qui rend l’investissement particulièrement intéressant pour ceux qui souhaitent acheter avant que le marché ne devienne trop cher.</p><p>Pourquoi investir ici ?</p><p>Quartier en pleine expansion<br>Bonne rentabilité sur logements familiaux<br>Forte dynamique commerciale et résidentielle</p><p>👉 Agla représente un excellent compromis entre prix raisonnable et croissance future.</p><p>5. Zogbo et ses environs : un marché locatif très actif</p><p>Zogbo est un quartier vivant, populaire et très fréquenté. Son principal atout est son activité économique et son flux permanent de population, ce qui crée un marché locatif naturellement dynamique.</p><p>Dans ce type de zone, les investisseurs peuvent miser sur des logements à budget moyen, des petites maisons, ou même des immeubles à plusieurs chambres destinées à la location.</p><p>Même si Zogbo est parfois moins “prestigieux” que d’autres quartiers, il peut offrir une rentabilité intéressante, car la demande est constante.</p><p>Pourquoi investir ici ?</p><p>Forte demande locative continue<br>Possibilité de rentabilité rapide<br>Zone idéale pour location de chambres, studios ou petits logements</p><p>👉 Zogbo est une zone rentable, surtout pour ceux qui veulent générer des revenus rapidement.</p><p>Comment choisir la meilleure zone pour investir ?</p><p>Avant de vous lancer, posez-vous les bonnes questions. Un bon investissement immobilier à Cotonou dépend de plusieurs facteurs :</p><p>Votre objectif : location, revente, résidence personnelle ?<br>Votre budget : terrain, construction, achat direct ?<br>Le type de clientèle visée : étudiants, familles, expatriés, entreprises ?<br>L’accessibilité : routes, transports, proximité des services<br>La sécurité juridique : titre foncier, certificat, documents officiels</p><p>Le meilleur conseil reste celui-ci : investir avec prudence, mais investir tôt. Car à Cotonou, le marché évolue vite et les opportunités se raréfient dans les zones les plus recherchées.</p><p>Conclusion : Cotonou, une ville où l’immobilier reste une opportunité</p><p>Investir à Cotonou est aujourd’hui un choix stratégique pour construire un patrimoine rentable. Des quartiers comme Fidjrossè et Haie Vive restent des valeurs sûres, tandis que Akpakpa, Agla et Zogbo représentent des opportunités intéressantes pour ceux qui souhaitent anticiper la croissance urbaine.</p><p>Dans tous les cas, la clé du succès est simple : bien choisir la zone, sécuriser les documents, et penser long terme.</p>', NULL, 0, 'publié', 'les-5-zones-a-fort-potentiel-pour-investir-a-cotonou-11', 0, 'blog/Ha6GlvBP5F4L06M75HZIoYIB96AL5s66jL40ikKc.webp', 1, '2026-04-10 10:14:58', '2026-04-10 11:16:09'),
(12, 1, 2, 'Pourquoi privilégier nos savons artisanaux NAKAYO ?', '<p>Dans un monde où les produits industriels envahissent nos salles de bain, de plus en plus de personnes recherchent des alternatives plus saines, plus naturelles et plus respectueuses de la peau. Le savon, produit du quotidien par excellence, n’échappe pas à cette tendance. Pourtant, tous les savons ne se valent pas.</p><p>Chez NAKAYO, nous avons fait le choix de proposer des savons artisanaux conçus avec passion, dans le respect des traditions et des besoins réels de la peau. Mais pourquoi privilégier un savon artisanal NAKAYO plutôt qu’un savon classique vendu en grande surface ?</p><p>Découvrons ensemble ce qui fait toute la différence.</p><p>1. Un savon fabriqué avec soin, loin des procédés industriels</p><p>Les savons industriels sont souvent fabriqués à grande échelle, avec des procédés rapides, parfois agressifs pour la peau. Ils contiennent fréquemment des agents chimiques, des conservateurs ou des parfums synthétiques qui peuvent provoquer des irritations, surtout sur les peaux sensibles.</p><p>À l’inverse, les savons artisanaux NAKAYO sont conçus avec une attention particulière à chaque étape : formulation, dosage, mélange, séchage et finition. Cette fabrication maîtrisée garantit un produit plus authentique et plus doux.</p><p>Choisir NAKAYO, c’est choisir un savon fait avec sérieux, patience et précision.</p><p>2. Une composition plus naturelle et plus saine pour la peau</p><p>La peau est un organe fragile. Elle absorbe une partie des produits qu’on applique quotidiennement. C’est pourquoi il est important de privilégier des soins avec des ingrédients de qualité.</p><p>Nos savons artisanaux NAKAYO sont formulés avec des matières premières sélectionnées pour leurs bienfaits : huiles végétales, beurres naturels, extraits de plantes, et autres ingrédients reconnus pour nourrir et protéger la peau.</p><p>Contrairement aux savons industriels qui peuvent assécher, les savons artisanaux apportent souvent une sensation de confort après utilisation.</p><p>Résultat : une peau plus souple, plus propre et mieux protégée.</p><p>3. Un savon plus doux, adapté à tous les types de peau</p><p>Certaines personnes souffrent de peau sèche, d’irritations, de démangeaisons ou encore d’une sensibilité aux produits parfumés. Les savons industriels peuvent aggraver ces problèmes en détruisant le film protecteur naturel de la peau.</p><p>Les savons NAKAYO sont pensés pour offrir un nettoyage efficace tout en respectant l’équilibre cutané. Leur mousse est agréable, et leur texture permet une utilisation quotidienne sans agression.</p><p>Que vous ayez une peau :</p><p>sèche,<br>grasse,<br>sensible,<br>ou mixte,</p><p>vous trouverez chez NAKAYO un savon qui correspond à vos besoins.</p><p>4. Une efficacité réelle : nettoyer, purifier et prendre soin</p><p>Un bon savon ne doit pas seulement sentir bon. Il doit surtout être efficace. Nos savons artisanaux NAKAYO sont conçus pour répondre à des besoins concrets :</p><p>éliminer les impuretés,<br>purifier la peau,<br>réduire l’excès de sébum,<br>laisser une sensation de fraîcheur durable,<br>contribuer à un teint plus net et plus uniforme.</p><p>Certains savons sont également appréciés pour leur action sur les imperfections ou les petites irrégularités de la peau.</p><p>NAKAYO, c’est l’alliance entre hygiène et soin.</p><p>5. Un parfum agréable et naturel, sans agressivité</p><p>Le parfum est un élément important dans l’expérience d’utilisation. Mais un parfum trop fort ou trop chimique peut irriter la peau ou provoquer des réactions chez certaines personnes.</p><p>Nos savons NAKAYO sont conçus avec des senteurs agréables et équilibrées. L’objectif est simple : offrir un savon qui donne envie d’être utilisé chaque jour, sans être agressif.</p><p>Chaque utilisation devient ainsi un moment de plaisir et de bien-être.</p><p>6. Un choix économique sur le long terme</p><p>On pense parfois que les savons artisanaux coûtent plus cher. Pourtant, ils sont souvent plus rentables qu’on ne le croit.</p><p>Pourquoi ?</p><p>ils sont plus concentrés,<br>ils fondent moins vite lorsqu’ils sont bien conservés,<br>une petite quantité suffit pour bien se laver.</p><p>Un savon NAKAYO bien utilisé peut durer plus longtemps qu’un savon industriel classique.</p><p>C’est donc un investissement intelligent pour votre peau et votre budget.</p><p>7. Encourager une marque locale et un savoir-faire authentique</p><p>Privilégier NAKAYO, ce n’est pas seulement acheter un savon : c’est soutenir une vision.</p><p>C’est encourager :</p><p>la production artisanale,<br>le travail local,<br>l’entrepreneuriat,<br>et la valorisation des produits de qualité.</p><p>En choisissant nos savons, vous participez au développement d’une marque qui met l’humain, la qualité et la satisfaction client au centre de ses priorités.</p><p>8. Un engagement pour une hygiène plus responsable</p><p>Aujourd’hui, les consommateurs deviennent plus conscients de l’impact environnemental des produits qu’ils utilisent. Les savons artisanaux, en général, s’inscrivent dans une démarche plus responsable : moins de produits chimiques, moins de packaging excessif, plus de simplicité.</p><p>Avec NAKAYO, nous croyons qu’il est possible de prendre soin de soi tout en respectant la nature et en adoptant une consommation plus réfléchie.</p><p>Conclusion : NAKAYO, bien plus qu’un savon</p><p>Choisir un savon artisanal NAKAYO, c’est faire un choix de qualité. C’est privilégier un produit conçu avec attention, pensé pour le bien-être de la peau et fabriqué dans une démarche plus naturelle.</p><p>Nos savons ne sont pas de simples produits d’hygiène. Ce sont des soins du quotidien qui transforment votre routine en un moment de confort et de plaisir.</p><p>NAKAYO, c’est l’art du savon au service de votre peau.</p>', NULL, 0, 'publié', 'pourquoi-privilegier-nos-savons-artisanaux-nakayo-1775820129', 0, 'blog/pv1CZOADEQ4GCkcijJEzNVJcD9ugjXDCvnsCtSiX.jpg', 0, '2026-04-10 10:22:09', '2026-04-10 10:22:09'),
(13, 1, 2, 'Moderniser l&#039;élevage pour une autonomie alimentaire', '<p>Moderniser l’élevage pour une autonomie alimentaire : un levier stratégique pour l’agro-industrie</p><p>Dans de nombreux pays africains, l’élevage occupe une place essentielle dans l’économie et la vie quotidienne. Il représente une source importante de revenus, de protéines animales et d’emplois. Pourtant, malgré ce potentiel, le secteur reste souvent confronté à des difficultés majeures : faible productivité, manque d’infrastructures, maladies animales, alimentation insuffisante, ou encore dépendance aux importations de produits carnés et laitiers.</p><p>Face à ces défis, une solution s’impose : moderniser l’élevage. Cette transformation n’est pas seulement une évolution technique, c’est un véritable projet de société. Moderniser l’élevage, c’est permettre aux pays de renforcer leur production locale et de tendre vers une autonomie alimentaire durable.</p><p>1. Pourquoi moderniser l’élevage est devenu indispensable ?</p><p>La croissance démographique et l’urbanisation augmentent rapidement la demande en viande, lait et œufs. Or, l’élevage traditionnel, bien qu’essentiel, ne parvient pas toujours à satisfaire ces besoins.</p><p>Les conséquences sont visibles :</p><p>augmentation des importations de viande congelée et de produits laitiers,<br>hausse des prix sur les marchés locaux,<br>difficulté à garantir une qualité sanitaire constante,<br>pertes économiques pour les producteurs locaux.</p><p>Moderniser l’élevage permet donc de passer d’une production de survie à une production rentable, structurée et capable d’alimenter les populations.</p><p>2. Une meilleure alimentation animale : la base de la productivité</p><p>L’un des problèmes majeurs dans l’élevage est l’alimentation. Beaucoup d’éleveurs dépendent encore des pâturages naturels, souvent insuffisants en saison sèche.</p><p>Pour améliorer la productivité, il est nécessaire de :</p><p>développer des cultures fourragères (maïs fourrager, luzerne, herbes améliorées),<br>produire des aliments composés localement,<br>utiliser des compléments nutritionnels adaptés aux besoins des animaux,<br>mettre en place des réserves de fourrage pour les périodes difficiles.</p><p>Une alimentation équilibrée améliore :</p><p>la croissance des animaux,<br>la production laitière,<br>la reproduction,<br>et la résistance aux maladies.</p><p>Ainsi, l’élevage devient plus stable et plus rentable.</p><p>3. L’amélioration des races : produire mieux avec moins de pertes</p><p>Moderniser l’élevage, c’est aussi investir dans la génétique animale. Certaines races locales sont résistantes mais peu productives, tandis que d’autres races améliorées produisent davantage mais nécessitent un meilleur encadrement.</p><p>L’objectif est de trouver un équilibre grâce à :</p><p>la sélection des meilleurs reproducteurs,<br>l’insémination artificielle,<br>les croisements contrôlés,<br>la formation des éleveurs sur la gestion reproductive.</p><p>Une meilleure génétique permet d’obtenir :</p><p>des animaux plus performants,<br>un meilleur rendement viande/lait,<br>une réduction du temps d’élevage,<br>une hausse des revenus.<br>4. La santé animale : un pilier de l’élevage moderne</p><p>Les maladies animales sont responsables de pertes énormes dans les exploitations. Beaucoup d’éleveurs manquent d’accès aux vétérinaires, aux vaccins ou aux médicaments adaptés.</p><p>Un élevage moderne doit intégrer :</p><p>un calendrier de vaccination strict,<br>des contrôles sanitaires réguliers,<br>une hygiène renforcée dans les bâtiments,<br>une bonne gestion des déchets animaux,<br>des mesures de biosécurité pour limiter les contaminations.</p><p>En réduisant les maladies, on améliore la productivité, mais surtout on protège la population contre certaines zoonoses (maladies transmissibles de l’animal à l’homme).</p><p>5. L’élevage industriel et semi-industriel : une opportunité pour l’agro-industrie</p><p>Le passage à un modèle semi-industriel ou industriel ouvre de grandes perspectives économiques. Il permet de répondre à une demande croissante tout en créant une chaîne de valeur complète.</p><p>Un élevage moderne peut alimenter :</p><p>les boucheries et supermarchés,<br>les industries de transformation de viande,<br>les laiteries,<br>les unités de production d’œufs,<br>les fabricants d’aliments pour bétail.</p><p>Ainsi, l’élevage ne reste plus une activité isolée : il devient un pilier central de l’agro-industrie.</p><p>6. La transformation des produits animaux : créer plus de valeur localement</p><p>Produire plus, c’est bien. Mais transformer, c’est encore mieux.</p><p>Un pays peut atteindre une autonomie alimentaire durable s’il développe des unités de transformation capables de produire localement :</p><p>du lait pasteurisé,<br>du fromage et du yaourt,<br>des saucisses et charcuteries,<br>de la viande conditionnée,<br>des œufs emballés et calibrés.</p><p>La transformation permet :</p><p>de réduire les pertes après production,<br>d’augmenter les revenus des producteurs,<br>de créer des emplois dans les industries,<br>de mieux contrôler la qualité des aliments.</p><p>C’est un levier puissant pour réduire les importations et renforcer l’économie nationale.</p><p>7. Les technologies modernes au service de l’élevage</p><p>Aujourd’hui, la technologie offre des solutions accessibles même aux petites exploitations.</p><p>On peut moderniser l’élevage grâce à :</p><p>la gestion numérique des troupeaux (applications mobiles),<br>la surveillance des performances (poids, reproduction, croissance),<br>les systèmes d’abreuvement automatique,<br>les incubateurs modernes en aviculture,<br>les bâtiments ventilés et bien aménagés.</p><p>Ces outils améliorent le rendement et permettent aux éleveurs de mieux contrôler leur production.</p><p>8. Le rôle de la formation et de l’accompagnement des éleveurs</p><p>La modernisation ne dépend pas uniquement des équipements. Elle repose aussi sur les compétences humaines.</p><p>Il est essentiel de former les éleveurs sur :</p><p>l’alimentation animale,<br>la reproduction,<br>la gestion sanitaire,<br>la gestion financière d’une exploitation,<br>les techniques de conservation et transformation.</p><p>Avec une meilleure formation, l’éleveur devient un véritable entrepreneur agricole capable d’optimiser ses ressources.</p><p>9. Une modernisation qui contribue à l’autonomie alimentaire</p><p>Moderniser l’élevage contribue directement à l’autonomie alimentaire de plusieurs façons :</p><p>augmentation de la production locale de protéines animales,<br>baisse des importations de viande et lait,<br>amélioration de la qualité nutritionnelle des populations,<br>stabilisation des prix sur le marché,<br>création d’emplois et réduction de la pauvreté rurale.</p><p>Un pays qui maîtrise sa production animale devient plus résilient face aux crises économiques et aux variations du marché mondial.</p><p>Conclusion : moderniser l’élevage, un investissement d’avenir</p><p>L’autonomie alimentaire ne peut être atteinte sans une production animale solide et structurée. Moderniser l’élevage est donc une priorité pour tout pays souhaitant renforcer son agriculture et développer son industrie agroalimentaire.</p><p>Cela nécessite des investissements, mais aussi une vision claire : améliorer l’alimentation animale, renforcer la santé des troupeaux, développer la transformation et intégrer les nouvelles technologies.</p><p>L’élevage moderne n’est pas seulement une activité rurale : c’est une véritable opportunité économique, un moteur de croissance et un pilier stratégique de l’agro-industrie</p>', NULL, 0, 'publié', 'moderniser-l039elevage-pour-une-autonomie-alimentaire-13', 0, 'blog/eyzKNhbZc5nU0smkVOcXGg8xQdqU0dGR1VrgLKAU.jpg', 0, '2026-04-10 10:25:53', '2026-04-10 11:15:56');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` bigint(20) UNSIGNED NOT NULL,
  `id_article` bigint(20) UNSIGNED DEFAULT NULL,
  `id_service` bigint(20) UNSIGNED DEFAULT NULL,
  `nom_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) NOT NULL DEFAULT 5,
  `commentaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('en_attente','approuvé','rejeté') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Énergies Renouvelables', 'energies-renouvelables', 1, '2026-04-07 16:00:39', '2026-04-07 16:00:39'),
(3, 'Immobilier', 'immobilier', 1, '2026-04-09 07:10:14', '2026-04-09 07:10:14'),
(4, 'Expertise Piscine : Sécuriser et entretenir votre bassin', 'expertise-piscine-securiser-et-entretenir-votre-bassin', 1, '2026-04-10 09:02:09', '2026-04-10 09:02:09'),
(5, 'Hygiène', 'hygiene', 1, '2026-04-10 10:21:29', '2026-04-10 10:21:29'),
(6, 'Agro-industrie', 'agro-industrie', 1, '2026-04-10 10:24:53', '2026-04-10 10:24:53');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` bigint(20) UNSIGNED NOT NULL,
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `nom_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` enum('en_attente','approuvé','rejeté') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ifu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  
  `statut_juridique` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_rccm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_appel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_maps_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability_hours` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jours_ouverture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horaires_ouverture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `company_settings`
--

INSERT INTO `company_settings` (`id`, `ifu`, `nom_agence`,  `statut_juridique`, `numero_rccm`, `telephone_appel`, `telephone_whatsapp`, `email`, `localisation`, `google_maps_link`, `facebook_link`, `instagram_link`, `linkedin_link`, `availability_hours`, `jours_ouverture`, `horaires_ouverture`, `created_at`, `updated_at`) VALUES
(1, '3202685006271', 'NAKAYO CORPORATION', 2026, 'SARL', 'RB/ABC/26 B 10770', '+229 01 66 55 61 61', '+229 01 94 86 61 61', 'contact@nakayocorporation.com', 'Zogbo Yénawa Lot 1887  “G” Maison AMOUSSOU Benoit', NULL, '#', '#', '#', NULL, 'LundiI au Vendredi', '08h - 19h', '2026-04-07 06:29:39', '2026-04-13 15:07:57');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_membre` bigint(20) UNSIGNED NOT NULL,
  `nom_complet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `statut` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_membre`, `nom_complet`, `poste`, `photo`, `linkedin`, `ordre`, `statut`, `created_at`, `updated_at`) VALUES
(2, 'Boubakar Brahim', 'directeur', 'team/hVc3cj348UIfAp6EEXvMXeStL7mRITypPvkhOtts.jpg', 'hhttp://LinkedIn/in', 1, 1, '2026-04-13 09:55:39', '2026-04-13 09:56:14'),
(3, 'Mr Matinou', 'Secrétaire', 'team/K44CoRnMPn116I1Ez9JdntWLGp3CGzonYDK4c6E4.jpg', 'hhttp://LinkedIn/in', 2, 1, '2026-04-13 09:58:25', '2026-04-13 09:58:25'),
(4, 'Elise B.', 'Resp. Immobilier', 'team/9YtpAIKpbAZTO1BIsQ6eBWokvSUj2IKXz8TpdfXV.jpg', 'hhttp://LinkedIn/in', 3, 1, '2026-04-13 10:26:33', '2026-04-13 10:26:33'),
(5, 'Patrice M.', 'Directeur Agro', 'team/KwuUdbOqjaqjHM9FFluSspXe1TvrHkR17rYLltPC.jpg', 'hhttp://LinkedIn/in', 4, 1, '2026-04-13 14:18:04', '2026-04-13 14:18:04'),
(6, 'Jean-Luc Agueh', 'Expert Technique', 'team/x0nJbSODA9SzA682YLMVS0Jg4ZycLTDCTNs9U497.jpg', 'hhttp://LinkedIn/in', 5, 1, '2026-04-13 14:19:25', '2026-04-13 14:19:25'),
(7, 'Elise B.', 'Directrice Agro', 'team/rR9p6hNCf5jiVwtWqMxvTolduZtexjWWGKTLDvqg.jpg', 'hhttp://LinkedIn/in', 4, 1, '2026-04-13 14:20:27', '2026-04-13 14:20:27');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_formation` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_formation` datetime DEFAULT NULL,
  `cout` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galleries`
--

CREATE TABLE `galleries` (
  `id_gallerie` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED DEFAULT NULL,
  `id_produit` bigint(20) UNSIGNED DEFAULT NULL,
  `type_media` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `galleries`
--

INSERT INTO `galleries` (`id_gallerie`, `id_service`, `id_produit`, `type_media`, `link`, `image_url`, `created_at`, `updated_at`) VALUES
(63, 26, NULL, 'image', NULL, 'gallery/rsuI5RvaPnQYUHv97wKgAXJUB4sylWXXFQ9gbbEU.jpg', '2026-04-10 07:42:42', '2026-04-10 07:42:42'),
(64, 27, NULL, 'image', NULL, 'gallery/ZwaQlKZX8sNJohdmuR8ryogFf16eUOSa9JfMvDz1.jpg', '2026-04-10 07:50:52', '2026-04-10 07:50:52'),
(65, 28, NULL, 'image', NULL, 'gallery/BXf9cYr2bK6TADyninB5Rd11ujcyNskXVzUNr9tK.jpg', '2026-04-10 07:52:23', '2026-04-10 07:52:23'),
(66, 28, NULL, 'image', NULL, 'gallery/MrBoNEVo199CbwQxgbnQ8cTplLVOA9pMdEVF0lTp.jpg', '2026-04-10 07:52:23', '2026-04-10 07:52:23'),
(67, 29, NULL, 'image', NULL, 'gallery/J3iVFfPPJETndz1TL99LeeV5YHK64rEqxHSovu3v.jpg', '2026-04-10 07:54:05', '2026-04-10 07:54:05'),
(68, 29, NULL, 'image', NULL, 'gallery/BcGTAzaqfor8hy45qfE50HCZ8xuEto0Ath1G2pdS.jpg', '2026-04-10 07:54:05', '2026-04-10 07:54:05'),
(69, 30, NULL, 'image', NULL, 'gallery/Nsp8zUxSSmcLHRFKXjpMGKLgEMDGwyVlxJs6huL5.jpg', '2026-04-10 08:04:41', '2026-04-10 08:04:41');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2026_03_30_143918_create_all_tables', 1),
(3, '2026_04_05_193027_create_avis_table', 1),
(4, '2026_04_05_210138_create_tags_table', 1),
(5, '2026_04_06_154232_add_commentaire_to_articles_table', 1),
(6, '2026_04_06_161822_add_details_to_articles', 1),
(7, '2026_04_06_175312_create_notifications_table', 1),
(8, '2026_04_06_221814_add_nom_to_produits_table', 1),
(9, '2026_04_07_042022_create_recrutements_table', 1),
(10, '2026_04_07_044856_create_commentaires_table', 1),
(11, '2026_04_07_052758_create_company_settings_table', 1),
(12, '2026_04_08_035302_create_equipe_table', 2),
(13, '2026_04_08_043317_create_projets_table', 3),
(14, '2026_04_08_073514_update_status_in_formations_table', 4),
(15, '2026_04_09_102511_add_status_to_services_table', 5);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `statut` enum('disponible','en_rupture') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id_projet` bigint(20) UNSIGNED NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_realisation` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('brouillon','publié') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publié',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id_projet`, `id_service`, `nom`, `description`, `lieu`, `client`, `date_realisation`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 30, 'Construction Piscine', 'Résidence Azur - Cotonou', 'calavi', NULL, '2026-04-02', 'projets/cWItZBrYrp19QFYnicYQ4MUVl7CMPJ033xL4wOWs.jpg', 'publié', '2026-04-10 11:19:17', '2026-04-10 11:19:17'),
(3, 27, 'Complexe Nakayo', 'Construction de notre complexe', 'calavi', NULL, '2026-03-04', 'projets/YGM4YS8HTPDV7dEgmHFb1s5l3HiWJmCz2itqJDqw.webp', 'publié', '2026-04-10 11:22:38', '2026-04-10 11:22:38'),
(4, 26, 'Ferme Pilote Ouidah', 'Nous avons travaillé sur une ferme à Ouidah', 'Ouidah', NULL, '2026-03-31', 'projets/hV96attyDRMeqJOMKPXUILDtCVkmgdoorusNA199.jpg', 'publié', '2026-04-10 11:25:49', '2026-04-10 11:25:49'),
(5, 26, 'Production Hygiène', 'Production Hygiène', 'Cotonou', NULL, NULL, 'projets/siTaMYtvsTF5MGtMfRVwbco6BhsqK7CQbaQaSTsC.png', 'publié', '2026-04-10 11:27:10', '2026-04-10 11:27:10');

-- --------------------------------------------------------

--
-- Structure de la table `recrutements`
--

CREATE TABLE `recrutements` (
  `id_recrutement` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('CDI','CDD','Mission','Stage','Freelance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CDI',
  `date_limite` date NOT NULL,
  `email_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('brouillon','publié','cloturé') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brouillon',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recrutements`
--

INSERT INTO `recrutements` (`id_recrutement`, `nom`, `image`, `description`, `lieu`, `agence`, `type`, `date_limite`, `email_whatsapp`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Bureautique', 'recrutements/QlH3cftM2m94k7vSJgVn8mbhNyfz84WPVxOAmRj5.jpg', 'urjfuresqsrgdhfjhujiklpkojliuruhjhkh', 'calavi', 'caboma', 'CDI', '2026-04-30', 'recrutement@gmail.com', 'publié', '2026-04-08 04:12:24', '2026-04-08 04:12:24');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courte_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('publié','brouillon') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publié',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id_service`, `media`, `titre`, `courte_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(26, 'services/9GStZg5lVWMe6OrYfbXdjHZMHsr4z3RhbqlxRhK5.jpg', 'Agro industrie et élevage', 'NAKAYÔ CORPORATION agit comme un intermédiaire de confiance, garantissant la sécurité juridique des transactions et la qualité de la construction.', 'La diaspora béninoise, de plus en plus nombreuse et économiquement active, manifeste un fort désir d\'investir dans son pays d\'origine, notamment dans l\'immobilier, un secteur perçu comme sûr et valorisant. Cependant, elle se heurte à des freins majeurs : la méfiance liée aux transactions à distance, la complexité des démarches administratives et foncières, et l\'absence d\'offres clés en main adaptées à ses attentes', 'publié', '2026-04-10 07:42:42', '2026-04-10 08:21:14'),
(27, 'services/h9KD9QKnSAc4uPCop8HGUpDZ6bVnCV4aaQNbyeUh.jpg', 'Immobilier & Investissement', 'NAKAYÔ CORPORATION agit comme un intermédiaire de confiance, garantissant la sécurité juridique des transactions et la qualité de la construction.', 'La diaspora béninoise, de plus en plus nombreuse et économiquement active, manifeste un fort désir d\'investir dans son pays d\'origine, notamment dans l\'immobilier, un secteur perçu comme sûr et valorisant. Cependant, elle se heurte à des freins majeurs : la méfiance liée aux transactions à distance, la complexité des démarches administratives et foncières, et l\'absence d\'offres clés en main adaptées à ses attentes.', 'publié', '2026-04-10 07:50:52', '2026-04-10 07:50:52'),
(28, 'services/FsDAq1og5vzAYDDs8TfpfpOeLV3ADRn7UbfCW074.jpg', 'Papeterie & Fourniture bureautique', 'NAKAYO CORPORATION Sarl vend en gros et en details grace à notre boutique dénommée LA BELLE PAGE, nous livrons aux partculiers, aux familles, aux PME et à toute structure dans le besoin', 'Le marché de la papeterie et des fournitures au Bénin est un secteur stable mais fragmenté, caractérisé par une forte demande institutionnelle (écoles, administrations) et une clientèle de détail croissante. L\'activité existante de papeterie représente un actif stratégique et une source de trésorerie immédiate pour le groupe. NAKAYO CORPORATION Sarl vend en gros et en details grace à notre boutique dénommée LA BELLE PAGE, nous livrons aux partculiers, aux familles, aux PME et à toute structure dans le besoin', 'publié', '2026-04-10 07:52:22', '2026-04-10 07:52:22'),
(29, 'services/5GQa2vSXafyqPwhAw9R3v9prLB53tkcRKDjAkxSY.jpg', 'Fabrication, Commercialisation & Formation en Savonnerie', 'NAKAYO CORPORATION Sarl souhaite établir sa gamme de savons dénommée LEA (Lessive, Enfant et Adulte) comme une marque béninoise de référence, leader en matière de qualité, de confiance et d\'innovation dans le secteur de l\'hygiène familial.', 'Le marché béninois des produits d\'hygiène est dominé par deux extrêmes : les grandes marques internationales (souvent chères et perçues comme agressives) et les savons artisanaux locaux (de qualité variable et peu standardisés). Il existe un réel créneau pour une marque locale de qualité supérieure, offrant transparence et confiance à un prix accessible. NAKAYO CORPORATION Sarl souhaite établir sa gamme de savons dénommée LEA (Lessive, Enfant et Adulte) comme une marque béninoise de référence, leader en matière de qualité, de confiance et d\'innovation dans le secteur de l\'hygiène familial.', 'publié', '2026-04-10 07:54:05', '2026-04-10 07:54:05'),
(30, 'services/Jr0L71BBAHIBz0BCX8mjwIiZDHUP2UBHSmTS5dxj.jpg', 'Construction, Entretien, Rénovation et Sécurité des Piscines', 'NAKAYO CORPORATION Sarl construit des piscines classiques en beton ; des piscines en kit fabriquées à base de conteneurs', 'Avec la croissance économique du Bénin, une classe moyenne et une élite émergente recherchent des services de confort et de loisirs premium. Les piscines, autrefois réservées aux hôtels de luxe, deviennent un symbole de standing pour les résidences privées. Cependant, le marché est informel, avec une offre disparate d\'artisans non spécialisés, entraînant des problèmes récurrents de qualité, de sécurité et de maintenance. NAKAYO CORPORATION Sarl offre des services de qualité', 'publié', '2026-04-10 08:04:41', '2026-04-10 08:04:41');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id_tag` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `nom`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bureautique', 'bureautique', '2026-04-07 06:42:47', '2026-04-07 06:42:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nom_complet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','abonné','rédacteur') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'abonné',
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_complet`, `email`, `role`, `telephone`, `password`, `confirm_password`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur Principal', 'admin@accessfinance.bj', 'admin', '+229 00 00 00 01', '$2y$12$Lg//uKkUYAM0S5QVfvall.SSY9Zfw86KeTqlZqfzibVw80VX74KUq', 'admin1234', '2026-04-07 06:29:44', '2026-04-07 06:29:44'),
(2, 'Jean Rédacteur', 'redacteur@accessfinance.bj', 'rédacteur', '+229 00 00 00 02', '$2y$12$A7BqwfhgF2/FWuhYAlvwm.Wsob4rbUc74F91iANFtWVzJvmJUshhC', 'redac1234', '2026-04-07 06:29:45', '2026-04-07 06:29:45'),
(3, 'Mr Matinou', 'houhadoris1@gmail.com', 'admin', '94327954', '$2y$12$mJ7HsVmOiJl4eJE.wJ91Bu2Ko6yWaQ2zR7.WPOrFvseSmprxdkyNu', 'matinou1234', '2026-04-07 06:34:58', '2026-04-07 06:34:58'),
(4, 'Koubourath', 'i7285800@gmail.com', 'rédacteur', '94327954', '$2y$12$V7/8N2v9ftd4fHRnx5GfvutU.cAaN8iyXTEkmHFc2TuuICF0Je2om', 'koubourath1234', '2026-04-07 06:36:11', '2026-04-07 06:36:11'),
(5, 'Inès', 'ines@gmail.com', 'abonné', '94327954', '$2y$12$O/ahil0Uowe8NWOOC1XsWO2edRMS8alwr9u.UgtZLdhy3aUt7TbcW', 'ines1234', '2026-04-07 06:36:59', '2026-04-07 06:36:59');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_id_user_foreign` (`id_user`),
  ADD KEY `articles_id_categorie_foreign` (`id_categorie`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `avis_id_article_foreign` (`id_article`),
  ADD KEY `avis_id_service_foreign` (`id_service`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `commentaires_id_article_foreign` (`id_article`);

--
-- Index pour la table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `formations_id_service_foreign` (`id_service`);

--
-- Index pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id_gallerie`),
  ADD KEY `galleries_id_service_foreign` (`id_service`),
  ADD KEY `galleries_id_produit_foreign` (`id_produit`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `produits_id_service_foreign` (`id_service`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `projets_id_service_foreign` (`id_service`);

--
-- Index pour la table `recrutements`
--
ALTER TABLE `recrutements`
  ADD PRIMARY KEY (`id_recrutement`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `tags_nom_unique` (`nom`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_membre` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id_gallerie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projet` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `recrutements`
--
ALTER TABLE `recrutements`
  MODIFY `id_recrutement` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_id_categorie_foreign` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_id_article_foreign` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_id_article_foreign` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;

--
-- Contraintes pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_id_produit_foreign` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE SET NULL,
  ADD CONSTRAINT `galleries_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE SET NULL;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
