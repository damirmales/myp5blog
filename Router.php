		<?php
		use Controller\FrontendController;



		class Router
		{


			public function run()
			{
				try{
					if(isset($_GET['route']))
					{
						if($_GET['route'] === 'liste'){

							$frontController = new FrontendController;
							$frontController->pullListeArticles();


						}
						elseif($_GET['route'] === 'article'){

			                  //  $idArt = $_GET['id'];
							$frontController = new FrontendController;
							$frontController->singleArticle($_GET['id']);

						}
						elseif ($_GET['route'] === 'addComment') {

							if (isset($_GET['id']) && $_GET['id'] > 0) {



								if (!empty($_POST['nom']) && !empty($_POST['comment'])) {

									var_dump($_POST['comment']);

									$frontController = new FrontendController;					

									$frontController->publishComments($_GET['id'], $_POST['nom'], $_POST['comment']);


								}
								else {
									echo 'Erreur : tous les champs ne sont pas remplis !';
								}
							}
							else {
								echo 'Erreur : aucun identifiant de billet envoyé';
							}
						}
						elseif($_GET['route'] == 'livres'){


							$frontController = new FrontendController;
							$frontController->getCategoryArticles($_GET['route']);

						}
						elseif($_GET['route'] == 'fromages'){


							$frontController = new FrontendController;
							$frontController->getCategoryArticles($_GET['route']);



						}
						elseif($_GET['route'] === 'contact'){

			        		$frontController = new FrontendController;
							$frontController->addContact($_GET['route']);
							
						}

						else
						{
							echo 'page inconnue '.$_GET['route'] ;
						}
					}
					else
					{
						$frontController = new FrontendController;
						$frontController->home();
					}
				}
				catch (Exception $e)
				{
					echo 'Erreur catch Router :'. $e->getMessage();
				}
			}
		}


		?>