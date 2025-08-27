

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET AUTOCOMMIT = 0;
-- START TRANSACTION;
-- SET time_zone = "+00:00";



-- Database: `ciams`
-- --------------------------------------------------------

-- Table structure for table `admin_login`
CREATE TABLE `admin_login` (
  `userid` VARCHAR(30) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table `admin_login`
INSERT INTO `admin_login` (`userid`, `password`) VALUES
('sanjai', '25');

-- --------------------------------------------------------

-- Table structure for table `class`
CREATE TABLE `class` (
  `id` VARCHAR(10) NOT NULL PRIMARY KEY,
  `name` VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `students`
CREATE TABLE `students` (
  `rno` VARCHAR(10) NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `class_name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`rno`),
  KEY `class_name` (`class_name`),
  CONSTRAINT `fk_students_class` FOREIGN KEY (`class_name`) REFERENCES `class` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `students`
ADD COLUMN `phone` VARCHAR(15) NOT NULL;

-- --------------------------------------------------------

-- Table structure for table `result`
CREATE TABLE `result` (
    `rno` VARCHAR(10) NOT NULL,
    `name` VARCHAR(30) NOT NULL,
    `class` VARCHAR(30) NOT NULL,
    `marks` INT NOT NULL,
    `subject` VARCHAR(30) NOT NULL,
    `percentage` DECIMAL(5,2) NOT NULL,
    `one_1` INT, `one_2` INT, `one_3` INT, `one_4` INT, `one_5` INT,
    `one_6` INT, `one_7` INT, `one_8` INT, `one_9` INT, `one_10` INT,
    `five_1` INT, `five_opt_1` CHAR(1), `five_2` INT, `five_opt_2` CHAR(1),
    `five_3` INT, `five_opt_3` CHAR(1), `five_4` INT, `five_opt_4` CHAR(1),
    `ten_1` INT, `ten_opt_1` CHAR(1), `ten_2` INT, `ten_opt_2` CHAR(1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`rno`),
    KEY `class` (`class`),
    CONSTRAINT `fk_result_class` FOREIGN KEY (`class`) REFERENCES `class` (`name`) ON DELETE CASCADE,
    CONSTRAINT `fk_result_students` FOREIGN KEY (`rno`) REFERENCES `students` (`rno`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

COMMIT;
