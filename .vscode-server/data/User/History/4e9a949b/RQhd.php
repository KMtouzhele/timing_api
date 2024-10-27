<?php
//enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("model/Model.php");  
include_once("view/ViewCustomerList.php");
include_once("view/ViewCustomerTable.php");
include_once("view/ViewBackToHome.php");
include_once("view/ViewSearchBox.php");
  
class Controller 
{  
     public $model;
     public const ACTION_VIEW_ALL = 1;
     public const ACTION_VIEW_ONE = 2;
     public const ACTION_VIEW_BY_NAME = 3;

     public function __construct()    
     {    
          $this->model = new Model();  
     }   
      
     public function execute($action, $search = NULL)  
     {
          $searchBox = new ViewSearchBox();
          $searchBox->output();
		// Used an if statement to check the action type
          if ($action == self::ACTION_VIEW_ALL)
          {
               // For viewing all, we just get the list of customers
                  $customers = $this->model->getCustomerList();  
          }
          else if ($action == self::ACTION_VIEW_ONE)
          {
               // For viewing one, we display a back button and we get the customer by ID
               $viewBack = new ViewBackToHome();
               $viewBack->output();
        
               if ($search == null)
               {
                 echo "No search term entered";
                 return;
               }
        
               $customers = $this->model->getCustomerByID($search);  
          }
          else if ($action == self::ACTION_VIEW_BY_NAME)
          {
               $viewBack = new ViewBackToHome();
               $viewBack->output();
               if ($search == null) {
                    echo "No search term entered";
                    return;
               }
               $customers = $this->model->getCustomerByName($search);
          }
        
          // For both action types, we can output the customers in a list or a table
          $view = new ViewCustomerTable();
          //or
          //$view = new ViewCustomerList();
        
          $view->output($customers);
     }  
}  

?>