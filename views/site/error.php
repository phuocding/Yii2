<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div>
	<div class="site-error" style="font-size: 16px; text-align: center;">

	    <h1 style="margin: 0; padding: 0; font-size: 11em; 
	    transform: skewY(-5deg); transition: 0.4s ease-in-out all; 
	    &:hover { text-shadow: 20px 20px 0 fade(#afd33d, 10%);}
        text-shadow: 20px 20px 0 fade(#afd33d, 10%);"><?= Html::encode($this->title) ?></h1>
	
	    <div class="alert alert-danger">
	        <?= nl2br(Html::encode($message)) ?>
	    </div>

	</div>
	
	<div class="footer" style="display: flex; flex-wrap: wrap; align-items: center; width: 100%;">
    
    <p class="legal" style="text-align: center;
      flex: 3;
      color: fade(#ccc, 50%);"> The above error occurred while the Web server was processing your request.</p>
    <p class="legal" style="text-align: center;
      flex: 3;
      color: fade(#ccc, 50%);">Please contact us if you think this is a server error. Thank you.</p>
  	</div>
</div>