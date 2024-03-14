CREATE DATABASE crmv5;

USE crmv5;

CREATE TABLE bedrift (
    bedriftid INT AUTO_INCREMENT PRIMARY KEY,
    bedriftnavn VARCHAR(100) NOT NULL,
    kontaktperson VARCHAR(45) NOT NULL
);

CREATE TABLE kontaktperson (
    kontaktpersonID INT AUTO_INCREMENT PRIMARY KEY,
    bedrift_id INT,
    fornavn VARCHAR(45) NOT NULL,
    etternavn VARCHAR(45) NOT NULL,
    epost VARCHAR(100) NOT NULL,
    telefon VARCHAR(20),
    stilling VARCHAR(50) NOT NULL,
    FOREIGN KEY (bedrift_id) REFERENCES bedrift(bedriftid) ON DELETE CASCADE
);

-- Dummy data for bedrift-tabellen
INSERT INTO bedrift (bedriftnavn, kontaktperson) VALUES
('Innovative Solutions AS', 'John Doe'),
('FutureTech Group', 'Mark Johnson'),
('Visionary Concepts Ltd', 'Sarah Williams');

-- Dummy data for kontaktperson-tabellen
INSERT INTO kontaktperson (fornavn, etternavn, epost, telefon, stilling) VALUES
('John', 'Doe', 'john.doe@innovativesolutions.com', '12345678', 'CEO'),
('Jane', 'Smith', 'jane.smith@innovativesolutions.com', '98765432', 'CTO'),
('Mark', 'Johnson', 'mark.johnson@futuretechgroup.com', '87654321', 'Head of Development'),
('Sarah', 'Williams', 'sarah.williams@visionaryconcepts.com', '56789012', 'Marketing Director');
