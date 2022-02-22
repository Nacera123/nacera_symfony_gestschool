-- requetes sql pour remplir la base de donnée:

INSERT INTO type_utilisateur(id,role,description)
VALUES(NULL, 'Famille',"Modification de son propre compte. Compte gérer  par les parents  ( père ou mère). Consultation des résultats des enfants. Prise de contact avec le professeur et l’administration."),
      (NULL, 'Enseignant', "Modification de son propre profil. voir la liste de ces étudiants. Ajouter les notes des controles. contacter les parents"),
      (NULL, "Gestionnaire d’Ecole", "Ajout d’une nouvelle classe. Ajout  d’un nouvel enseignant. Association enseignant/classe. Ajout d’un nouvel étudiant. Association Etudiant et Classe"),
      (NULL, 'Administrateur', "Crée les gestionnaires d'école. Désactive les utilisateurs quelque soit le profi. Active les comptes ( Gestionnaire, famille et enseignant)")



-- a : xURcXB : qoreKg
-- b : k1SH0e : RIDVlt
-- c : P8Tpce : KD1m83
-- d :3W9QkO :G16uIM


		{# <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
								<label for="inputIdentifiant">Identifiant</label>
								<input type="text" value="{{ last_username }}" name="identifiant" id="inputIdentifiant" class="form-control" autocomplete="username" required autofocus>
								<label for="inputPassword">Password</label>
								<input type="password" name="password" id="inputPassword" class="form-control" autocomplete="current-password" required>
						
								<input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}">
						
						
								<div class="checkbox mb-3">
									<label>
										<input type="checkbox" name="_remember_me">
										Remember me
									</label>
								</div>
						
						
								<button class="btn btn-lg btn-primary" type="submit">
									Sign in
								</button> #}

