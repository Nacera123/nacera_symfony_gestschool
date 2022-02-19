-- requetes sql pour remplir la base de donnée:

INSERT INTO type_utilisateur(id,role,description)
VALUES(NULL, 'Famille',"Modification de son propre compte. Compte gérer  par les parents  ( père ou mère). Consultation des résultats des enfants. Prise de contact avec le professeur et l’administration."),
      (NULL, 'Enseignant', "Modification de son propre profil. voir la liste de ces étudiants. Ajouter les notes des controles. contacter les parents"),
      (NULL, "Gestionnaire d’Ecole", "Ajout d’une nouvelle classe. Ajout  d’un nouvel enseignant. Association enseignant/classe. Ajout d’un nouvel étudiant. Association Etudiant et Classe"),
      (NULL, 'Administrateur', "Crée les gestionnaires d'école. Désactive les utilisateurs quelque soit le profi. Active les comptes ( Gestionnaire, famille et enseignant)")



-- a : xURcXB : qoreKg
