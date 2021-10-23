DELETE FROM Unite;
DELETE FROM Allergene;
DELETE FROM Categorie_Fiche;
DELETE FROM Categorie_Ingredient;
DELETE FROM TVA;
DELETE FROM coeffAss;
DELETE FROM coeffCoutPersonnel;

INSERT INTO Unite VALUES('1','Kg');
INSERT INTO Unite VALUES('2','Gramme');
INSERT INTO Unite VALUES('3','mg');
INSERT INTO Unite VALUES('4','Kl');
INSERT INTO Unite VALUES('5','Litre');
INSERT INTO Unite VALUES('6','ml');
INSERT INTO Unite VALUES('7','Autre');


INSERT INTO Allergene VALUES('1','Arachide');
INSERT INTO Allergene VALUES('2','Céleri');
INSERT INTO Allergene VALUES('3','Crustacé');
INSERT INTO Allergene VALUES('4','Céréales contenant du Gluten');
INSERT INTO Allergene VALUES('5','Fruit à coque');
INSERT INTO Allergene VALUES('6','Lait');
INSERT INTO Allergene VALUES('7','Lupin');
INSERT INTO Allergene VALUES('8','Œuf');
INSERT INTO Allergene VALUES('9','Poisson');
INSERT INTO Allergene VALUES('10','Mollusque');
INSERT INTO Allergene VALUES('11','Moutarde');
INSERT INTO Allergene VALUES('12','Sésame');
INSERT INTO Allergene VALUES('13','Soja');
INSERT INTO Allergene VALUES('14','Sulfites');


INSERT INTO Categorie_Fiche VALUES('1','Entrée');
INSERT INTO Categorie_Fiche VALUES('2','Plat');
INSERT INTO Categorie_Fiche VALUES('3','Dessert');
INSERT INTO Categorie_Fiche VALUES('4','Accompagnement');
INSERT INTO Categorie_Fiche VALUES('5','Autre');


INSERT INTO Categorie_Ingredient VALUES('1','Viande');
INSERT INTO Categorie_Ingredient VALUES('2','Poisson');
INSERT INTO Categorie_Ingredient VALUES('3','Produit laitier');
INSERT INTO Categorie_Ingredient VALUES('4','Fruit');
INSERT INTO Categorie_Ingredient VALUES('5','Légume');
INSERT INTO Categorie_Ingredient VALUES('6','Légume');


INSERT INTO TVA VALUES('1','Taxe produit de luxe','0.2');
INSERT INTO TVA VALUES('2','Taxe consommation immédiate','0.1');
INSERT INTO TVA VALUES('3','Taxe produit emballé','0.055');

INSERT INTO coeffAss VALUES('1','0.05');

INSERT INTO coeffCoutPersonnel VALUES('1','0.02');
INSERT INTO coeffCoutPersonnel VALUES('2','0.5');
INSERT INTO coeffCoutPersonnel VALUES('3','0.1');
INSERT INTO coeffCoutPersonnel VALUES('4','0.2');
INSERT INTO coeffCoutPersonnel VALUES('5','0.33');
INSERT INTO coeffCoutPersonnel VALUES('6','0.7');
INSERT INTO coeffCoutPersonnel VALUES('7','0.75');
INSERT INTO coeffCoutPersonnel VALUES('8','1');
INSERT INTO coeffCoutPersonnel VALUES('9','1.5');
INSERT INTO coeffCoutPersonnel VALUES('10','2');
INSERT INTO coeffCoutPersonnel VALUES('11','2.25');
INSERT INTO coeffCoutPersonnel VALUES('12','2.5');
INSERT INTO coeffCoutPersonnel VALUES('13','3');
INSERT INTO coeffCoutPersonnel VALUES('14','6');
INSERT INTO coeffCoutPersonnel VALUES('15','6.5');
INSERT INTO coeffCoutPersonnel VALUES('16','7');
INSERT INTO coeffCoutPersonnel VALUES('17','18');