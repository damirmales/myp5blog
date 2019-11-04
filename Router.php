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

			              	$frontController = new FrontendController;
							$frontController->singleArticle($_GET['id']);

						}
						elseif ($get === 'addComment')
						{
							
							//verifier si le numéro d'article est renseigné
							if (isset($_GET['id']) && $_GET['id'] > 0)
							{
								//verifier si les champs du formulaire de commentaire sont renseignés
								if (!empty($_POST['nom']) && !empty($_POST['comment']) && !empty($_POST['email']))
								{
									
									$frontController = new FrontendController;					

									$frontController->publishComments($_GET['id'], $_POST['nom'], $_POST['email'],$_POST['comment']);


								}
								else
								{
									echo 'Erreur : tous les champs ne sont pas remplis !';
									header('Location: index.php?route=article&id=' . $id);
									exit();
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
						elseif($get === 'admin') // go to admin login form page
						{
							$BackendController = new BackendController;							
							$BackendController->logAdmin();
						
						}
						elseif($get === 'pageAdmin') // check admin data to login
						{
							$BackendController = new BackendController;							
							$BackendController->checkAdmin();
						
						}
						elseif($get === 'register')
						{
							$BackendController = new BackendController;							
							$BackendController->register($_POST);
						
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

