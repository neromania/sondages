<?php 
namespace App\Views;

use App\Views\View;


class SignUpFormView extends View {
	
	/**
	 * Affiche le formulaire d'inscription.
	 * Le modèle passé en paramètre est une instance de la
	 * classe 'MessageModel'.
	 *
	 * @see View::displayBody()
	 */
	public function displayBody($model) {
		require("templates/signupform.inc.php");
	}

}
?>

