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
-- prof: 4Sy3xZ: aGlLiB

									{# {class="name">{{app.user.utilisateur.nom}}
										{{app.user.utilisateur.prenom}}  #}

									{# class="job">
									{{app.user.utilisateur.email}} #}

								{{app.user.utilisateur.email}}

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











			<div class="register_contenent"> <div class="div_register">
				<form class="row g-3" method="post">
					<div class="col-md-6">
						<i class="fa-solid fa-address-book fa-lg me-3 fa-fw"></i>
						<label for="{{registrationForm.nom.vars.id}}">Nom</label>
						<input type="text" class="form-control" id="{{registrationForm.nom.vars.id}}" name="{{registrationForm.nom.vars.full_name}}"/>
					</div>
					<div class="col-md-6">
						<i class="fa-solid fa-address-book fa-lg me-3 fa-fw"></i>
						<label for="{{registrationForm.prenom.vars.id}}">Prenom</label>
						<input type="text" class="form-control" id="{{registrationForm.prenom.vars.id}}" name="{{registrationForm.prenom.vars.full_name}}"/>
					</div>
					<div class="col-md-6">
						<i class="fa-solid fa-square-phone-flip fa-lg me-3 fa-fw"></i>
						<label class="form-label" for="{{registrationForm.telephone.vars.id}}">Numero de Telephone</label>
						<input type="text" class="form-control" id="{{registrationForm.telephone.vars.id}}" name="{{registrationForm.telephone.vars.full_name}}"/>
					</div>
					<div class="col-md-6">
						<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
						<label class="form-label" for="{{registrationForm.email.vars.id}}">
							Email</label>
						<input type="email" id="{{registrationForm.email.vars.id}}" class="form-control" name="{{registrationForm.email.vars.full_name}}"/>
					</div>
					<div class="col-12">
						<i class="fa-solid fa-house-laptop fa-lg me-3 fa-fw"></i>
						<label class="form-label" for="{{registrationForm.adresse.vars.id}}">Adresse</label>
						<input type="text" id="{{registrationForm.adresse.vars.id}}" class="form-control" name="{{registrationForm.adresse.vars.full_name}}"/>
					</div>

					<div class="col-md-6">
						<label for="inputCity" class="form-label">Code Postal</label>
						<input type="text" class="form-control" id="inputCity">
					</div>


					<div class="col-md-4">
						<label for="inputState" class="form-label"></label>

						{{form_row(registrationForm.typeutilisateur)}}


					</div>
					<div class="col-12">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck">
							<label class="form-check-label" for="gridCheck">
								Check me out
							</label>
						</div>
					</div>
					<div class="col-12" style="margin-right:auto; margin-left:auto; width: 100px;">
						<button type="submit" class="btn btn-primary">Sign in</button>
					</div>
				</form>
			</div>
		</div>

