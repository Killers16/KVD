-- Tabula: SKOLOTAJI		        Veids: PAMATTABULA
CREATE TABLE skolotaji(
	id_skolotajs INT AUTO_INCREMENT PRIMARY KEY,
	vards VARCHAR(40) NOT NULL,
	uzvards VARCHAR(40) NOT NULL);

-- Tabula: KABINETI		            Veids: PAMATTABULA
CREATE TABLE kabineti(
	id_kabinets INT AUTO_INCREMENT PRIMARY KEY,
	nosaukums VARCHAR(40) NOT NULL);

-- Tabula: PRIEKSMETI		        Veids: PAMATTABULA
CREATE TABLE prieksmeti(
	id_prieksmets INT AUTO_INCREMENT PRIMARY KEY,
	nosaukums VARCHAR(255) NOT NULL);

-- Tabula: SKOLOTAJI_PRIEKSMETI		Veids: ATVASINĀTĀ TABULA (NO PAMATTABULAS)
CREATE TABLE skolotaji_prieksmeti(
	id_sp INT AUTO_INCREMENT PRIMARY KEY,
	skolotajs_id INT,
	prieksmets_id INT,
	FOREIGN KEY (skolotajs_id) REFERENCES skolotaji(id_skolotajs) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (prieksmets_id) REFERENCES prieksmeti(id_prieksmets) ON UPDATE CASCADE ON DELETE CASCADE);

-- Tabula: KLASES		            Veids: ATVASINĀTĀ TABULA (NO PAMATTABULAS)
CREATE TABLE klases(
	id_klase INT AUTO_INCREMENT PRIMARY KEY,
	nosaukums VARCHAR(10) NOT NULL,
	audzinatajs_id INT,
	FOREIGN KEY (audzinatajs_id) REFERENCES skolotaji(id_skolotajs) ON UPDATE CASCADE ON DELETE CASCADE);
    
-- Tabula: DIENAS                   Veids: PAMATTABULA
CREATE TABLE dienas(
    id_diena INT AUTO_INCREMENT PRIMARY KEY,
    nosaukums VARCHAR(15));
    
-- Tabula: STUNDAS                   Veids: PAMATTABULA
CREATE TABLE stundas(
    id_stunda INT AUTO_INCREMENT PRIMARY KEY,
    nosaukums TINYINT);

-- Tabula: NODARBIBAS		        Veids: ATVASINĀTĀ TABULA (NO ATVASINĀTĀs TABULAS)
CREATE TABLE nodarbibas(
	id_nodarbiba INT AUTO_INCREMENT PRIMARY KEY,
	sp_id INT NOT NULL,
	kabinets_id INT,
    klase_id INT NOT NULL,
    diena_id INT NOT NULL,
    stunda_id INT NOT NULL,
	FOREIGN KEY (sp_id) REFERENCES skolotaji_prieksmeti(id_sp) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (kabinets_id) REFERENCES kabineti(id_kabinets) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (klase_id) REFERENCES klases(id_klase) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (diena_id) REFERENCES dienas(id_diena) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (stunda_id) REFERENCES stundas(id_stunda) ON UPDATE CASCADE ON DELETE CASCADE);
    
-- INSERT INTO skolotaji
INSERT INTO skolotaji(vards, uzvards) VALUES ("Anna", "Aleksejeva");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Ilva", "Aleksejeva");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Arturs", "Artemjevs");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Aigars", "Ašaks");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Ziedonis", "Bārbals");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Žanete", "Beča");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Iluta", "Bērziņa");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Paula", "Bokāne");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Marika", "Boķe");
INSERT INTO skolotaji(vards, uzvards) VALUES ("Ilze", "Briede");

-- INSERT INTO kabineti
INSERT INTO kabineti(nosaukums) VALUES (119);
INSERT INTO kabineti(nosaukums) VALUES (121);
INSERT INTO kabineti(nosaukums) VALUES (122);
INSERT INTO kabineti(nosaukums) VALUES (125);
INSERT INTO kabineti(nosaukums) VALUES (126);
INSERT INTO kabineti(nosaukums) VALUES (211);
INSERT INTO kabineti(nosaukums) VALUES (212);
INSERT INTO kabineti(nosaukums) VALUES (213);
INSERT INTO kabineti(nosaukums) VALUES (214);
INSERT INTO kabineti(nosaukums) VALUES ("Sporta zāle");

-- INSERT INTO klases
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("1.d", 6);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("1.g", 2);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("4.d", 1);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("4.p", 9);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("3.p", 9);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("2.m_2", 8);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("1.p", 4);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("3.d", 3);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("2.d", 5);
INSERT INTO klases(nosaukums, audzinatajs_id) VALUES ("4.k", 10);

-- INSERT INTO prieksmeti
INSERT INTO prieksmeti(nosaukums) VALUES ("Latviešu valoda");
INSERT INTO prieksmeti(nosaukums) VALUES ("Angļu valoda");
INSERT INTO prieksmeti(nosaukums) VALUES ("Krievu valoda");
INSERT INTO prieksmeti(nosaukums) VALUES ("Matemātika");
INSERT INTO prieksmeti(nosaukums) VALUES ("Sistēmu programmēšana");
INSERT INTO prieksmeti(nosaukums) VALUES ("Datu bāzu programmēšana");
INSERT INTO prieksmeti(nosaukums) VALUES ("Ekonomika");
INSERT INTO prieksmeti(nosaukums) VALUES ("EIKT Drošas politikas veidošana");
INSERT INTO prieksmeti(nosaukums) VALUES ("Sports");
INSERT INTO prieksmeti(nosaukums) VALUES ("Tīmekļa vietņu (WEB) programmēšana");

-- INSERT INTO skolotaji_prieksmeti
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (2, 9);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (10, 1);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (4, 4);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (4, 5);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (4, 6);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (4, 10);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (9, 7);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (3, 8);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (7, 2);
INSERT INTO skolotaji_prieksmeti(skolotajs_id, prieksmets_id) VALUES (8, 3);

-- INSERT INTO dienas
INSERT INTO dienas (nosaukums) VALUES ("Pirmdiena");
INSERT INTO dienas (nosaukums) VALUES ("Otrdiena");
INSERT INTO dienas (nosaukums) VALUES ("Trešdiena");
INSERT INTO dienas (nosaukums) VALUES ("Ceturtdiena");
INSERT INTO dienas (nosaukums) VALUES ("Piektdiena");

-- INSERT INTO dienas
INSERT INTO stundas (nosaukums) VALUES (1);
INSERT INTO stundas (nosaukums) VALUES (2);
INSERT INTO stundas (nosaukums) VALUES (3);
INSERT INTO stundas (nosaukums) VALUES (4);
INSERT INTO stundas (nosaukums) VALUES (5);
INSERT INTO stundas (nosaukums) VALUES (6);
INSERT INTO stundas (nosaukums) VALUES (7);
INSERT INTO stundas (nosaukums) VALUES (8);
INSERT INTO stundas (nosaukums) VALUES (9);
INSERT INTO stundas (nosaukums) VALUES (10);

-- INSERT INTO nodarbibas
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (3, 7, 5, 5, 3);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (3, 7, 5, 5, 4);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (3, 7, 5, 5, 5);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (3, 7, 5, 5, 6);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 3, 1);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 3, 2);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 3, 3);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 3, 4);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 1, 1);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 1, 2);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 1, 3);
INSERT INTO nodarbibas(sp_id, kabinets_id, klase_id, diena_id, stunda_id) VALUES (5, 3, 4, 1, 4);

-- SELECT priekšmetus, ko māca Aigars Ašaks
SELECT p.nosaukums 
FROM prieksmeti p INNER JOIN skolotaji_prieksmeti sp ON sp.prieksmets_id = p.id_prieksmets, skolotaji s 
WHERE s.vards = 'Aigars' AND s.uzvards = 'Ašaks' AND sp.skolotajs_id = s.id_skolotajs







