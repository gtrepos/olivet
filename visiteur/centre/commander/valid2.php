<?php
echo "<h3>Merci pour votre commande</h3>";
echo "<ul>";
echo "<li>";
echo "  un mail vous a été envoyé à l'adresse : $mail ";
echo "</li>";
echo "<li>";
echo "  vous pouvez télécharger le récapitulatif de votre commande <a href='../tmp/recap$idCommande.pdf' target='_blank'>ici</a>.";
echo "</li>";
if ($ajax_daterecup_commande!=null) {
$outputAff = "%A %d %B %Y";
$daterecup = utf8_encode(strftime($outputAff, strtotime($ajax_daterecup_commande))) ;
echo "<li>";
echo "  nous vous attendons à la ferme pour le  $daterecup";
echo "</li>";
}
echo "<li>";
echo "  en cas de doute n'hésitez pas à nous contacter ";
echo "</li>";
echo "</ul>";



?>