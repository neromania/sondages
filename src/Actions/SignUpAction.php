<?php 
namespace App\Actions;

use App\Actions\Action;
use App\Models\MessageModel;



class SignUpAction extends Action {

	/**
	 * Traite les données envoyées par le formulaire d'inscription
	 * ($_POST['signUpLogin'], $_POST['signUpPassword'], $_POST['signUpPassword2']).
	 *
	 * Le compte est crée à l'aide de la méthode 'addUser' de la classe Database.
	 *
	 * Si la fonction 'addUser' retourne une erreur ou si le mot de passe et sa confirmation
	 * sont différents, on envoie l'utilisateur vers la vue 'SignUpForm' avec une instance
	 * de la classe 'MessageModel' contenant le message retourné par 'addUser' ou la chaîne
	 * "Le mot de passe et sa confirmation sont différents.";
	 *
	 * Si l'inscription est validée, le visiteur est envoyé vers la vue 'MessageView' avec
	 * un message confirmant son inscription.
	 *
	 * @see Action::run()
	 */
	public function run() {
		$nickname = $_POST['signUpLogin']; 
		$password = $_POST['signUpPassword']; 
		$password2 = $_POST['signUpPassword2'];
		if ($password === $password2) {
			$response = $this->database->addUser($nickname, $password);
			if ($response === true) {
			$this->setModel(new MessageModel());
			$this->getModel()->setMessage("Inscription réussie");
			$this->setView(getViewByName("Default"));
			} else {
				$this->setModel(new MessageModel());
				$this->getModel()->setMessage($response);
				$this->setView(getViewByName("SignUpForm"));
			}
		} else {
			$this->setModel(new MessageModel());
			$this->getModel()->setMessage("Le mot de passe et sa confirmation sont différents.");
			$this->setView(getViewByName("SignUpForm"));
		}
		$this->setView(getViewByName("Message"));
		$this->setView(getViewByName("SignUpForm"));


		
	}



}


?>
