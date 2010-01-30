<?php

$outputAff = "%A %d %B %Y %T";
$daterecup = utf8_encode(strftime($outputAff, strtotime($ajax_daterecup_commande))) ;
echo "Merci pour votre commande : <br>";
echo "<ul>";
echo "<li>";
echo "  un mail vous a été envoyé à l'adresse : $mail ";
echo "</li>";
echo "<li>";
echo "  nous vous attendons à la ferme pour le  $daterecup";
echo "</li>";
echo "<li>";
echo "  en cas de doute n'hésitez pas à nous contacter ";
echo "</li>";
echo "</ul>";



?>