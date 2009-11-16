<html>
	<body>		
		<div> 
		<?php
		require('FactureGaecPDF.php');
		GenererUneFacture();
		?>
		Une fausse facture a été crée dans ./tmp/facture.pdf
		</div>
	</body>
</html>