<?php  $login = $model->getLogin() ?>
<div class="survey">
<?= $login; ?>
<div class="question">
<?php  echo $survey->getQuestion() ?>
</div>

<?php  foreach ($survey->getResponses() as $response) { 
/* TODO  */ 
     
} 
?>

</div>

