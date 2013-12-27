<?

	function get_user_id() {

	// user has a cookie?
		$user_id = $_COOKIE["user_id"];

		if(!$user_id) {
			// if not, set a cookie
			$user_id = uniqid();
			setcookie("user_id", $user_id, time() +60*60*24*7*365);
		}
		

	// return ID
		return $user_id;

	}


	echo get_user_id();


?>