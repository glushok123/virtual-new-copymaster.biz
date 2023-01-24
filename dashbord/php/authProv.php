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
		$dbNew = getDbInstance();
		$db->where('id', $row['id_user']);
		$rowNew = $db->getOne('user_accaunt');

		if (password_verify($remember_token, $row['remember_token']))
        	{
				$expires = strtotime($rowNew['expires']);
				$_SESSION['user_logged_in'] = TRUE;
				$_SESSION['type_user'] = $rowNew['type_user'];
				$_SESSION['login'] = $rowNew['login'];
				$_SESSION['type'] = $rowNew['type'];
				$_SESSION['email'] = $rowNew['email'];

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


