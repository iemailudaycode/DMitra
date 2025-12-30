-- Create the database
CREATE DATABASE IF NOT EXISTS job_board;
USE job_board;

-- Create categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create jobs table
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    title VARCHAR(255) NOT NULL,
    application_fee DECIMAL(10, 2),
    start_date DATE,
    end_date DATE,
    min_age INT,
    max_age INT,
    male_height DECIMAL(5, 2),
    female_height DECIMAL(5, 2),
    chest_male DECIMAL(5, 2),
    weight DECIMAL(5, 2),
    qualification TEXT,
    apply_link VARCHAR(255),
    official_website VARCHAR(255),
    detailed_notification TEXT,
    study_material TEXT,
    youtube_links TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Create admins table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert categories
INSERT INTO categories (name) VALUES 
('AR'), ('BSF'), ('CISF'), ('CRPF'), ('CAPF'), ('ITBP'), ('NSG'), ('SSB');

-- Insert admin user (password: admin)
INSERT INTO admins (username, password) VALUES ('admin', SHA2('admin', 256));
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);