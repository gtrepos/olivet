<html>
	<body>		
		<div> 
		<?php
		require('FactureGaecPDF.php');
		if (isset($_GET['idCommande'])) $idCommande = $_GET['idCommande'];
		GenererUneFacture($idCommande);
		?>
		</div>
	</body>
</html>