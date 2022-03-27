<?php
require("./La%20P'tite%20Mine%20de%20Sab.html");
    $retour = mail("s.mouginot@yahoo.fr","Nom", $_POST['message'], "From: E-mail");
    if ($retour)
        echo '<p>Votre message a bien été envoyé.</p>';

?>