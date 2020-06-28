-- phpMyAdmin SQL Dump
-- version 5.0.0-alpha1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Sob 30. kvě 2020, 18:52
-- Verze serveru: 10.3.22-MariaDB-1
-- Verze PHP: 7.3.17-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `testing_db`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `main_posts`
--

CREATE TABLE `main_posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `img` text NOT NULL,
  `author` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `template` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `main_posts`
--

INSERT INTO `main_posts` (`id`, `title`, `text`, `img`, `author`, `date`, `time`, `template`) VALUES
(1, 'Lorem ipsum dolor sit amet', '&lt;div class=&quot;card-body&quot;&gt;\r\n&lt;div class=&quot;card-text&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris hendrerit u&lt;span style=&quot;background-color: #ff0000;&quot;&gt;ltricies erat facilisis luc&lt;/span&gt;tus. Viv&lt;em&gt;amus mattis metus at rhoncu&lt;/em&gt;s&lt;span style=&quot;color: #ff6600;&quot;&gt; tempor. Pellentesque vulputate er&lt;/span&gt;at et vehicula dignissim. Donec id gravida nulla. Maecenas pharetra pellentesque facilisis. Nullam nec porta arcu. Cras eget justo sit amet risus molestie &lt;strong&gt;vehicula sodales mattis elit. Donec consectetur viverra magna, eu auctor felis scelerisque vitae. Donec condimentum ex sit&lt;/strong&gt; amet nisl faucibus ullamcorper. Nam id est sed lacus rhoncus pharetra. Nam id diam a orci facilisis consequat finibus cursus velit.&lt;/div&gt;\r\n&lt;/div&gt;', 'core/images/posts/blog_post_1.png', 'admin', '30.05.2020', '18:38:12', 'default'),
(2, 'Maecenas pharetra pellentesque', '&lt;div class=&quot;card-body&quot;&gt;\r\n&lt;div class=&quot;card-text&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris hendrerit ultricies erat facilisis luctus. Vivamus mattis metus at rhoncus tempor. Pellentesque vulputate erat et vehicula dignissim. Donec id gravida nulla. Maecenas pharetra pellentesque facilisis. Nullam nec porta arcu. Cras eget justo sit amet risus molestie vehicula sodales mattis elit. Donec consectetur viverra magna, eu auctor felis scelerisque vitae. Donec condimentum ex sit amet nisl faucibus ullamcorper. Nam id est sed lacus rhoncus pharetra. Nam id diam a orci facilisis consequat finibus cursus velit.&lt;/div&gt;\r\n&lt;/div&gt;', 'core/images/posts/blog_post_2.png', 'admin', '30.05.2020', '18:38:39', 'next');

-- --------------------------------------------------------

--
-- Struktura tabulky `main_users`
--

CREATE TABLE `main_users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `rank` text NOT NULL,
  `web_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `main_users`
--

INSERT INTO `main_users` (`id`, `username`, `password`, `rank`, `web_admin`) VALUES
(1, 'admin', '$2y$10$p0gRjB0TR8eAeYuTfojJ3e8kNczeQ1QqlZPReOHfHD4TuzTdBS6Kq', 'admin', 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `main_posts`
--
ALTER TABLE `main_posts`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `main_users`
--
ALTER TABLE `main_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `main_posts`
--
ALTER TABLE `main_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `main_users`
--
ALTER TABLE `main_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

