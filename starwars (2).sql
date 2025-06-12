-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/01/2025 às 05:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `starwars`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alien_races`
--

CREATE TABLE `alien_races` (
  `id` int(11) NOT NULL,
  `race_name` varchar(100) NOT NULL,
  `homeworld` varchar(100) DEFAULT NULL,
  `traits` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `alien_races`
--

INSERT INTO `alien_races` (`id`, `race_name`, `homeworld`, `traits`) VALUES
(1, 'Wookiee', 'Kashyyyk', 'Fur-covered warriors with a lifespan of 400 years. Bonded by life-debt traditions. Known for crafting bowcasters and climbing wroshyr trees.'),
(2, 'Twi\'lek', 'Ryloth', 'Humanoids with cranial tentacles (lekku), various skin colors.'),
(3, 'Rodian', 'Rodia', 'Greenish skin, large eyes and antennas, famous bounty hunters.'),
(4, 'Mon Calamari', 'Mon Cala', 'Aquatic species known for their shipbuilding skills and artistic culture.'),
(5, 'Bothan', 'Bothawui', 'Short stature, excellent intelligence operatives, known for their espionage skills.'),
(6, 'Ewok', 'Endor', 'Short forest-dwelling teddy bear-like species. Use primitive weapons like slingshots and log traps. Worship C-3PO as a deity.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aspects`
--

CREATE TABLE `aspects` (
  `id` int(11) NOT NULL,
  `aspect` varchar(255) NOT NULL,
  `definition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `aspects`
--

INSERT INTO `aspects` (`id`, `aspect`, `definition`) VALUES
(1, 'Light Side', 'The Light Side of the Force emphasizes qualities such as compassion, selflessness, healing, and protection. Practitioners of the Light Side strive to maintain peace and harmony within the galaxy, often serving as guardians and peacekeepers.'),
(2, 'Dark Side', 'The Dark Side of the Force focuses on power, aggression, fear, and control. Users of the Dark Side harness their emotions to gain strength, often leading to corruption and a desire for domination over others.'),
(3, 'Balance', 'Balance in the Force represents the equilibrium between the Light and Dark sides. It is the state where neither side overwhelms the other, ensuring stability and harmony across the galaxy.'),
(4, 'Grey Side', 'The Grey Side of the Force embodies a middle path, rejecting the extremes of both Light and Dark. Practitioners seek personal freedom and self-determination, often valuing neutrality and independence.'),
(5, 'Unifying Force', 'The Unifying Force is the interconnected energy that binds all living beings in the galaxy. It transcends the dichotomy of Light and Dark, representing the collective consciousness and unity of the universe.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `affiliation` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `characters`
--

INSERT INTO `characters` (`id`, `name`, `affiliation`, `details`) VALUES
(1, 'Luke Skywalker', 'Jedi / Rebel Alliance', 'Son of Anakin, trained by Obi-Wan and Yoda, pivotal in the fall of the Empire.'),
(2, 'Darth Vader', 'Sith / Empire', 'Previously known as Anakin Skywalker. Corrupted by the Dark Side, became the Emperor\'s right hand.'),
(3, 'Yoda', 'Jedi', 'A Jedi Master with unparalleled wisdom and power, serving as a mentor to many Jedi including Luke Skywalker.'),
(4, 'Leia Organa', 'Rebel Alliance', 'Princess of Alderaan, leader in the Rebel Alliance, and key figure in the fight against the Empire.'),
(5, 'Han Solo', 'Rebel Alliance / Smugglers\' Alliance', 'Smuggler turned hero of the Rebel Alliance, pilot of the Millennium Falcon.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_year` int(11) DEFAULT NULL,
  `director` varchar(100) DEFAULT NULL,
  `synopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `movies`
--

INSERT INTO `movies` (`id`, `title`, `release_year`, `director`, `synopsis`) VALUES
(1, 'A New Hope', 1977, 'George Lucas', 'Rebels steal Death Star plans via Princess Leia. Luke joins Obi-Wan, recruits Han Solo, and destroys Death Star using Force-guided proton torpedoes.'),
(2, 'The Empire Strikes Back', 1980, 'Irvin Kershner', 'Rebels flee Hoth after Imperial invasion. Luke trains with Yoda on Dagobah (\"Do or do not, there is no try\"). Han frozen in carbonite after Cloud City betrayal.'),
(3, 'Return of the Jedi', 1983, 'Richard Marquand', 'Rescue mission to free Han from Jabba\'s Palace. Final showdown with Emperor Palpatine aboard Death Star II. Anakin Skywalker redeems himself by destroying the Emperor.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planets`
--

CREATE TABLE `planets` (
  `id` int(11) NOT NULL,
  `planet_name` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `planets`
--

INSERT INTO `planets` (`id`, `planet_name`, `region`, `description`) VALUES
(1, 'Tatooine', 'Outer Rim Territories', 'A desert planet with twin suns. Key location for smugglers and moisture farmers. Home to Luke Skywalker and Anakin Skywalker. Features the spaceport Mos Eisley (\"wretched hive of scum and villainy\") and Jawas\' sandcrawlers.'),
(4, 'Hoth', 'Outer Rim Territories', 'Frozen wasteland where the Rebel Alliance established Echo Base. Site of the Empire\'s devastating AT-AT walker assault. Temperatures drop to -60°C, inhabited by tauntauns and wampas.'),
(5, 'Dagobah', 'Unknown Regions', 'Swampy planet shrouded in mist. Hiding place of Jedi Master Yoda during his exile. Strong with the Force but teeming with dangerous creatures like dragonsnakes and bogwings.'),
(6, 'Bespin', 'Outer Rim', 'Gas giant with Cloud City, a floating tibanna gas mining colony. Lando Calrissian\'s territory until Imperial occupation. Site of Han Solo\'s carbonite freezing.'),
(7, 'Endor', 'Outer Rim', 'Forest moon protected by energy shield. Home to Ewoks who aided Rebel forces in destroying Death Star II\'s shield generator. Features giant trees and primitive technology.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ships`
--

CREATE TABLE `ships` (
  `id` int(11) NOT NULL,
  `ship_name` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `ships`
--

INSERT INTO `ships` (`id`, `ship_name`, `model`, `description`) VALUES
(1, 'Millennium Falcon', 'YT-1300f light freighter', 'Han Solo\'s modified ship, famous for its speed and escape capability.'),
(2, 'X-Wing', 'T-65B X-wing Starfighter', 'Versatile Rebel fighter, responsible for crucial victories against the Empire.'),
(3, 'TIE Fighter', 'Twin Ion Engine Fighter', 'Iconic Imperial fighter, fast but without shields.'),
(4, 'Star Destroyer', 'Imperial-class Star Destroyer', 'Massive Imperial warship, serves as a symbol of the Empire\'s might.'),
(5, 'Death Star', 'DS-1 Orbital Battle Station', 'Massive space station with the power to destroy entire planets.'),
(6, 'Slave I', 'Firespray-31', 'Boba Fett\'s iconic starship with rotating cockpit. Equipped with hidden weapons and carbon-freezing chamber.'),
(7, 'Tantive IV', 'CR90 corvette', 'Rebel blockade runner carrying Death Star plans. Captured by Darth Vader\'s Star Destroyer at the beginning of Episode IV.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `skills`
--

INSERT INTO `skills` (`id`, `name`, `skill`, `about`) VALUES
(1, 'Obi-Wan Kenobi', 'Defensive Form (Form III: Soresu)', 'Obi-Wan Kenobi specializes in Soresu, a defensive lightsaber combat form that emphasizes tight deflections and minimizing exposure to attacks. This form allows him to withstand and counteract multiple opponents effectively.'),
(2, 'Yoda', 'Telekinesis', 'Master Yoda possesses exceptional telekinetic abilities, enabling him to manipulate objects and control his environment with precision. This skill allows him to perform feats such as moving large objects, enhancing his combat versatility.'),
(3, 'Darth Vader', 'Force Choke', 'Vader usa o poder da Força para estrangular inimigos à distância.'),
(4, 'Darth Sidious', 'Force Lightning', 'Darth Sidious wields Force Lightning, a devastating dark side technique that unleashes bolts of electrical energy to incapacitate or destroy his enemies. This skill exemplifies his ruthless pursuit of power and control.'),
(5, 'Boba Fett', 'Caçador de Recompensas', 'Especialista em perseguição e armas avançadas.'),
(6, 'Darth Vader', 'Force Choke', 'Dark Side ability to telekinetically strangle enemies. Used to intimidate Imperial officers like Admiral Ozzel.'),
(7, 'Boba Fett', 'Mandalorian Tactics', 'Expert tracker using wrist flamethrowers, jetpack, and seismic charges. Collected bounties for Jabba the Hutt.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `summary`
--

CREATE TABLE `summary` (
  `id` int(11) NOT NULL,
  `era_title` varchar(100) DEFAULT NULL,
  `summary_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `summary`
--

INSERT INTO `summary` (`id`, `era_title`, `summary_text`) VALUES
(1, 'Old Republic Era', 'Governed by a Senate, the Old Republic maintained peace for thousands of years under Jedi protection.'),
(2, 'Galactic Empire Era', 'After the fall of the Republic, the Emperor ruled with an iron fist, oppressing the galaxy.'),
(3, 'New Republic Era', 'After the defeat of the Empire, the galaxy tried to rebuild, facing new challenges.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$e0NR1fF1VQF6B9JQ2qJxE.P0q5D1y4wU6sK8Ew7/VXbB7aGZb9XWG');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alien_races`
--
ALTER TABLE `alien_races`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `aspects`
--
ALTER TABLE `aspects`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alien_races`
--
ALTER TABLE `alien_races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `aspects`
--
ALTER TABLE `aspects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `planets`
--
ALTER TABLE `planets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
