-- Tabula: Student		        Veids: PAMATTABULA
CREATE TABLE students(
	id_student INT AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(40) NOT NULL,
	lastName VARCHAR(40) NOT NULL,
	codes VARCHAR(12) NOT NULL,
	courses VARCHAR(12) NOT NULL,
	professions VARCHAR(255 ) NOT NULL,
	years VARCHAR(4) NOT NULL,
	phone double NOT NULL,
	lastSchool VARCHAR(255) NOT NULL);

-- Tabula: PRIEKSMETI		        Veids: PAMATTABULA
CREATE TABLE remarks (
	id_remarks INT AUTO_INCREMENT PRIMARY KEY,
	students_id INT NOT NULL,
	names VARCHAR(255) NOT NULL,
	FOREIGN KEY (students_id) REFERENCES students(id_student) ON UPDATE CASCADE ON DELETE CASCADE);
-- Tabula: Student		        Veids: PAMATTABULA
CREATE TABLE certificates(
	id_ce INT AUTO_INCREMENT PRIMARY KEY,
	students_id INT NOT NULL,
	ce_names VARCHAR(255) NOT NULL,
	ce_codes VARCHAR(25) NOT NULL,
	items VARCHAR(255) NOT NULL,
	ce_years year(4) NOT NULL,
	FOREIGN KEY (students_id) REFERENCES students(id_student) ON UPDATE CASCADE ON DELETE CASCADE);
