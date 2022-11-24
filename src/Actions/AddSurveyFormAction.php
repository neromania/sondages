<?php 
namespace App\Actions;

use App\Actions\Action;
use App\Models\MessageModel;
use App\Models\Survey;
use App\Models\SurveysModel;


class AddSurveyFormAction extends Action {
	/**
	 * Traite les données envoyées par le formulaire d'ajout de sondage.
	 *
	 * Si l'utilisateur n'est pas connecté, un message lui demandant de se connecter est affiché.
	 *
	 * Sinon, la fonction ajoute le sondage à la base de données. Elle transforme
	 * les réponses et la question à l'aide de la fonction PHP 'htmlentities' pour éviter
	 * que du code exécutable ne soit inséré dans la base de données et affiché par la suite.
	 *
	 * Un des messages suivants doivent être affichés à l'utilisateur :
	 * - "La question est obligatoire.";
	 * - "Il faut saisir au moins 2 réponses.";
	 * - "Merci, nous avons ajouté votre sondage.".
	 *
	 * Le visiteur est finalement envoyé vers le formulaire d'ajout de sondage pour lui
	 * permettre d'ajouter un nouveau sondage s'il le désire.
	 *
	 * @see Action::run()
	 */
	public function run() {
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.");
			return;
		}
				
		$cpt = 0;
		if(!empty($_POST["questionSurvey"])){	
			foreach ($_POST as $key => $v) {
				if (!empty($v) && $key !== "questionSurvey") {
					$cpt++; 
				}
			}
			if ($cpt >= 2) {
				$this->setModel(new MessageModel());
				$this->getModel()->setMessage("Merci, nous avons ajouté votre sondage.");
				$this->setModel(new SurveysModel());
				$this->getModel()->setSurveys(new Survey($this->getSessionLogin(), $_POST['questionSurvey']));
				//$this->database->saveSurvey($this->getSessionLogin(), $_POST['questionSurvey']);
				$this->setView(getViewByName("AddSurveyForm"));

			} else {
				$this->setModel(new MessageModel());
				$this->getModel()->setMessage("Il faut saisir au moins 2 réponses.");
				$this->setView(getViewByName("AddSurveyForm"));
			}


		} else {
			$this->setModel(new MessageModel());
			$this->getModel()->setMessage("La question est obligatoire.");
			$this->setView(getViewByName("AddSurveyForm"));
		}

		$this->setModel(new MessageModel());
		$this->getModel()->setMessage("");
		$this->setView(getViewByName("AddSurveyForm"));

	

	}

}

?>
