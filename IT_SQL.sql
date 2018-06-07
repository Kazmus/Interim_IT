#------------------------------------------------------------
#        Script SQL.
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Candidats
#------------------------------------------------------------

CREATE TABLE Candidats(
        ID_Info           Int NOT NULL AUTO_INCREMENT,
        Nom               Varchar (50) NOT NULL ,
        Prenom            Varchar (50) NOT NULL ,
        Genre             Varchar (25) NOT NULL ,
        Date_de_Naissance Date NOT NULL ,
        Adresse           Varchar (100) NOT NULL ,
        Numero_Adresse    Int NOT NULL ,
        Code_Postal       Int NOT NULL ,
        Ville             Varchar (50) NOT NULL ,
        Pays              Varchar (50) NOT NULL ,
        Tel               Varchar (25) ,
        Gsm               Varchar (25) ,
        E_Mail            Varchar (50) NOT NULL,
        SiteWeb           Varchar (100)
	,CONSTRAINT Candidats_PK PRIMARY KEY (ID_Info)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Competences
#------------------------------------------------------------

CREATE TABLE Competences(
        ID_Comp            Int NOT NULL AUTO_INCREMENT,
        Diplome            Varchar (50) ,
        Certification      Varchar (50) ,
        Annee_d_experience Int ,
        Permis             Varchar (25) NOT NULL ,
        Langue_Primaire    Varchar (50) NOT NULL ,
        Langue_Secondaire  Varchar (50) 
	,CONSTRAINT Competences_PK PRIMARY KEY (ID_Comp)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Disponibiliter
#------------------------------------------------------------

CREATE TABLE Disponibilite(
        ID_Dispo   Int NOT NULL AUTO_INCREMENT,
        Calendrier Date NOT NULL
	,CONSTRAINT Disponibilite_PK PRIMARY KEY (ID_Dispo)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Clients
#------------------------------------------------------------

CREATE TABLE Clients(
        ID_Client       Int NOT NULL AUTO_INCREMENT,
        Nom             Varchar (25) NOT NULL ,
        Prenom          Varchar (25) ,
        Type            Varchar (25) NOT NULL ,
        Adresse         Varchar (100) NOT NULL ,
        Numero_Adresse  Int NOT NULL ,
        Code_Postal     Int NOT NULL ,
        Ville           Varchar (50) NOT NULL ,
        Pays            Varchar (50) NOT NULL ,
        Tel             Varchar (25) ,
        Gsm             Varchar (25) NOT NULL ,
        E_Mail          Varchar (50) NOT NULL ,
        SiteWeb         Varchar (50) 
	,CONSTRAINT Clients_PK PRIMARY KEY (ID_Client)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Missions
#------------------------------------------------------------

CREATE TABLE Missions(
        ID_Mission      Int NOT NULL AUTO_INCREMENT,
        Type            Varchar (25) NOT NULL ,
        Lieu            Varchar (50) NOT NULL ,
        Date_Debut      Date NOT NULL ,
        Date_Fin        Date ,
        Effectif_Requis Int NOT NULL ,
        Description     Varchar (500) NOT NULL ,
        Remuneration    Float ,
        ID_Client       Int NOT NULL
	,CONSTRAINT Missions_PK PRIMARY KEY (ID_Mission)
	,CONSTRAINT Missions_Clients_FK FOREIGN KEY (ID_Client) REFERENCES Clients(ID_Client)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Selectionner
#------------------------------------------------------------

CREATE TABLE Selectionner(
        ID_Dispo Int NOT NULL ,
        ID_Info  Int NOT NULL
	,CONSTRAINT Selectionner_PK PRIMARY KEY (ID_Dispo,ID_Info)
	,CONSTRAINT Selectionner_Disponibilite_FK FOREIGN KEY (ID_Dispo) REFERENCES Disponibilite(ID_Dispo)
	,CONSTRAINT Selectionner_Candidats0_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Avoir
#------------------------------------------------------------

CREATE TABLE Avoir(
        ID_Comp Int NOT NULL ,
        ID_Info Int NOT NULL
	,CONSTRAINT Avoir_PK PRIMARY KEY (ID_Comp,ID_Info)
	,CONSTRAINT Avoir_Competences_FK FOREIGN KEY (ID_Comp) REFERENCES Competences(ID_Comp)
	,CONSTRAINT Avoir_Candidats0_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Postuler
#------------------------------------------------------------

CREATE TABLE Postuler(
        ID_Mission Int NOT NULL ,
        ID_Info    Int NOT NULL
	,CONSTRAINT Postuler_PK PRIMARY KEY (ID_Mission,ID_Info)
	,CONSTRAINT Postuler_Missions_FK FOREIGN KEY (ID_Mission) REFERENCES Missions(ID_Mission)
	,CONSTRAINT Postuler_Candidats0_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Exiger
#------------------------------------------------------------

CREATE TABLE Exiger(
        ID_Mission Int NOT NULL ,
        ID_Comp    Int NOT NULL
	,CONSTRAINT Exiger_PK PRIMARY KEY (ID_Mission,ID_Comp)
	,CONSTRAINT Exiger_Missions_FK FOREIGN KEY (ID_Mission) REFERENCES Missions(ID_Mission)
	,CONSTRAINT Exiger_Competences0_FK FOREIGN KEY (ID_Comp) REFERENCES Competences(ID_Comp)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Engager
#------------------------------------------------------------

CREATE TABLE Engager(
        ID_Mission           Int NOT NULL ,
        ID_Info              Int NOT NULL ,
        Evalutation_Candidat Float NOT NULL ,
        Evaluation_Client    Float NOT NULL
	,CONSTRAINT Engager_PK PRIMARY KEY (ID_Mission,ID_Info)
	,CONSTRAINT Engager_Missions_FK FOREIGN KEY (ID_Mission) REFERENCES Missions(ID_Mission)
	,CONSTRAINT Engager_Candidats0_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
)ENGINE=InnoDB;

