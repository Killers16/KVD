-- Tabula: ce_exam		        Veids: PAMATTABULA
CREATE TABLE ce_exam(
	id_ce_exams INT AUTO_INCREMENT PRIMARY KEY,
	names INT(2) NOT NULL);

-- Tabula: stipend		        Veids: PAMATTABULA
CREATE TABLE stipend(
	id_stipends INT AUTO_INCREMENT PRIMARY KEY,
	names MONEY NOT NULL);

-- Tabula: Program		            Veids: PAMATTABULA
CREATE TABLE program(
	id_programs INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(40) NOT NULL);

-- Tabula: discipline		        Veids: PAMATTABULA
CREATE TABLE discipline(
	id_disciplines INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(255) NOT NULL);

CREATE TABLE kurss(
	id_kurss INT AUTO_INCREMENT PRIMARY KEY,
	nosaukums VARCHAR(10) NOT NULL);


CREATE TABLE student(
	id_students INT AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(40) NOT NULL,
	lastname VARCHAR(40) NOT NULL
	kurss_id INT NOT NULL,
 	program_id INT NOT NULL,
	personal_code VARCHAR(12)  NOT NULL,
	years INT(4) NOT NULL,
	discipline_id INT NOT NULL,
	FOREIGN KEY (program_id) REFERENCES program(id_programs) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (discipline_id) REFERENCES discipline(id_disciplines) ON UPDATE CASCADE ON DELETE CASCADE);
	FOREIGN KEY (kurss_id) REFERENCES kurss(id_kurss) ON UPDATE CASCADE ON DELETE CASCADE);


    






