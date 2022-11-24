<?php 
namespace App\Actions;

use App\Actions\Action;
use App\Models\MessageModel;


class SignUpFormAction extends Action {

	/**
	 * Dirige l'utilisateur vers le formulaire d'inscription.
	 *
	 * @see Action::run()
	 */	
	public function run() {
		$this->setModel(new MessageModel());
		$this->getModel()->setLogin($this->getSessionLogin());
		$this->setView(getViewByName("SignUpForm"));
	}

}

?>
