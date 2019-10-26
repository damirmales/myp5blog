		<?php
		use Controller\FrontendController;

       
		class Router
		{
			public $get;

			public function run()
			{  
				

				try{
					if(isset($_GET['route']))
					{ 
						$get1 = $_GET['route'];			
					
						$get = filter_var($get1, FILTER_SANITIZE_SPECIAL_CHARS);
				

						if($get === 'contact')
						{  
							$frontController = new FrontendController;
							$frontController->home();

						}
						elseif($get === 'cv')
						{

							$frontController = new FrontendController;
							$frontController->cv();

						}
						elseif($get === 'liste')
						{

							$frontController = new FrontendController;
							$frontController->pullListeArticles();


						}
						elseif($get === 'article')
						{

			                  //  $idArt = $_GET['id'];
							$frontController = new FrontendController;
							$frontController->singleArticle($_GET['id']);

						}
						elseif ($_GET['route'] === 'addComment')
						{

							if (isset($_GET['id']) && $_GET['id'] > 0)
							{



								if (!empty($_POST['nom']) && !empty($_POST['comment']))
								{



									$frontController = new FrontendController;					

									$frontController->publishComments($_GET['id'], $_POST['nom'], $_POST['comment']);


								}
								else
								{
									echo 'Erreur : tous les champs ne sont pas remplis !';
								}
							}
							else
							{
								echo 'Erreur : aucun identifiant d\'article envoyé';
							}
						}
						elseif($_GET['route'] == 'livres')
						{


							$frontController = new FrontendController;
							$frontController->getCategoryArticles($_GET['route']);

						}
						elseif($_GET['route'] == 'fromages')
						{


							$frontController = new FrontendController;
							$frontController->getCategoryArticles($_GET['route']);



						}
						elseif($_GET['route'] === 'contactForm')
						{



							$frontController = new FrontendController;
							//$frontController->addContact($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['message']);

							$frontController->addContact($_POST);
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