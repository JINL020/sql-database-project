--create gebaeude
CREATE TABLE gebaeude (
    gebname VARCHAR(100),
    strasse VARCHAR(100) NOT NULL,
    plz INTEGER NOT NULL, 
    ort VARCHAR(100) NOT NULL,
    grundflaeche INTEGER NOT NULL,
    CONSTRAINT gebaeude_pk PRIMARY KEY(gebname)
);

--create raum
CREATE TABLE raum(
raumnr INTEGER,
raumname VARCHAR(100),
gebname VARCHAR (100),
CONSTRAINT raum_pk PRIMARY KEY (raumnr,gebname),
CONSTRAINT raums_gebaede_fk FOREIGN KEY(gebname) REFERENCES gebaeude(gebname)
ON DELETE CASCADE
);

--create ausstattung
CREATE TABLE ausstattung(
ausstattungsID INTEGER,
ausstattungsname VARCHAR(100),
raumnr INTEGER,
gebname VARCHAR(100),
CONSTRAINT ausstattung_pk PRIMARY KEY(ausstattungsID,raumnr,gebname),
CONSTRAINT ausstattung_raum_fk FOREIGN KEY(gebname,raumnr) REFERENCES raum(gebname,raumnr)
ON DELETE CASCADE
);

--gebaeude insert
INSERT INTO gebaeude (gebname, grundflaeche, strasse, plz, ort)
VALUES('Informatik', 1000, 'Waehringer Strasse 29', 1090, 'Wien');   
INSERT INTO gebaeude (gebname, grundflaeche, strasse, plz, ort)
VALUES('Biologie', 1000, 'Althanstrasse 14', 1090, 'Wien');
        
--raum insert
INSERT INTO raum (gebname, raumnr, raumname)
VALUES('Informatik', 100, 'HS1');
INSERT INTO raum (gebname, raumnr, raumname)
VALUES('Informatik', 200, 'HS2');
INSERT INTO raum (gebname, raumnr, raumname)
VALUES('Biologie', 100, 'HS1');
INSERT INTO raum (gebname, raumnr, raumname)
VALUES('Biologie', 200, 'HS2');

--insert ausstattung
INSERT INTO ausstattung (ausstattungsID, ausstattungsname, gebname, raumnr)
VALUES(1, 'Computer', 'Informatik', '100');
INSERT INTO ausstattung (ausstattungsID, ausstattungsname, gebname, raumnr)
VALUES(2, 'Computer', 'Informatik', '100');
INSERT INTO ausstattung (ausstattungsID, ausstattungsname, gebname, raumnr)
VALUES(1, 'Whiteboard', 'Informatik', '200');

INSERT INTO ausstattung (ausstattungsID, ausstattungsname, gebname, raumnr)
VALUES(1, 'Computer', 'Biologie', '100');
INSERT INTO ausstattung (ausstattungsID, ausstattungsname, gebname, raumnr)
VALUES(2, 'Computer', 'Biologie', '100');
INSERT INTO ausstattung (ausstattungsID, ausstattungsname, gebname, raumnr)
VALUES(1, 'Whiteboard', 'Biologie', '200');

SELECT * FROM gebaeude;
SELECT * FROM raum;
SELECT *FROM ausstattung;

DELETE FROM raum
WHERE raumnr = 100 AND gebname = 'Biologie';

SELECT * FROM gebaeude;
SELECT * FROM raum;
SELECT *FROM ausstattung;

DELETE FROM gebaeude 
WHERE gebname = 'Biologie';

SELECT * FROM gebaeude;
SELECT * FROM raum;
SELECT *FROM ausstattung;

--DROP TABLE
DROP TABLE ausstattung;
DROP TABLE raum;
DROP TABLE gebaeude;







