<?php
 
class funciones_BD {
 
    private $db;

    public $usuario;
   
 
    // constructor

    function __construct() {
        require_once 'connectbd.php';
        // connecting to database

        $this->db = new DB_Connect();
        $this->db->connect();

    }
 
    // destructor
    function __destruct() {
 
    }
 
    /**
     * agregar nuevo usuario
     */
    public function adduser($username, $password) {

    $result = mysql_query("INSERT INTO usuarios(username,passw) VALUES('$username', '$password')");
        $sql = "CREATE TABLE $username (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                temp INT NOT NULL,
                htierra INT NOT NULL,
                haire INT NOT NULL,
                rocio INT NOT NULL,
                gradosbruj INT NOT NULL,
                acx INT NOT NULL,
                acy INT NOT NULL,
                acz INT NOT NULL,
                fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
if (mysql_query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
        // check for successful store

        if ($result) {

            return true;

        } else {

            return false;
        }

    }
 
 
     /**
     * Verificar si el usuario ya existe por el username
     */

    public function isuserexist($username) {

        $result = mysql_query("SELECT username from usuarios WHERE username = '$username'");

        $num_rows = mysql_num_rows($result); //numero de filas retornadas

        if ($num_rows > 0) {

            // el usuario existe 

            return true;
        } else {
            // no existe
            return false;
        }
    }
 
   
	public function login($user,$passw){
	$result=mysql_query("SELECT COUNT(*) FROM usuarios WHERE username='$user' AND passw='$passw' "); 
	$count = mysql_fetch_row($result);

	/*como el usuario debe ser unico cuenta el numero de ocurrencias con esos datos*/


		if ($count[0]==0){
            $usuario = '$user';

		return true;

		}else{

		return false;

		}
	}

    public function getUser(){
        return '$usuario';
    }

    public function insert_data($temp,$htierra,$haire,$rocio,$gradosbruj,$acx,$acy,$acz,$user){
        $query = mysql_query("INSERT INTO '$user'(temp,htierra,haire,rocio,gradosbruj,acx,acy,acz) VALUES($temp,$htierra,$haire,$rocio,$gradosbruj,$acx,$acy,$acz)");
        if ($query === TRUE) {
            return true;
        } else {
            return false;
        }
    } 
  
}
 
?>
