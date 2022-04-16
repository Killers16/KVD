-- Tabula: Student		        Veids: PAMATTABULA
CREATE TABLE students(
	id_student INT AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(40) NOT NULL,
	lastName VARCHAR(40) NOT NULL,
	codes VARCHAR(12) NOT NULL,
	years VARCHAR(4) NOT NULL);
-- Tabula: Course		            Veids: PAMATTABULA 
CREATE TABLE courses(
	id_course INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(5) NOT NULL);




-- Tabula: PRIEKSMETI		        Veids: PAMATTABULA
CREATE TABLE professions (
	id_profession INT AUTO_INCREMENT PRIMARY KEY,
	names VARCHAR(255) NOT NULL);

-- Tabula: NODARBIBAS		        Veids: ATVASINĀTĀ TABULA (NO PAMATTABULAS)
CREATE TABLE info(
	id_info INT AUTO_INCREMENT PRIMARY KEY,
	student_id INT NOT NULL,
	course_id INT NOT NULL,
	
    profession_id INT NOT NULL,
   
	FOREIGN KEY (student_id) REFERENCES students(id_student) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id_course) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (profession_id) REFERENCES professions(id_profession) ON UPDATE CASCADE ON DELETE CASCADE);
   
    
    
-- INSERT INTO student
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Anna", "Aleksejeva","119","2001");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Ilva", "Aleksejeva","121","2002");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Arturs", "Artemjevs","122","2003");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Aigars", "Ašaks","125","2004");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Ziedonis", "Bārbals","126","2005");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Žanete", "Beča","211","2006");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Iluta", "Bērziņa","212","2007");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Paula", "Bokāne","213","2008");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Marika", "Boķe","214","2009");
INSERT INTO students(firstName, lastName,codes,years) VALUES ("Ilze", "Briede","201","2010");


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


-- INSERT INTO info
INSERT INTO info(student_id, course_id, profession_id) VALUES (1, 5,  5 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (3, 7,  4 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (4, 2,  5 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (3, 7,  2 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (6, 1,  3 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (5, 3,  4 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (7, 2,  3 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (5, 3,  3 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (8, 4,  5 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (5, 3,  1 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (8, 5,  6 );
INSERT INTO info(student_id, course_id, profession_id) VALUES (9, 3,  1 );


-- SELECT priekšmetus, ko māca Aigars Ašaks
SELECT p.nosaukums 
FROM prieksmeti p INNER JOIN skolotaji_prieksmeti sp ON sp.prieksmets_id = p.id_prieksmets, skolotaji s 
WHERE s.vards = 'Aigars' AND s.uzvards = 'Ašaks' AND sp.skolotajs_id = s.id_skolotajs







