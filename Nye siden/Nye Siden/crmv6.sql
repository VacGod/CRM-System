CREATE DATABASE IF NOT EXISTS crmv6;

USE crmv6;

CREATE TABLE IF NOT EXISTS bedrift (
    bedriftid INT AUTO_INCREMENT PRIMARY KEY,
    bedriftnavn VARCHAR(100) NOT NULL,
    fornavn VARCHAR(45) NOT NULL,
    etternavn VARCHAR(45) NOT NULL
);

CREATE TABLE IF NOT EXISTS kontaktperson (
    kontaktpersonID INT AUTO_INCREMENT PRIMARY KEY,
    bedrift_id INT,
    bedrift_navn VARCHAR(100),
    fornavn VARCHAR(45) NOT NULL,
    etternavn VARCHAR(45) NOT NULL,
    epost VARCHAR(100) NOT NULL,
    telefon VARCHAR(20),
    stilling VARCHAR(50) NOT NULL,
    FOREIGN KEY (bedrift_id) REFERENCES bedrift(bedriftid) ON DELETE CASCADE
);

-- Dummy data for bedrift-tabellen
INSERT INTO bedrift (bedriftnavn, fornavn, etternavn) VALUES
('Innovative Solutions AS', 'John', 'Doe'),
('FutureTech Group', 'Mark', 'Johnson'),
('Visionary Concepts Ltd', 'Sarah', 'Williams'),
('TechSavvy Innovations', 'Alex', 'Wong'),
('DataSphere Solutions', 'Emily', 'Chen'),
('Futuristic Enterprises', 'Michael', 'Jones'),
('TechGenius Solutions', 'Laura', 'Miller'),
('Infinite Innovations', 'Daniel', 'Brown');

-- Dummy data for kontaktperson-tabellen
INSERT INTO kontaktperson (bedrift_id, bedrift_navn, fornavn, etternavn, epost, telefon, stilling) VALUES
(1, 'Innovative Solutions AS', 'John', 'Doe', 'john.doe@innovativesolutions.com', '12345678', 'CEO'),
(1, 'Innovative Solutions AS', 'Jane', 'Smith', 'jane.smith@innovativesolutions.com', '98765432', 'CTO'),
(2, 'FutureTech Group', 'Mark', 'Johnson', 'mark.johnson@futuretechgroup.com', '87654321', 'Head of Development'),
(3, 'Visionary Concepts Ltd', 'Sarah', 'Williams', 'sarah.williams@visionaryconcepts.com', '56789012', 'Marketing Director'),
(4, 'TechSavvy Innovations', 'Alex', 'Wong', 'alex.wong@techsavvy.com', '65432109', 'Lead Engineer'),
(5, 'DataSphere Solutions', 'Emily', 'Chen', 'emily.chen@datasphere.com', '32109876', 'Data Analyst'),
(6, 'Futuristic Enterprises', 'Michael', 'Jones', 'michael.jones@futuristic.com', '13579086', 'Project Manager'),
(7, 'TechGenius Solutions', 'Laura', 'Miller', 'laura.miller@techgenius.com', '24680135', 'Software Developer'),
(8, 'Infinite Innovations', 'Daniel', 'Brown', 'daniel.brown@infiniteinnovations.com', '80808080', 'System Architect');
