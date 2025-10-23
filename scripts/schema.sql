-- Create database
CREATE DATABASE IF NOT EXISTS sancturia_wildlife CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sancturia_wildlife;

-- Users table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    donation_total DECIMAL(10,2) DEFAULT 0.00,
    adoptions_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Donations table
CREATE TABLE donations (
    donation_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    donor_name VARCHAR(100) NOT NULL,
    donor_email VARCHAR(150) NOT NULL,
    donor_phone VARCHAR(15),
    amount DECIMAL(10,2) NOT NULL,
    sanctuary_name VARCHAR(200),
    recurring_type ENUM('none', 'monthly', 'yearly') DEFAULT 'none',
    donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'completed',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_donation_date (donation_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Adoptions table
CREATE TABLE adoptions (
    adoption_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    animal_name VARCHAR(100) NOT NULL,
    animal_type VARCHAR(50),
    sanctuary_name VARCHAR(200),
    adoption_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sanctuaries table
CREATE TABLE sanctuaries (
    sanctuary_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) UNIQUE NOT NULL,
    location VARCHAR(100) NOT NULL,
    description TEXT,
    image_path VARCHAR(255),
    website_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sessions table
CREATE TABLE sessions (
    session_id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    session_data TEXT,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_last_activity (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;