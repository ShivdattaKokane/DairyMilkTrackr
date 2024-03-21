-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2021 at 12:55 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dry`
--


--
CREATE TABLE `farmer` (
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(20) NOT NULL,
  `ph` VARCHAR(10) NOT NULL,
  `f_vid` INT(3) NOT NULL,
  `advanceSalary` DECIMAL(10, 2) NOT NULL,
  `animalCount` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;








CREATE TABLE record (
    id int(11) NOT NULL AUTO_INCREMENT,
    fid int(11),
    quan float,
    fat float,
    snf float,
    rate_per_liter float,
    dt date DEFAULT CURRENT_DATE, -- Default value set to the current date
    total_amount float,
    advance_deduction float, -- Assuming this column will be added
    PRIMARY KEY (id),
    INDEX fid_index (fid),
    FOREIGN KEY (fid) REFERENCES farmer(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `login` (`uname`, `pass`) VALUES ('Shivakokane', 'Shiva@123');



--
-- Animal Table
CREATE TABLE `animal` (
  `animalID` varchar(15) NOT NULL,
  `healthID` int(12) NOT NULL,
  `milk_type` varchar(10) NOT NULL,
  `min_litre` int(2) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `farmer_id` int(5) NOT NULL,
  PRIMARY KEY (`animalID`),
  FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




--
-- Indexes for table `Dairy_customers`
--
CREATE TABLE Dairy_customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_mobile VARCHAR(15) NOT NULL,
    Total_cost DECIMAL(10, 2) NOT NULL,
    PR1 DECIMAL(10, 2) NOT NULL,
    PR2 DECIMAL(10, 2) NOT NULL,
    PR3 DECIMAL(10, 2) NOT NULL,
    PR4 DECIMAL(10, 2) NOT NULL,
    farmer_id INT NOT NULL,
    FOREIGN KEY (farmer_id) REFERENCES farmer(id)
);
 
--
-- Indexes for table `bill`
--
-- ALTER TABLE `bill`
--   ADD PRIMARY KEY (`bill_id`),
--   ADD KEY `farmer_id` (`farmer_id`),
--   ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `employee`
--
-- ALTER TABLE `employee`
--   ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  -- ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ph` (`ph`);

--
-- Indexes for table `milk_center`
--
-- ALTER TABLE `milk_center`
--   ADD PRIMARY KEY (`cid`),
--   ADD KEY `staff_id` (`staff_id`),
--   ADD KEY `village_id` (`village_id`);

--
-- Indexes for table `products`
--
-- ALTER TABLE `products`
--   ADD PRIMARY KEY (`pid`),
--   ADD UNIQUE KEY `pid` (`pid`,`pname`);

--
-- Indexes for table `record`
-- --
-- ALTER TABLE `record`
--   ADD KEY `fid` (`fid`);

-- --
-- -- Indexes for table `village`
-- --
-- ALTER TABLE `village`
--   ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
-- ALTER TABLE `bill`
--   MODIFY `bill_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

-- --
-- -- AUTO_INCREMENT for table `employee`
-- --
-- ALTER TABLE `employee`
  -- MODIFY `eid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12351;

--
-- AUTO_INCREMENT for table `farmer`
--
-- ALTER TABLE `farmer`
--   MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- --
-- -- AUTO_INCREMENT for table `products`
-- --
-- ALTER TABLE `products`
--   MODIFY `pid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- --
-- -- AUTO_INCREMENT for table `village`
-- --
-- ALTER TABLE `village`
--   MODIFY `vid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--
ALTER TABLE dairy_customers
ADD COLUMN buying_date DATE NOT NULL DEFAULT CURRENT_DATE;


--
-- Constraints for table `bill`
--
-- ALTER TABLE `bill`
--   ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`),
--   ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `milk_center` (`cid`);

--
-- Constraints for table `milk_center`
--
-- ALTER TABLE `milk_center`
--   ADD CONSTRAINT `milk_center_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `employee` (`eid`),
--   ADD CONSTRAINT `milk_center_ibfk_2` FOREIGN KEY (`village_id`) REFERENCES `village` (`vid`);

--
-- Constraints for table `record`
--
-- ALTER TABLE `record`
--   ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `farmer` (`id`);
-- COMMIT;

ALTER TABLE Dairy_customers CHANGE PR1 Bhusa decimal(10,2);
ALTER TABLE Dairy_customers CHANGE PR2 Golipend decimal(10,2);
ALTER TABLE Dairy_customers CHANGE PR3 Saraki_pend decimal(10,2);
ALTER TABLE Dairy_customers CHANGE PR4 Sengdana_pend decimal(10,2);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
