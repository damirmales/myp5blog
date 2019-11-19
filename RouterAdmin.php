	<?php
	use Controller\BackendController;

	class RouterAdmin
	{
		public $get;

		public function run()
		{  			

			try
			{
				if(isset($_GET['route']))
				{ 
					$getAction = $_GET['route'];	

					$get = filter_var($getAction, FILTER_SANITIZE_SPECIAL_CHARS);

					if($get === 'createArticle')
					{  
						$backController = new BackendController;
						$backController->createArticle();

					}
					if($get === 'addArticle')
					{  
						$backController = new BackendController;
						$backController->addArticle($_POST);

					}
					if($get === 'editArticle')
					{  
						$backController = new BackendController;
						$backController->editArticle($id);

					}
					if($get === 'editListArticles')
					{  
						$backController = new BackendController;
						$backController->editListArticles();

					}
					
				}
				else
				{
					$backController = new BackendController;
					$backController->admin();
				}				

			}
			catch (Exception $e)
			{
				echo 'Erreur niveau RouterAdmin :'. $e->getMessage();
			}

		}
	}	
	