
<?php 

if($_SERVER['SERVER_NAME'] == 'localhost'){

	define('ROOT', 'http://localhost/mvcagency');

	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'mvcagency');

}else{

	define('ROOT', 'https://www.skilldeve.com');
}
