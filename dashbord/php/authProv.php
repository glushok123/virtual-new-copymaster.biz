<?


if (isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])) {

	// Get user credentials from cookies.
	$series_id = filter_var($_COOKIE['series_id']);
	$remember_token = filter_var($_COOKIE['remember_token']);
	$db = getDbInstance();
	// Get user By series ID:
	$db->where('series_id', $series_id);
	$row = $db->getOne('user_accaunt_session');

	if ($db->count >= 1)
	{
		// User found. verify remember token
		if (password_verify($remember_token, $row['remember_token']))
        	{
				$expires = strtotime($row['expires']);
				$_SESSION['user_logged_in'] = TRUE;
				$_SESSION['type_user'] = $row['type_user'];
				$_SESSION['login'] = $row['login'];
				$_SESSION['type'] = $row['type'];
				$_SESSION['email'] = $row['email'];

			header('Location:index.php');
		}
		else
		{
			clearAuthCookie();
		}
	}
	else
	{
		clearAuthCookie();
	}

}


