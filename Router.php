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
						//$frontController->home();
							$frontController->addContact($_POST);

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
					elseif($get === 'article')					{

		              	$frontController = new FrontendController;
						$frontController->getSingleArticle($_GET['id']);

					}
					elseif($get === 'admin')
					{

						$backController = new BackendController; // from frontendController checkUser() method
						$backController->admin();

					}
					elseif ($get === 'addComment')
					{

					            $frontController = new FrontendController;
								$frontController->publishComments($_GET['id'], $_POST);

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
					/*elseif($get === 'contactForm')
					{

						$frontController = new FrontendController;							
						$frontController->addContact($_POST);
						
					} */
					elseif($get === 'connexion') // go to admin login.php form page
					{
						$frontController = new FrontendController;							
						$frontController->logAdmin();
					
					}
					elseif($get === 'deconnexion') // go to admin login.php form page
					{
						$frontController = new FrontendController;							
						$frontController->logOff();
					
					}
					elseif($get === 'pageAdmin') // from login.php check admin data to login
					{
						$frontController = new FrontendController;							
						$frontController->checkUser();
					
					}

					elseif($get === 'register')// to the register form page
					{
						$frontController = new FrontendController;							
						$frontController->register();
					
					}
					elseif($get === 'registerForm')// register user's data into the database
					{
						$frontController = new FrontendController;							
						$frontController->addUser($_POST);
					
					}
					elseif($get === 'verifEmail')// check user email via token
					{
						$frontController = new FrontendController;							
						$frontController->verifyToken();
						
					}
/*********************************************************************************/				
/********************************* PARTIE BACKEND ********************************/	
/*********************************************************************************/			
					elseif($get === 'createArticle')
					{  
						$backController = new BackendController;
						$backController->createArticle();

					}
					elseif($get === 'addArticle')
					{  
						$backController = new BackendController;
						$backController->addArticle();

					}
					elseif($get === 'editArticle')
					{  
						$backController = new BackendController;
						$backController->editArticle($id);

					}
					elseif($get === 'editListArticles')
					{  
						$backController = new BackendController;
						$backController->editListArticles();

					}
                    elseif($get === 'deleteArticle')
                    {
                        $backController = new BackendController;
                        $backController->deleteArticle($_GET['id']);

                    }
                    elseif($get === 'article_back')
                    {
                        $backController = new BackendController;
                        $backController->editArticle($_GET['id']);

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
	