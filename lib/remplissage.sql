DELETE FROM Unite;
DELETE FROM Allergene;
DELETE FROM Categorie_Fiche;
DELETE FROM Categorie_Ingredient;
DELETE FROM TVA;

INSERT INTO Unite VALUES('1','Kilo');
INSERT INTO Unite VALUES('2','Litre');
INSERT INTO Unite VALUES('3','Gramme');
INSERT INTO Unite VALUES('4','Autre');


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


INSERT INTO Categorie_Ingredient VALUES('1','Viande');
INSERT INTO Categorie_Ingredient VALUES('2','Poisson');
INSERT INTO Categorie_Ingredient VALUES('3','Produit laitier');
INSERT INTO Categorie_Ingredient VALUES('4','Fruit');
INSERT INTO Categorie_Ingredient VALUES('5','Légume');


INSERT INTO TVA VALUES('1','Taxe produit de luxe','0.2');
INSERT INTO TVA VALUES('2','Taxe consommation immédiate','0.1');
INSERT INTO TVA VALUES('3','Taxe produit emballé','0.055');