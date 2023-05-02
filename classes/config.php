<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding, Authorization, X-Requested-With");
header("Content-type: application/json; charset=UTF-8");
use DatabaseConfig;
use DatabaseConnection;
use Dotenv\Dotenv;

require "ConfigAbstract.php";
class Config
{
    protected $localhost;
    protected $username;
    protected $dbName;
    protected $password;
    public $connectdb = "";
    public $res = [];
    public function __construct()
    {
        // Load environment variables from .env file
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        
        $this->localhost = $_ENV['HOST'];
        $this->username = $_ENV['USERNAME'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->password = $_ENV['PASSWORD'];
        $config = new DatabaseConfig($this->localhost, $this->username,$this->password, $this->dbName);
        $connectionObject = new DatabaseConnection($config);
        $this->connectdb = $connectionObject->getConnection();

            $table_name = "Products";

            $query = "CREATE TABLE IF NOT EXISTS $table_name (
            ProductID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            sku VARCHAR(255) NOT NULL UNIQUE,
            name VARCHAR(255) NOT NULL,
            price INT(10) NOT NULL,
            productType varchar(255) NOT NULL,
            size int(20),
            weight int(20),
            height int(20),
            width int(20),
            length int(20)
        )";

            $statement = $this->connectdb->query($query);

            if (!$statement) {
                echo "Error creating table: " . $this->connectdb->error;
            }
        
    }

    public function create($query,$binder){
        $statement = $this ->connectdb->prepare($query);
         $statement->bind_param(...$binder);
        if($statement->execute()){
          $this->res['success']= true;
          $this->res['message'] = "Product created successfully";
        }
        else{
          $this ->res['success'] = false;
          $this->res['message'] = "Product can not be created successfully";
      }
       return $this->res;
      }
    public function read($query, $binder)
    {
        $statement = $this->connectdb->prepare($query);
        if ($binder) {
            $statement->bind_param(...$binder);
        }
        $getResult = $statement->execute();
        if ($getResult) {
            $fetch = $statement->get_result();
            $this->res['success'] = true;
            $this->res['result'] = mysqli_fetch_all($fetch, MYSQLI_ASSOC);

        } else {
            $this->res['success'] = false;
        }
        return $this->res;
    }

    public function delete($query, $binder)
    {
        $statement = $this->connectdb->prepare($query);
        if ($binder) {
            $statement->bind_param(...$binder);
        }
        $deleted = $statement->execute();
        if ($deleted === false) {
            $this->res['success'] = false;
            $this->res['message'] = "An error occurred: " . $statement->error;
        } else {
            $this->res['success'] = ($statement->affected_rows > 0);
            if ($this->res['success']) {
                $this->res['message'] = "Product deleted successfully";
            } else {
                $this->res['message'] = "Product not found";
            }
        }
        return $this->res;
    }

}
