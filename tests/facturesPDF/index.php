<html>
	<body>		
		<div> 
		<?php
		require('FactureGaecPDF.php');
		GenererUneFacture();
		?>
		Une fausse facture a �t� cr�e dans ./tmp/facture.pdf
		</div>
	</body>
</html>