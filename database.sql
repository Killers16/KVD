-- Tabule: audzinataja        Veids:  PAMATTABULA
CREATE TABLE IF NOT EXISTS audzinataja(
    id_audz INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(40) NOT NULL,
    last_name VARCHAR(40) NOT NULL);

    -- Tabule: AUDZEKNI        Veids: AR ĀRĒJO ATSLĒGU UZ TABULU audzinataja,profesija,KURSI
CREATE TABLE IF NOT EXISTS audzekni(
    id_audzeknis INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(40) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    kurss_id INT NOT NULL,
    profesija_id INT NOT NULL,
    audzinataja_id INT NOT NULL,
    iestasanas DATE NOT NULL,
    izstasanas DATE NOT NULL,
    FOREIGN KEY(kurss_id) REFERENCES kursi(id_kurss) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(profesija_id) REFERENCES profesija(id_prof) ON UPDATE CASCADE ON DELETE CASCADE);

-- Tabule: profesija        Veids: AR ĀRĒJO ATSLĒGU UZ TABULU skolotāji 
CREATE TABLE IF NOT EXISTS profesija(
    id_prof INT AUTO_INCREMENT PRIMARY KEY,
    nosaukums VARCHAR(40) NOT NULL UNIQUE);
     
-- Tabule: KURSI        Veids: AR ĀRĒJO ATSLĒGU UZ TABULU skolotāji 
CREATE TABLE IF NOT EXISTS kursi(
    id_kurss INT AUTO_INCREMENT PRIMARY KEY,
    nosaukums VARCHAR(40) NOT NULL UNIQUE);
    




/*-- Datu ievietošana
INSERT INTO skolotaji(first_name, last_name) VALUES ('Aigars', 'Ašaks');
INSERT INTO skolotaji(first_name, last_name) VALUES ('Einārs', 'Kalpišs');

INSERT INTO prieksmeti(nosaukums, skolotajs_id) VALUES ('Datu bāzu programmēšana', 1);

INSERT INTO kursi(nosaukums, skolenu_skaits, skolotajs_id) VALUES ('4.p', 18, 2);

INSERT INTO audzekni(first_name, last_name, kurss_id) VALUES ('Armands', 'Kalējs', 1);

INSERT INTO vertejumi(audzeknis_id, prieksmets_id, datums, vertejums) VALUES (1, 1, date('2021-11-23'), '8');
*/