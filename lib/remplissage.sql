DELETE FROM Unite;
DELETE FROM Allergene;
DELETE FROM Categorie_Fiche;
DELETE FROM Categorie_Ingredient;
DELETE FROM TVA;
DELETE FROM coeffAss;
DELETE FROM coeffCoutPersonnel;
DELETE FROM etape;
DELETE FROM fichetechnique;
DELETE FROM ingredient;


INSERT INTO fichetechnique VALUES('1','Meringues framboises cranberry','4','Maxime','1','1','1','1');
INSERT INTO fichetechnique VALUES('2','Guimauve passion','8','Pierre','1','2','1','2');
INSERT INTO fichetechnique VALUES('3','Croquants aux grisettes','4','chris','1','3','1','3');
INSERT INTO fichetechnique VALUES('4','Croquants citron','2','vicent','1','4','1','4');
INSERT INTO fichetechnique VALUES('5','sorbet magnum gérard','6','xavier','1','5','1','5');
INSERT INTO fichetechnique VALUES('6','magnum glace gérard','10','nicolas','1','1','1','6');
INSERT INTO fichetechnique VALUES('7','arranci boeuf','4','françois','1','1','1','7');
INSERT INTO fichetechnique VALUES('8','arranci pesto','5','flavie','1','2','1','8');
INSERT INTO fichetechnique VALUES('9','coeur choco framboise leetche','3','lysiane','1','3','1','9');
INSERT INTO fichetechnique VALUES('10','Malakoff','1','jessica','1','4','1','10');
INSERT INTO fichetechnique VALUES('11','Cake choco','20','Alex','1','1','1','1');
INSERT INTO fichetechnique VALUES('12','Pate à cookies à crue Fleur sel','2','jean-jack','1','1','1','1');
INSERT INTO fichetechnique VALUES('13','Chutney aux fruits secs','4','lucie','1','2','1','2');
INSERT INTO fichetechnique VALUES('14','confiture orange badiane','4','Edgard','1','3','1','3');
INSERT INTO fichetechnique VALUES('15','Pate à tartiner banane passion','2','Noémie','1','4','1','1');

INSERT INTO ingredient VALUES('1','Farine','0.5','200','1',null,'1','7');
INSERT INTO ingredient VALUES('2','Sucre','2','158','2',null,'2','7');
INSERT INTO ingredient VALUES('3',"Huile d'olive",'5','321','1',null,'1','8');
INSERT INTO ingredient VALUES('4','Lait','0.77','69','6',null,'3','3');
INSERT INTO ingredient VALUES('5','Oeuf','0.9','87','2',null,'1','3');
INSERT INTO ingredient VALUES('6','Bière','1.5','100','5',null,'1','9');
INSERT INTO ingredient VALUES('7','Glucose','3.58','850','2',null,'1','11');
INSERT INTO ingredient VALUES('8','Purée de banane','0.5','200','2',null,'1','5');
INSERT INTO ingredient VALUES('9','Purée passion','5','2','2',null,'1','7');
INSERT INTO ingredient VALUES('10','Beurre','0.7','0','2',null,'1','3');
INSERT INTO ingredient VALUES('11','Rhum','0.21','50','5',null,'1','9');
INSERT INTO ingredient VALUES('12','Genduja','5.1','58','7',null,'1','7');
INSERT INTO ingredient VALUES('13','Trimoline','2','28','7',null,'1','7');
INSERT INTO ingredient VALUES('14','Chocolat noire','6','578','2',null,'1','10');
INSERT INTO ingredient VALUES('15','Fond de tarte','0.5','20','2',null,'1','7');

INSERT INTO etape VALUES('1',"Dans un cul de poule verser la farine et former un puits");
INSERT INTO etape VALUES('2',"verser le lait en plusieurs fois dans ce puits");
INSERT INTO etape VALUES('3',"Mélanger en faisant tomber la farine petit à petit dans le lait afin de l'incorporer sans créer de grumeaux");
INSERT INTO etape VALUES('4',"Ajouter la bière et mélanger de nouveau");
INSERT INTO etape VALUES('5',"Battre les œufs puis les incorporer à la pâte avec l'huile");
INSERT INTO etape VALUES('6',"Verser enfin le sucre et mélanger bien");
INSERT INTO etape VALUES('7',"Laisser la pâte reposer 1 heure minimum (plus elle reposera mieux ça sera)");
INSERT INTO etape VALUES('8',"Après ce temps de repos, mélanger un peu de nouveau et faire cuire vos crêpes dans une poêle à crêpes huilée");

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
INSERT INTO Categorie_Ingredient VALUES('7','Autre');
INSERT INTO Categorie_Ingredient VALUES('8','Olive');
INSERT INTO Categorie_Ingredient VALUES('9','Alccol');
INSERT INTO Categorie_Ingredient VALUES('10','Chocolat');
INSERT INTO Categorie_Ingredient VALUES('11','sucre');


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