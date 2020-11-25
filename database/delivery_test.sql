-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 25-Nov-2020 às 22:56
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery_test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_11_14_000_create_users_table', 1),
(2, '2020_11_14_001_create_movies_table', 1),
(3, '2020_11_14_002_create_user_movies_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `external_id` int(11) NOT NULL,
  `original_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_language` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci,
  `poster_path` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vote_average` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `movies`
--

INSERT INTO `movies` (`id`, `external_id`, `original_title`, `original_language`, `overview`, `poster_path`, `vote_average`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 724989, 'Hard Kill', 'en', 'The work of billionaire tech CEO Donovan Chalmers is so valuable that he hires mercenaries to protect it, and a terrorist group kidnaps his daughter just to get it.', '/ugZW8ocsrfgI95pnQ7wrmKDxIe.jpg', 5, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(2, 400160, 'The SpongeBob Movie: Sponge on the Run', 'en', 'When his best friend Gary is suddenly snatched away, SpongeBob takes Patrick on a madcap mission far beyond Bikini Bottom to save their pink-shelled pal.', '/jlJ8nDhMhCYJuzOw3f52CP1W8MW.jpg', 8, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(3, 531219, 'Roald Dahl\'s The Witches', 'en', 'In late 1967, a young orphaned boy goes to live with his loving grandma in the rural Alabama town of Demopolis. As the boy and his grandmother encounter some deceptively glamorous but thoroughly diabolical witches, she wisely whisks him away to a seaside resort. Regrettably, they arrive at precisely the same time that the world\'s Grand High Witch has gathered.', '/betExZlgK0l7CZ9CsCBVcwO1OjL.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(4, 524047, 'Greenland', 'en', 'John Garrity, his estranged wife and their young son embark on a perilous journey to find sanctuary as a planet-killing comet hurtles toward Earth. Amid terrifying accounts of cities getting levelled, the Garrity\'s experience the best and worst in humanity. As the countdown to the global apocalypse approaches zero, their incredible trek culminates in a desperate and last-minute flight to a possible safe haven.', '/bNo2mcvSwIvnx8K6y1euAc1TLVq.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(5, 671039, 'Bronx', 'fr', 'Caught in the crosshairs of police corruption and Marseille’s warring gangs, a loyal cop must protect his squad by taking matters into his own hands.', '/9HT9982bzgN5on1sLRmc1GMn6ZC.jpg', 6, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(6, 682377, 'Chick Fight', 'en', 'When Anna Wyncomb is introduced to an an underground, all-female fight club in order to turn the mess of her life around, she discovers she is much more personally connected to the history of the club than she could ever imagine.', '/4ZocdxnOO6q2UbdKye2wgofLFhB.jpg', 8, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(7, 337401, 'Mulan', 'en', 'When the Emperor of China issues a decree that one man per family must serve in the Imperial Chinese Army to defend the country from Huns, Hua Mulan, the eldest daughter of an honored warrior, steps in to take the place of her ailing father. She is spirited, determined and quick on her feet. Disguised as a man by the name of Hua Jun, she is tested every step of the way and must harness her innermost strength and embrace her true potential.', '/aKx1ARwG55zZ0GpRvU2WrGrCG9o.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(8, 741074, 'Once Upon a Snowman', 'en', 'The previously untold origins of Olaf, the innocent and insightful, summer-loving snowman are revealed as we follow Olaf’s first steps as he comes to life and searches for his identity in the snowy mountains outside Arendelle.', '/hddzYJtfYYeMDOQVcH58n8m1W3A.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(9, 741067, 'Welcome to Sudden Death', 'en', 'Jesse Freeman is a former special forces officer and explosives expert now working a regular job as a security guard in a state-of-the-art basketball arena. Trouble erupts when a tech-savvy cadre of terrorists kidnap the team\'s owner and Jesse\'s daughter during opening night. Facing a ticking clock and impossible odds, it\'s up to Jesse to not only save them but also a full house of fans in this highly charged action thriller.', '/elZ6JCzSEvFOq4gNjNeZsnRFsvj.jpg', 6, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(10, 613504, 'After We Collided', 'en', 'Tessa finds herself struggling with her complicated relationship with Hardin; she faces a dilemma that could change their lives forever.', '/kiX7UYfOpYrMFSAGbI6j1pFkLzQ.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(11, 622855, 'Jingle Jangle: A Christmas Journey', 'en', 'An imaginary world comes to life in a holiday tale of an eccentric toymaker, his adventurous granddaughter, and a magical invention that has the power to change their lives forever.', '/5RbyHIVydD3Krmec1LlUV7rRjet.jpg', 8, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(12, 497582, 'Enola Holmes', 'en', 'While searching for her missing mother, intrepid teen Enola Holmes uses her sleuthing skills to outsmart big brother Sherlock and help a runaway lord.', '/riYInlsq2kf1AWoGm80JQW5dLKp.jpg', 8, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(13, 694919, 'Money Plane', 'en', 'A professional thief with $40 million in debt and his family\'s life on the line must commit one final heist - rob a futuristic airborne casino filled with the world\'s most dangerous criminals.', '/6CoRTJTmijhBLJTUNoVSUNxZMEI.jpg', 6, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(14, 340102, 'The New Mutants', 'en', 'Five young mutants, just discovering their abilities while held in a secret facility against their will, fight to escape their past sins and save themselves.', '/xZNw9xxtwbEf25NYoz52KdbXHPM.jpg', 6, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(15, 618353, 'Batman: Death in the Family', 'en', 'Tragedy strikes the Batman\'s life again when Robin Jason Todd tracks down his birth mother only to run afoul of the Joker. An adaptation of the 1988 comic book storyline of the same name.', '/k8Q9ulyRE8fkvZMkAM9LPYMKctb.jpg', 8, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(16, 624779, 'VFW', 'en', 'A typical night for veterans at a VFW turns into an all-out battle for survival when a desperate teen runs into the bar with a bag of stolen drugs. When a gang of violent punks come looking for her, the vets use every weapon at their disposal to protect the girl and themselves from an unrelenting attack.', '/AnVD7Gn14uOTQhcc5xYZGQ9DRvS.jpg', 5, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(17, 575088, 'Яга. Кошмар тёмного леса', 'ru', 'The young family who moved to a new apartment on the outskirts of the city. The nanny hired by them for the newborn daughter quickly gained confidence. However, the older boy, Egor, talks about the frightening behavior of a woman, but his parents do not believe him. The surveillance cameras installed by the father for comfort only confirm everything is in order. Then one day, Egor, returning home, finds no trace of either the nanny or the little sister, and the parents are in a strange trance and do not even remember that they had a daughter. Then Egor, together with his friends, goes in search, during which it turns out that the nanny is an ancient Slavic demon, popularly known as Baba Yaga.', '/wkEKQiMStMwzvM8DAurdRB7Bf47.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(18, 539885, 'Ava', 'en', 'A black ops assassin is forced to fight for her own survival after a job goes dangerously wrong.', '/qzA87Wf4jo1h8JMk9GilyIYvwsA.jpg', 6, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(19, 571384, 'Come Play', 'en', 'A lonely young boy feels different from everyone else. Desperate for a friend, he seeks solace and refuge in his ever-present cell phone and tablet. When a mysterious creature uses the boy’s devices against him to break into our world, his parents must fight to save their son from the monster beyond the screen.', '/e98dJUitAoKLwmzjQ0Yxp1VQrnU.jpg', 7, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(20, 560050, 'Over the Moon', 'en', 'In this animated musical, a girl builds a rocket ship and blasts off, hoping to meet a mythical moon goddess.', '/lQfdytwN7eh0tXWjIiMceFdBBvD.jpg', 8, '2020-11-26 01:56:32', '2020-11-26 01:56:32', NULL),
(21, 581392, '반도', 'ko', 'A soldier and his team battle hordes of post-apocalyptic zombies in the wastelands of the Korean Peninsula.', '/sy6DvAu72kjoseZEjocnm2ZZ09i.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(22, 732670, 'The Lego Star Wars Holiday Special', 'en', 'Rey leaves her friends to prepare for Life Day as she sets off on an adventure to gain a deeper knowledge of the Force. At a mysterious temple, she is hurled into a cross-timeline adventure. Will she make it back in time for Life Day?', '/zyzJSI7UZZzz5Toj10rYGF5689z.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(23, 635302, '劇場版「鬼滅の刃」無限列車編', 'ja', 'Tanjirō Kamado, joined with Inosuke Hashibira, a boy raised by boars who wears a boar\'s head, and Zenitsu Agatsuma, a scared boy who reveals his true power when he sleeps, boards the Infinity Train on a new mission with the Fire Hashira, Kyōjurō Rengoku, to defeat a demon who has been tormenting the people and killing the demon slayers who oppose it!', '/h8Rb9gBr48ODIwYUttZNYeMWeUU.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(24, 681429, 'Cuidado con lo que deseas', 'es', 'Pamela is an eight-year-old girl who loves horror movies and fairy tales. When his uncle gives her away a doll named \"Hellequin\" as a birthday gift, a tale of betrayal begins to unfold before her eyes.', '/sp17ozqFVti2TALS2osPi1Jr5ma.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(25, 718444, 'Rogue', 'en', 'Battle-hardened O’Hara leads a lively mercenary team of soldiers on a daring mission: rescue hostages from their captors in remote Africa. But as the mission goes awry and the team is stranded, O’Hara’s squad must face a bloody, brutal encounter with a gang of rebels.', '/uOw5JD8IlD546feZ6oxbIjvN66P.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(26, 660982, 'American Pie Presents: Girls\' Rules', 'en', 'It\'s Senior year at East Great Falls. Annie, Kayla, Michelle, and Stephanie decide to harness their girl power and band together to get what they want their last year of high school.', '/xqvX5A24dbIWaeYsMTxxKX5qOfz.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(27, 740985, 'Borat Subsequent Moviefilm', 'en', '14 years after making a film about his journey across the USA, Borat risks life and limb when he returns to the United States with his young daughter, and reveals more about the culture, the COVID-19 pandemic, and the political elections.', '/6agKYU5IQFpuDyUYPu39w7UCRrJ.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(28, 734309, 'Santana', 'en', 'Two brothers — one a narcotics agent and the other a general — finally discover the identity of the drug lord who murdered their parents decades ago. They may kill each other before capturing the bad guys.', '/9Rj8l6gElLpRL7Kj17iZhrT5Zuw.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(29, 643882, 'The Princess Switch: Switched Again', 'en', 'When Duchess Margaret unexpectedly inherits the throne & hits a rough patch with Kevin, it’s up to Stacy to save the day before a new lookalike — party girl Fiona — foils their plans.', '/e4qXQXXaVYvHBE3Rx5x3qrmxorB.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(30, 475430, 'Artemis Fowl', 'en', 'Artemis Fowl is a 12-year-old genius and descendant of a long line of criminal masterminds. He soon finds himself in an epic battle against a race of powerful underground fairies who may be behind his father\'s disappearance.', '/tI8ocADh22GtQFV28vGHaBZVb0U.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(31, 606234, 'Archive', 'en', '2038: George Almore is working on a true human-equivalent AI, and his latest prototype is almost ready. This sensitive phase is also the riskiest as he has a goal that must be hidden at all costs—being reunited with his dead wife.', '/eDnHgozW8vfOaLHzfpHluf1GZCW.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(32, 697064, 'Beckman', 'en', 'A contract killer, becomes the reverend of a LA church, until a cult leader and his minions kidnap his daughter. Blinded by vengeance, he cuts a bloody path across the city. The only thing that can stop him is his newfound faith.', '/z0r3YjyJSLqf6Hz0rbBAnEhNXQ7.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(33, 605116, 'Project Power', 'en', 'An ex-soldier, a teen and a cop collide in New Orleans as they hunt for the source behind a dangerous new pill that grants users temporary superpowers.', '/TnOeov4w0sTtV2gqICqIxVi74V.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(34, 677638, 'We Bare Bears: The Movie', 'en', 'When Grizz, Panda, and Ice Bear\'s love of food trucks and viral videos get out of hand, the brothers are chased away from their home and embark on a trip to Canada, where they can live in peace.', '/kPzcvxBwt7kEISB9O4jJEuBn72t.jpg', 8, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(35, 634244, 'Heavenquest: A Pilgrim\'s Progress', 'en', 'Inspired by the 1678 novel The Pilgrim\'s Progress and an imagined prequel to Bunyan\'s original writings.  A regal man named Vangel is thrust on a journey against his will when he is suddenly and mysteriously arrested.  Injured and lost after escaping the dark king’s men, Vangel begins to have strange dreams and visions of a mysterious woman in white calling him from the unknown territory of the North.  Armed with a book called “The Record of the Ancients” that he receives from a wise sage named Elder, Vangel embarks on an adventure that takes him through treacherous mountain range, unending deserts, the Lake of Doubts, and the Forest of No Return.  Along the way, travel companions share about a fabled good king and his son in the North if he can make it there alive.', '/cLDPLia17AwMqSaRHccyAlInkch.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(36, 601844, 'Becky', 'en', 'A teenager\'s weekend at a lake house with her father takes a turn for the worse when a group of convicts wreaks havoc on their lives.', '/xqbQtMffXwa3oprse4jiHBMBvdW.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(37, 635237, 'Arthur & Merlin: Knights of Camelot', 'en', 'King Arthur returns home after fighting the Roman Empire. His illegitimate son has corrupted the throne of Camelot and King Arthur must reunite with the wizard Merlin and the Knights of the Round Table to fight to get back his crown.', '/chGTXsvn53XvEnvsJ9ZD9eiYKx9.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(38, 722603, 'Battlefield 2025', 'en', 'Weekend campers, an escaped convict, young lovers and a police officer experience a night of terror when a hostile visitor from another world descends on a small Arizona town.', '/w6e0XZreiyW4mGlLRHEG8ipff7b.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(39, 531499, 'The Tax Collector', 'en', 'David Cuevas is a family man who works as a gangland tax collector for high ranking Los Angeles gang members. He makes collections across the city with his partner Creeper making sure people pay up or will see retaliation. An old threat returns to Los Angeles that puts everything David loves in harm’s way.', '/3eg0kGC2Xh0vhydJHO37Sp4cmMt.jpg', 6, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(40, 514207, 'Вторжение', 'ru', 'After the fall of the alien ship, it took three years. The catastrophe turned the girl\'s life from Chertanovo and forever changed our view of the universe. It seems that this was the biggest test for all of us. But mankind does not yet know that very soon he will have to experience a new meeting.', '/dqKqzcdhtJwOhjqe89RTURqILtl.jpg', 7, '2020-11-26 01:56:34', '2020-11-26 01:56:34', NULL),
(41, 475557, 'Joker', 'en', 'During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.', '/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 8, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(42, 330457, 'Frozen II', 'en', 'Elsa, Anna, Kristoff and Olaf head far into the forest to learn the truth about an ancient mystery of their kingdom.', '/qXsndsv3WOoxszmdlvTWeY688eK.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(43, 446893, 'Trolls World Tour', 'en', 'Queen Poppy and Branch make a surprising discovery — there are other Troll worlds beyond their own, and their distinct differences create big clashes between these various tribes. When a mysterious threat puts all of the Trolls across the land in danger, Poppy, Branch, and their band of friends must embark on an epic quest to create harmony among the feuding Trolls to unite them against certain doom.', '/7W0G3YECgDAfnuiHG91r8WqgIOe.jpg', 8, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(44, 721656, 'Happy Halloween, Scooby-Doo!', 'en', 'Scooby-Doo and the gang team up with their pals, Bill Nye The Science Guy and Elvira Mistress of the Dark, to solve this mystery of gigantic proportions and save Crystal Cove!', '/5aL71e0XBgHZ6zdWcWeuEhwD2Gw.jpg', 8, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(45, 438396, 'Orígenes secretos', 'es', 'In Madrid, Spain, a mysterious serial killer ruthlessly murders his victims by recreating the first appearance of several comic book superheroes. Cosme, a veteran police inspector who is about to retire, works on the case along with the tormented inspector David Valentín and his own son Jorge Elías, a nerdy young man who owns a comic book store.', '/vJHSParlylICnI7DuuI54nfTPRR.jpg', 6, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(46, 38700, 'Bad Boys for Life', 'en', 'Marcus and Mike are forced to confront new threats, career changes, and midlife crises as they join the newly created elite team AMMO of the Miami police department to take down the ruthless Armando Armas, the vicious leader of a Miami drug cartel.', '/y95lQLnuNKdPAzw9F9Ab8kJ80c3.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(47, 594328, 'Phineas and Ferb The Movie: Candace Against the Universe', 'en', 'Phineas and Ferb travel across the galaxy to rescue their older sister Candace, who has been abducted by aliens and taken to a utopia in a far-off planet, free of her pesky little brothers.', '/n6hptKS7Y0ZjkYwbqKOK3jz9XAC.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(48, 495764, 'Birds of Prey (and the Fantabulous Emancipation of One Harley Quinn)', 'en', 'Harley Quinn joins forces with a singer, an assassin and a police detective to help a young girl who had a hit placed on her after she stole a rare diamond from a crime lord.', '/h4VB6m0RwcicVEZvzftYZyKXs6K.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(49, 594718, 'Sputnik', 'ru', 'At the height of the Cold War, a Soviet spacecraft crash lands after a mission gone awry, leaving the commander as its only survivor. After a renowned Russian psychologist is brought in to evaluate the commander’s mental state, it becomes clear that something dangerous may have come back to Earth with him…', '/eAUzmhP54bE1vPXaY7FbuZREJlR.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(50, 621151, 'Spell', 'en', 'A father survives a plane crash in rural Appalachia, but becomes suspicious of the elderly couple who take him in to nurse him back to health with the ancient remedies.', '/4rjHhj1BAREc9zNFU8FheLJQdFf.jpg', 6, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(51, 721452, 'One Night in Bangkok', 'en', 'A hit man named Kai flies into Bangkok, gets a gun, and orders a cab. He offers a professional female driver big money to be his all-night driver. But when she realizes Kai is committing brutal murders at each stop, it\'s too late to walk away. Meanwhile, an offbeat police detective races to decode the string of slayings before more blood is spilled.', '/i4kPwXPlM1iy8Jf3S1uuLuwqQAV.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(52, 592350, '僕のヒーローアカデミア THE MOVIE ヒーローズ：ライジング', 'ja', 'Class 1-A visits Nabu Island where they finally get to do some real hero work. The place is so peaceful that it\'s more like a vacation … until they\'re attacked by a villain with an unfathomable Quirk! His power is eerily familiar, and it looks like Shigaraki had a hand in the plan. But with All Might retired and citizens\' lives on the line, there\'s no time for questions. Deku and his friends are the next generation of heroes, and they\'re the island\'s only hope.', '/zGVbrulkupqpbwgiNedkJPyQum4.jpg', 9, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(53, 454626, 'Sonic the Hedgehog', 'en', 'Based on the global blockbuster videogame franchise from Sega, Sonic the Hedgehog tells the story of the world’s speediest hedgehog as he embraces his new home on Earth. In this live-action adventure comedy, Sonic and his new best friend team up to defend the planet from the evil genius Dr. Robotnik and his plans for world domination.', '/aQvJ5WPzZgYVDrxLX4R6cLJCEaQ.jpg', 8, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(54, 385103, 'Scoob!', 'en', 'In Scooby-Doo’s greatest adventure yet, see the never-before told story of how lifelong friends Scooby and Shaggy first met and how they joined forces with young detectives Fred, Velma, and Daphne to form the famous Mystery Inc. Now, with hundreds of cases solved, Scooby and the gang face their biggest, toughest mystery ever: an evil plot to unleash the ghost dog Cerberus upon the world. As they race to stop this global “dogpocalypse,” the gang discovers that Scooby has a secret legacy and an epic destiny greater than anyone ever imagined.', '/jHo2M1OiH9Re33jYtUQdfzPeUkx.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(55, 516486, 'Greyhound', 'en', 'A first-time captain leads a convoy of allied ships carrying thousands of soldiers across the treacherous waters of the “Black Pit” to the front lines of WW2. With no air cover protection for 5 days, the captain and his convoy must battle the surrounding enemy Nazi U-boats in order to give the allies a chance to win the war.', '/kjMbDciooTbJPofVXgAoFjfX8Of.jpg', 8, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(56, 512895, 'Lady and the Tramp', 'en', 'The love story between a pampered Cocker Spaniel named Lady and a streetwise mongrel named Tramp. Lady finds herself out on the street after her owners have a baby and is saved from a pack by Tramp, who tries to show her to live her life footloose and collar-free.', '/8wBEye516IKul9sW7JKGcFXVGfV.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(57, 658412, 'लूडो', 'hi', 'Ludo is about the butterfly effect and how, despite all the chaos and crowd of the world, all our lives are inextricably connected. From a resurfaced sex tape to a rogue suitcase of money, four wildly different stories overlap at the whims of fate, chance and one eccentric criminal.', '/frB57nMDmu4NnSzjmrq0lEx5iod.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(58, 621870, 'Secret Society of Second Born Royals', 'en', 'Sam is a teenage royal rebel, second in line to the throne of the kingdom of Illyria. Just as her disinterest in the royal way of life is at an all-time high, she discovers she has super-human abilities and is invited to join a secret society of similar extraordinary second-born royals charged with keeping the world safe.', '/xOmGTJtBgRVSAF4S5dZEUqHqyy5.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(59, 299536, 'Avengers: Infinity War', 'en', 'As the Avengers and their allies have continued to protect the world from threats too large for any one hero to handle, a new danger has emerged from the cosmic shadows: Thanos. A despot of intergalactic infamy, his goal is to collect all six Infinity Stones, artifacts of unimaginable power, and use them to inflict his twisted will on all of reality. Everything the Avengers have fought for has led up to this moment - the fate of Earth and existence itself has never been more uncertain.', '/7WsyChQLEftFiDOVTGkv3hFpyyt.jpg', 8, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL),
(60, 547016, 'The Old Guard', 'en', 'Four undying warriors who\'ve secretly protected humanity for centuries become targeted for their mysterious powers just as they discover a new immortal.', '/cjr4NWURcVN3gW5FlHeabgBHLrY.jpg', 7, '2020-11-26 01:56:38', '2020-11-26 01:56:38', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_movies`
--

DROP TABLE IF EXISTS `user_movies`;
CREATE TABLE IF NOT EXISTS `user_movies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_movies_user_id_foreign` (`user_id`),
  KEY `user_movies_movie_id_foreign` (`movie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
