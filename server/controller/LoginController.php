<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Controller.php');
class LoginController extends Controller {
	public static function main() {
		parent::includes ();
		if (isset($_SESSION['id'])){
			if (static::personHasTests ()) {
				$target = PATH . "server/view/TestRunnerView.php";
			} else {
				$target = PATH . "server/view/MainView.php";
			}
		} else {
		
		$server = "localhost";
		$username = "root";
		$password = "";
		$database = "ProTest";
		
		$mysqli = new mysqli ( $server, $username, $password, $database );
		
		/* check connection */
		if ($mysqli->connect_errno) {
			echo "Connect failed:  " . $mysqli->connect_error;
			exit ();
		}
		
		/* Select queries return a resultset */
		if (static::hasPermission ( $_POST ["usr"], $_POST ["pwd"] ,$mysqli)) {
			if (static::personHasTests ()) {
				$target = PATH . "server/view/TestRunnerView.php";
			} else {
				$target = PATH . "server/view/MainView.php";
			}
		} else {
			$target = PATH . "server/view/LoginView.php";
		}}
		header ( "Location: $target" );
	}
	public static function hasPermission($user, $password, $mysqli) {
		$exitcode = false;
		if (empty ( $user ) || empty ( $password )) {
			$_SESSION ['loginError'] = "Password or Username was empty. Please provide in all information";
		} else {
			if ($result = $mysqli->query ( "SELECT id,name,discriminator FROM Person WHERE id='".$user."' AND pwd='".$password."';" )) {
				if ($result->num_rows == 0){
					$_SESSION ['loginError'] = "Username or Password wrong.";
				} else {
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['name'];
					if (strpos($row['discriminator'],"Student")!==false){
						$_SESSION['isStudent'] = true;
					}
					if (strpos($row['discriminator'],"Lecturer")!==false) {
						$_SESSION['isLecturer'] = true;
					}
					if (strpos($row['discriminator'],"Admin")!==false){
						$_SESSION['isAdmin'] = true;
					}

					$exitcode = true;
				}
				
				/* free result set */
				$result->close ();
			} 
		}
		return $exitcode;
	}
	public static function personHasTests() {
		return false;
	}
}
LoginController::main ();

?>
