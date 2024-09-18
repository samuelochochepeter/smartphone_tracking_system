CREATE DATABASE smartphone_tracking;
USE smartphone_tracking;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL
);
CREATE TABLE lost_phones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    phone_model VARCHAR(100) NOT NULL,
    imei VARCHAR(50) NOT NULL,
    last_location VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE security_agency (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE admin_replies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_id INT NOT NULL,
    admin_id INT NOT NULL,  -- Assuming you have admin_id to track who replied
    reply_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (report_id) REFERENCES lost_phones(id) ON DELETE CASCADE
    -- Adjust foreign key constraint as per your table structure
);
CREATE TABLE `security_to_admin` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `admin_report_id` INT,
    `security_agency_id` INT,
    `reply_message` TEXT,
    `reply_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`admin_report_id`) REFERENCES `admin_to_security`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`security_agency_id`) REFERENCES `security_agencies`(`id`) ON DELETE CASCADE
);
CREATE TABLE `admin_to_security` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `security_agency_id` INT,
    `phone_model` VARCHAR(255),
    `imei` VARCHAR(255),
    `last_location` VARCHAR(255),
    `description` TEXT,
    `forwarded_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`security_agency_id`) REFERENCES `security_agencies`(`id`) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS `security_agencies` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS `security_replies` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `admin_to_security_id` INT,
    `reply_message` TEXT NOT NULL,
    `replied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`admin_to_security_id`) REFERENCES `admin_to_security`(`id`) ON DELETE CASCADE
);
CREATE TABLE account_block (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bank VARCHAR(255) NOT NULL,
    account_number VARCHAR(50) NOT NULL,
    account_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
