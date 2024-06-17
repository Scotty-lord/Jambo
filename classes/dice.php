<?php
class Dice
{
    private $face_value; // Un nombre de 1 à 6
    private $num_sides; // nombre de face?
    public $score; // suivie de score

    // Les dés commenceront toujours à 6
    // La fonction constructeur est appelée CHAQUE FOIS que vous créez un nouvel objet
    function __construct($n = 6)
    {
        $this->face_value = $n;
        $this->num_sides = $n;

        // Vérifiez si la valeur de $n est comprise entre 1 et 6
        if ($n < 1 || $n > 6) {
            $error_message = "Le nombre de faces doit être compris entre 1 et 6.";
            echo "<script>showError('" . $error_message . "')</script>";
        }
    }

    function setSides($num_sides)
    {
        $num_sides = intval($num_sides);

        // Vérifiez si la valeur de $num_sides est comprise entre 1 et 6
        if ($num_sides < 1 || $num_sides > 6) {
            $error_message = "Le nombre de faces doit être compris entre 1 et 6.";
            echo "<script>showError('" . $error_message . "')</script>";
        } else {
            $this->num_sides = $num_sides;
        }
    }

    function getSides()
    {
        return $this->num_sides;
    }
    // Fonction pour lancer les dés
    function roll()
    {
        $this->face_value = rand(1, $this->num_sides); // Définir la valeur nominale sur un nombre aléatoire
    }

    // Renvoie la valeur nominale (c'est-à-dire le nombre face vers le haut)
    function get_face_value()
    {
        return $this->face_value;
    }
}

// Le nombre de faces par défaut est de 6 pour chaque dé lancé
?>

<!DOCTYPE html>
<html>
<head>
  <title>Jeu de dés</title>
  <!-- Ajoutez le fichier CSS de Bootstrap pour le style de la boîte de dialogue modale -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Ajoutez le fichier JS de jQuery pour la fonctionnalité de la boîte de dialogue modale -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <!-- Ajoutez le fichier JS de Bootstrap pour la fonctionnalité de la boîte de dialogue modale -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    // Fonction pour afficher la boîte de dialogue modale avec le message d'erreur
    function showError(message) {
      // Sélectionnez la boîte de dialogue modale et le corps du message
      var modal = $('#errorModal');
      var modalBody = $('#errorModal .modal-body');

      // Définissez le corps du message sur le message d'erreur
      modalBody.text(message);

      // Affichez la boîte de dialogue modale
      modal.modal('show');
    }
  </script>
</head>
<body>
  <!-- Ajoutez la boîte de dialogue modale pour le message d'erreur -->
  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Erreur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Le corps du message sera défini par la fonction showError() -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Votre contenu HTML ici -->

</body>
</html>
