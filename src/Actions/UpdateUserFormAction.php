<?php 
namespace App\Actions;

use App\Actions\Action;
use App\Models\MessageModel;


class UpdateUserFormAction extends Action {

	/**
	 * Dirige l'utilisateur vers le formulaire de modification de mot de passe.
	 *
	 * @see Action::run()
	 */
	public function run() {

		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.");
			return;
		}

		$this->setModel(new MessageModel());
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(getViewByName("UpdateUserForm"));
	}

}
?>
