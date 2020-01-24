switch($_GET['action'])
{ 
	case "about" :
		require_once("about.php"); // страница "О Нас"
		break;
	case "contacts" :
		require_once("contacts.php"); // страница "Контакты"
		break;
	case "feedback" :
		require_once("feedback.php"); // страница "Обратная связь"
		break;
	default : 
		require_once("page404.php"); // страница "404"
	break;
}