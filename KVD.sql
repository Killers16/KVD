-- Tabula: Student		        Veids: PAMATTABULA
CREATE TABLE students(
	id_student INT AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(40) NOT NULL,
	lastName VARCHAR(40) NOT NULL,
	codes VARCHAR(12) NOT NULL,
	professions VARCHAR(255 ) NOT NULL,
	years VARCHAR(4) NOT NULL);

-- Tabula: PRIEKSMETI		        Veids: PAMATTABULA
CREATE TABLE remarks (
	id_remarks INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(255) NOT NULL,
	firstName VARCHAR(40) NOT NULL,
	lastName VARCHAR(40) NOT NULL);