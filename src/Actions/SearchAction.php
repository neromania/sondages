<?php 
namespace App\Actions;

use App\Actions\Action;
use App\Models\MessageModel;
use App\Models\SurveysModel;


class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot-clé
	 * contenu dans la variable $_POST["keyword"]. Cette liste est stockée dans un modèle
	 * de type "SurveysModel". L'utilisateur est ensuite dirigé vers la vue "SurveysView"
	 * permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot-clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		if(!empty( $_POST["keyword"])){
			$k =  $_POST["keyword"];
			$this->setModel(new SurveysModel());
			
			//Recuperer un tab des sondages correspondants
			$surveys = $this->database->loadSurveysByKeyword($k);
			if($surveys!==null){
				$this->getModel()->setSurveys($surveys);
				$this->setView(getViewByName("Surveys"));
			}else {
				$this->setModel(new MessageModel());
				$this->getModel()->setMessage("Recherche introuvable.");
				$this->setView(getViewByName("Message"));
			}
		} else {
			# empty keyword
			$this->setModel(new MessageModel());
				$this->getModel()->setMessage("Vous devez entrer un mot-clé avant de lancer la recherche.");
				$this->setView(getViewByName("Message"));
		}
		
	}

}

?>
