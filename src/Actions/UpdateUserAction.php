<?php 
namespace App\Actions;

use App\Actions\Action;
use App\Models\MessageModel;



class UpdateUserAction extends Action {

	/**
	 * Met à jour le mot de passe de l'utilisateur en procédant de la façon suivante :
	 *
	 * Si toutes les données du formulaire de modification de profil ont été postées
	 * ($_POST['updatePassword'] et $_POST['updatePassword2']), on vérifie que
	 * le mot de passe et la confirmation sont identiques.
	 * S'ils le sont, on modifie le compte avec les méthodes de la classe 'Database'.
	 *
	 * Si une erreur se produit, le formulaire de modification de mot de passe
	 * est affiché à nouveau avec un message d'erreur.
	 *
	 * Si aucune erreur n'est détectée, le message 'Modification enregistrée.'
	 * est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		if(!empty($_POST['updatePassword']) && !empty($_POST['updatePassword2'])){
			if($_POST['updatePassword'] === $_POST['updatePassword2']){
				$this->database->updateUser($this->getSessionLogin(), $_POST['updatePassword2']);
				$message = "Modification enregistrée.";
				$this->createUpdateUserFormView($message);
			} else {
				$message = "Les mots de passes ne sont pas identiques";
				$this->createUpdateUserFormView($message);
			}
		} else {
			$message = "erreur !";
			$this->createUpdateUserFormView($message);
		}
	}

	private function createUpdateUserFormView($message) {
		$this->setModel(new MessageModel());
		$this->getModel()->setMessage($message);
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(getViewByName("UpdateUserForm"));
	}

}

?>
