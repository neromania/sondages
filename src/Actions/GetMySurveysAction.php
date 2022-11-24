<?php 
namespace App\Actions;

use App\Models\SurveysModel;
use App\Actions\Action;

class GetMySurveysAction extends Action {

	/**
	 * Construit la liste des sondages de l'utilisateur dans un modèle
	 * de type "SurveysModel" et le dirige vers la vue "SurveysView" 
	 * permettant d'afficher les sondages.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * @see Action::run()
	 */
	public function run() {
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.");
			return;
		} 

			$surveys = $this->database->loadSurveysByOwner($this->getSessionLogin());
			$this->setModel(new SurveysModel());
			$this->getModel()->setSurveys($surveys);
			$this->setView(getViewByName("Surveys"));
	}
}

?>
