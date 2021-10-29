<?php
function defineStrings() {
	switch($_SESSION['lang']) {
		case "ru":
            define("WELCOME_TXT","Добро пожаловать!");
            define("CHOOSE_TXT","Выберите язык");
		break;

		case "ja":
			define("WELCOME_TXT","ようこそ！");
			define("CHOOSE_TXT","言語を選択");
		break;

		default:
            define("WELCOME_TXT","Добро пожаловать!");
            define("CHOOSE_TXT","Выберите язык");
		break;
	}
}
?>