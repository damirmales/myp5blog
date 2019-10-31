		<?php
		use Controller\FrontendController;
		use Controller\BackendController;
       
		class Router
		{
			public $get;

			public function run()
			{  
				

				try{
					if(isset($_GET['route']))
					{ 
						$getAction = $_GET['route'];		
					
					
						$get = filter_var($getAction, FILTER_SANITIZE_SPECIAL_CHARS);
				
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
						elseif ($get === 'addComment')
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
						elseif($get == 'livres')
						{


							$frontController = new FrontendController;
							$frontController->getCategoryArticles($get);

						}
						elseif($get == 'fromages')
						{

							$frontController = new FrontendController;
							$frontController->getCategoryArticles($get);

						}
						elseif($get === 'contactForm')
						{

							$frontController = new FrontendController;							
							$frontController->addContact($_POST);
							
						}
						elseif($get === 'admin')
						{
							$BackendController = new BackendController;							
							$BackendController->admin();
						
						}
						else
						{
							echo 'page inconnue '.$get ;
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
					echo 'Erreur niveau Router :'. $e->getMessage();
				}
			}

		}

