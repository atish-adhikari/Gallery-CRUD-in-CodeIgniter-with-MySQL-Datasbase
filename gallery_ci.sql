-- Generation Time: Aug 28, 2017 at 06:48 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL COMMENT 'Album ID',
  `featured` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Featured Image',
  `title` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Album Title',
  `created_on` date NOT NULL COMMENT 'Created Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Table structure for table `album_pictures`
--

CREATE TABLE `album_pictures` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Image ID',
  `album_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Album ID',
  `image` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Image Name',
  `title` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Image Title'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_pictures`
--
ALTER TABLE `album_pictures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Album ID', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `album_pictures`
--
ALTER TABLE `album_pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Image ID', AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
