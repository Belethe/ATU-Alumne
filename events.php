<?php
require_once('util.php');
head('Arrangementer');
echo"<h1>Arrangementer</h1>";

if(isset($_GET['error'])){
	echo '<span style="color:red;">';
        switch($_GET['error']){

                case 1:
                        echo 'Arrangementet '.$_GET['title'].' er oprettet.';
                        break;

                default:
                        echo 'Ukendt fejl';
                        break;
        }
        echo '</span><br /><br />';

}
?>
<a href="newEvent.php">Opret nyt arrangement?</a>
<?php
foot();
?>
