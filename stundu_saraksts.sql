-- Tabula: Student		        Veids: PAMATTABULA
CREATE TABLE students(
	id_student INT AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(40) NOT NULL,
	lastName VARCHAR(40) NOT NULL);

-- Tabula: Course		            Veids: PAMATTABULA 
CREATE TABLE courses(
	id_course INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(5) NOT NULL);


-- Tabula: Pers_code		            Veids: PAMATTABULA
	CREATE TABLE pers_codes (
	id_pers INT AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(12) NOT NULL);

-- Tabula: PRIEKSMETI		        Veids: PAMATTABULA
CREATE TABLE professions (
	id_profession INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(255) NOT NULL);


	
    
CREATE TABLE years(
    id_year INT AUTO_INCREMENT PRIMARY KEY,
    names VARCHAR(4));


-- Tabula: NODARBIBAS		        Veids: ATVASINĀTĀ TABULA (NO PAMATTABULAS)
CREATE TABLE info(
	id_info INT AUTO_INCREMENT PRIMARY KEY,
	student_id INT NOT NULL,
	course_id INT NOT NULL,
	pers_code_id INT NOT NULL,
    profession_id INT NOT NULL,
    year_id INT NOT NULL,
	FOREIGN KEY (student_id) REFERENCES students(id_student) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id_course) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (pers_code_id) REFERENCES pers_codes(id_pers) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (profession_id) REFERENCES professions(id_profession) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (year_id) REFERENCES years(id_year) ON UPDATE CASCADE ON DELETE CASCADE);
    
    
-- INSERT INTO student
INSERT INTO students(firstName, lastName) VALUES ("Anna", "Aleksejeva");
INSERT INTO students(firstName, lastName) VALUES ("Ilva", "Aleksejeva");
INSERT INTO students(firstName, lastName) VALUES ("Arturs", "Artemjevs");
INSERT INTO students(firstName, lastName) VALUES ("Aigars", "Ašaks");
INSERT INTO students(firstName, lastName) VALUES ("Ziedonis", "Bārbals");
INSERT INTO students(firstName, lastName) VALUES ("Žanete", "Beča");
INSERT INTO students(firstName, lastName) VALUES ("Iluta", "Bērziņa");
INSERT INTO students(firstName, lastName) VALUES ("Paula", "Bokāne");
INSERT INTO students(firstName, lastName) VALUES ("Marika", "Boķe");
INSERT INTO students(firstName, lastName) VALUES ("Ilze", "Briede");


-- INSERT INTO course
INSERT INTO courses(names) VALUES ("1.d");
INSERT INTO courses(names) VALUES ("1.g");
INSERT INTO courses(names) VALUES ("4.d");
INSERT INTO courses(names) VALUES ("4.p");
INSERT INTO courses(names) VALUES ("3.p");
INSERT INTO courses(names) VALUES ("2.m_2");
INSERT INTO courses(names) VALUES ("1.p");
INSERT INTO courses(names) VALUES ("3.d");
INSERT INTO courses(names) VALUES ("2.d");
INSERT INTO courses(names) VALUES ("4.k");

-- INSERT INTO pers_code
INSERT INTO pers_codes(code) VALUES (119);
INSERT INTO pers_codes(code) VALUES (121);
INSERT INTO pers_codes(code) VALUES (122);
INSERT INTO pers_codes(code) VALUES (125);
INSERT INTO pers_codes(code) VALUES (126);
INSERT INTO pers_codes(code) VALUES (211);
INSERT INTO pers_codes(code) VALUES (212);
INSERT INTO pers_codes(code) VALUES (213);
INSERT INTO pers_codes(code) VALUES (214);
INSERT INTO pers_codes(code) VALUES (201);


-- INSERT INTO profession
INSERT INTO professions (names) VALUES ("Latviešu valoda");
INSERT INTO professions (names) VALUES ("Angļu valoda");
INSERT INTO professions (names) VALUES ("Krievu valoda");
INSERT INTO professions (names) VALUES ("Matemātika");
INSERT INTO professions (names) VALUES ("Sistēmu programmēšana");
INSERT INTO professions (names) VALUES ("Datu bāzu programmēšana");
INSERT INTO professions (names) VALUES ("Ekonomika");
INSERT INTO professions (names) VALUES ("EIKT Drošas politikas veidošana");
INSERT INTO professions (names) VALUES ("Sports");
INSERT INTO professions (names) VALUES ("Tīmekļa vietņu (WEB) programmēšana");


-- INSERT INTO year
INSERT INTO years(names) VALUES (2001);
INSERT INTO years(names) VALUES (2002);
INSERT INTO years(names) VALUES (2003);
INSERT INTO years(names) VALUES (2004);
INSERT INTO years(names) VALUES (2005);
INSERT INTO years(names) VALUES (2006);
INSERT INTO years(names) VALUES (2007);
INSERT INTO years(names) VALUES (2008);
INSERT INTO years(names) VALUES (2009);
INSERT INTO years(names) VALUES (2010);

-- INSERT INTO info
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (3, 7, 5, 5, 3);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (3, 7, 5, 5, 4);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (3, 7, 5, 5, 5);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (3, 7, 5, 5, 6);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 3, 1);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 3, 2);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 3, 3);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 3, 4);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 1, 1);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 1, 2);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 1, 3);
INSERT INTO info(student_id, course_id, pers_code_id, profession_id, year_id) VALUES (5, 3, 4, 1, 4);

-- SELECT priekšmetus, ko māca Aigars Ašaks
SELECT p.nosaukums 
FROM prieksmeti p INNER JOIN skolotaji_prieksmeti sp ON sp.prieksmets_id = p.id_prieksmets, skolotaji s 
WHERE s.vards = 'Aigars' AND s.uzvards = 'Ašaks' AND sp.skolotajs_id = s.id_skolotajs







