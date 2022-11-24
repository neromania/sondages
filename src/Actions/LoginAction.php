<?php 
namespace App\Actions;

use App\Models\Model;
use App\Actions\Action;



class LoginAction extends Action {

	/**
	 * Traite les données envoyées par le visiteur via le formulaire de connexion
	 * (variables $_POST['nickname'] et $_POST['password']).
	 * Le mot de passe est vérifié en utilisant les méthodes de la classe Database.
	 * Si le mot de passe n'est pas correct, on affecte la chaîne "erreur"
	 * à la variable $loginError du modèle. Si la vérification est réussie,
	 * le pseudo est affecté à la variable de session et au modèle.
	 *
	 * @see Action::run()
	 */
	public function run() {
			if($this->database->checkPassword($_POST['nickname'], $_POST['password'])){
				$this->setModel(new Model());
				$this->getModel()->setLogin($_POST['nickname']);
				$this->setSessionLogin($_POST['nickname']);
				$this->setView(getViewByName("Default"));
			} else {
				$loginError = "erreur";
				$this->setModel(new Model());
				$this->getModel()->setLoginError($loginError);
				$this->setView(getViewByName("Default"));
			}
	
	}
}

?>
