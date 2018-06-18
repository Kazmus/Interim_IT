#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Candidats
#------------------------------------------------------------

CREATE TABLE Candidats(
        ID_Info           Int  Auto_increment  NOT NULL ,
        Nom               Varchar (50) NOT NULL ,
        Prenom            Varchar (50) NOT NULL ,
        Genre             Varchar (10) NOT NULL ,
        Date_de_Naissance Date NOT NULL ,
        Adresse           Varchar (100) NOT NULL ,
        Numero_Adresse    Int NOT NULL ,
        Code_Postal       Int NOT NULL ,
        Ville             Varchar (50) NOT NULL ,
        Pays              Varchar (50) NOT NULL ,
        Tel               Varchar (25) ,
        Gsm               Varchar (25) ,
        E_Mail            Varchar (50) NOT NULL ,
        SiteWeb           Varchar (100) ,
        Mot_de_Passe      Varchar (50) NOT NULL
        ,CONSTRAINT Candidats_PK PRIMARY KEY (ID_Info)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Competences
#------------------------------------------------------------

CREATE TABLE Competences(
        ID_Comp            Int  Auto_increment  NOT NULL ,
        Diplome            Varchar (50) ,
        Certification      Varchar (50) ,
        Annee_d_experience Int NOT NULL ,
        Permis             Varchar (10) NOT NULL ,
        Langue_Primaire    Varchar (25) NOT NULL ,
        Langue_Secondaire  Varchar (25) ,
        ID_Info            Int NOT NULL
        ,CONSTRAINT Competences_PK PRIMARY KEY (ID_Comp)
        ,CONSTRAINT Competences_Candidats_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
        ,CONSTRAINT Competences_Candidats_AK UNIQUE (ID_Info)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Clients
#------------------------------------------------------------

CREATE TABLE Clients(
        ID_Client      Int  Auto_increment  NOT NULL ,
        Nom            Varchar (25) NOT NULL ,
        Prenom         Varchar (25) ,
        Type           Varchar (15) NOT NULL ,
        Adresse        Varchar (100) NOT NULL ,
        Numero_Adresse Int NOT NULL ,
        Code_Postal    Int NOT NULL ,
        Ville          Varchar (50) NOT NULL ,
        Pays           Varchar (50) NOT NULL ,
        Tel            Varchar (25) ,
        Gsm            Varchar (25) ,
        E_Mail         Varchar (75) NOT NULL ,
        SiteWeb        Varchar (75) ,
        Mot_de_Passe   Varchar (75) NOT NULL
        ,CONSTRAINT Clients_PK PRIMARY KEY (ID_Client)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Missions
#------------------------------------------------------------

CREATE TABLE Missions(
        ID_Mission         Int  Auto_increment  NOT NULL ,
        Type_Mission       Varchar (10) NOT NULL ,
        Titre              Varchar (75) NOT NULL ,
        Lieu               Varchar (50) NOT NULL ,
        Date_Debut         Date NOT NULL ,
        Date_Fin           Date NOT NULL ,
        Effectif_Requis    Int NOT NULL ,
        Description        Varchar (500) NOT NULL ,
        Remuneration       Float NOT NULL ,
        Reservation_Max    Int NOT NULL ,
        Annee_d_experience Varchar (50) NOT NULL ,
        Permis             Varchar (10) NOT NULL ,
        Langue             Varchar (25) NOT NULL ,
        ID_Client          Int NOT NULL
        ,CONSTRAINT Missions_PK PRIMARY KEY (ID_Mission)
        ,CONSTRAINT Missions_Clients_FK FOREIGN KEY (ID_Client) REFERENCES Clients(ID_Client)
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
        ID_Client  Int NOT NULL ,
        ID_Info    Int NOT NULL ,
        ID_Mission Int NOT NULL
        ,CONSTRAINT Engager_PK PRIMARY KEY (ID_Client,ID_Info,ID_Mission)
        ,CONSTRAINT Engager_Clients_FK FOREIGN KEY (ID_Client) REFERENCES Clients(ID_Client)
        ,CONSTRAINT Engager_Candidats0_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
        ,CONSTRAINT Engager_Missions1_FK FOREIGN KEY (ID_Mission) REFERENCES Missions(ID_Mission)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Virer
#------------------------------------------------------------

CREATE TABLE Virer(
        ID_Info    Int NOT NULL ,
        ID_Client  Int NOT NULL ,
        ID_Mission Int NOT NULL
        ,CONSTRAINT Virer_PK PRIMARY KEY (ID_Info,ID_Client,ID_Mission)
        ,CONSTRAINT Virer_Candidats_FK FOREIGN KEY (ID_Info) REFERENCES Candidats(ID_Info)
        ,CONSTRAINT Virer_Clients0_FK FOREIGN KEY (ID_Client) REFERENCES Clients(ID_Client)
        ,CONSTRAINT Virer_Missions1_FK FOREIGN KEY (ID_Mission) REFERENCES Missions(ID_Mission)
)ENGINE=InnoDB;

