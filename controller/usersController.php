<?php
class UsersController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/user.php";
        
        $this->conectar = new Conectar();
        $this->Connection = $this->conectar->Connection();

    }

   /**
    * Ejecuta la acción correspondiente.
    *
    */
    public function run($accion){
        switch($accion)
        { 
            case "add" :
                $this->add();
                break;
            case "user" :
                $this->user();
                break;
            default:
                $this->index();
                break;
        }
    }
    
   /**
    * Loads the employees home page with the list of
    * employees getting from the model.
    *
    */ 
    public function index(){
        
        //We create the employee object
        $user = new User($this->Connection);
        
        //We get all the employees
        $user = $user->getAll();

        $handle = opendir(dirname(__DIR__).'/pictures/');
        $listOfImages = [];
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..'){
                array_push($listOfImages, $file);
            }
          }
       
        //We load the index view and pass values to it
        $this->view("index", array(
            "users" => $user,
            'images' => $listOfImages
        ));
    }
    
   /**
    * Create a new employee from the POST parameters
     * and reload the index.php.
    *
    */
    public function add(){
        $user = new User($this->Connection);
        if(isset($_POST["wallet_id"])){
            
            //Creamos un usuario
            $user->setWalletID($_POST["wallet_id"]);
            $user->setTransactionID($_POST["transaction"]);
            $user->setImgPath('test');
            $save=$user->save();
        }
        $user = new User($this->Connection);
        $user = $user->getAll();
        $this->view("index", array(
            "user" => $user
        ));
    }

    
    public function user (){
        $users = new User($this->Connection);
        $users = $users->getBy($_POST["walletID"]);
        $this->view("user", array(
            "users" => $users
        ));

    }
    
   /**
    * Create the view that we pass to it with the indicated data.
    *
    */
    public function view($vista,$datos){
        $data = $datos;  
        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }
}
?>
