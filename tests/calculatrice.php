<html>
<head>
<title>Calculatrice</title>
<script type="text/javascript">
<!--
function verification(entree) {
  var seulement_ceci ="0123456789[]()-+*%/.";
  for (var i = 0; i < entree.length; i++)
   if (seulement_ceci.indexOf(entree.charAt(i))<0 ) return false;
  return true;
 }

 function resultat() {
   var x = 0;
  if (verification(window.document.calculatrice.affiche.value))
     x = eval(window.document.calculatrice.affiche.value);
   window.document.calculatrice.affiche.value = x;
 }

 function ajouter(caracteres) {
   window.document.calculatrice.affiche.value =
   window.document.calculatrice.affiche.value + caracteres;
 }

 function fonction_speciale(fonction) {
   if (verification(window.document.calculatrice.affiche.value)) {
     if(fonction == "sqrt") {
       var x = 0;
     x = eval(window.document.calculatrice.affiche.value);
     window.document.calculatrice.affiche.value = Math.sqrt(x);
   }
   if(fonction == "pow") {
     var x = 0;
     x = eval(window.document.calculatrice.affiche.value);
     window.document.calculatrice.affiche.value = x * x;
   }
   if(fonction == "log") {
     var x = 0;
     x = eval(window.document.calculatrice.affiche.value);
     window.document.calculatrice.affiche.value = Math.log(x);
   }
  } else window.document.calculatrice.affiche.value = 0
}
//-->
</script>
<style type="text/css">
<!--
.button {  width:60px; text-align:center;
           font-family:System,sans-serif;
           font-size:100%; }
.affiche { width:100%; text-align:right;
           font-family:System,sans-serif;
           font-size:100%; }
-->
</style>
</head>
<body bgcolor="#FFFFE0" text="#000000">

<form name="calculatrice" action="" onSubmit="resultat();return false;">
<table border="5" cellpadding="10" cellspacing="0">
<tr>
<td bgcolor="#C0C0C0">
<input type="text" name="affiche" align="right" class="affiche"></td>
</tr><tr>
<td  bgcolor="#E0E0E0">
<table border="0" cellpadding="0" cellspacing="2">
<tr>
<td><input type="button" width="60" class="button" value="  7   " onClick="ajouter('7')"></td>
<td><input type="button" width="60" class="button" value="  8   " onClick="ajouter('8')"></td>
<td><input type="button" width="60" class="button" value="  9   " onClick="ajouter('9')"></td>
<td><input type="button" width="60" class="button" value="  +   " onClick="ajouter('+')"></td>
</tr>
<tr>
<td><input type="button" width="60" class="button" value="  4   " onClick="ajouter('4')"></td>
<td><input type="button" width="60" class="button" value="  5   " onClick="ajouter('5')"></td>
<td><input type="button" width="60" class="button" value="  6   " onClick="ajouter('6')"></td>
<td><input type="button" width="60" class="button" value="  -   " onClick="ajouter('-')"></td>
</tr>
<tr>
<td><input type="button" width="60" class="button" value="  1   " onClick="ajouter('1')"></td>
<td><input type="button" width="60" class="button" value="  2   " onClick="ajouter('2')"></td>
<td><input type="button" width="60" class="button" value="  3   " onClick="ajouter('3')"></td>
<td><input type="button" width="60" class="button" value="  *   " onClick="ajouter('*')"></td>
</tr>
<tr>
<td><input type="button" width="60" class="button" value="  =   " onClick="resultat()"></td>
<td><input type="button" width="60" class="button" value="  0   " onClick="ajouter('0')"></td>
<td><input type="button" width="60" class="button" value="  .   " onClick="ajouter('.')"></td>
<td><input type="button" width="60" class="button" value="  /   " onClick="ajouter('/')"></td>
</tr>
<tr>
<td><input type="button" width="60" class="button" value="sqrt " onClick="fonction_speciale('sqrt')"></td>
<td><input type="button" width="60" class="button" value=" pow " onClick="fonction_speciale('pow')"></td>
<td><input type="button" width="60" class="button" value=" log " onClick="fonction_speciale('log')"></td>
<td><input type="reset"  width="60" class="button" value="  C  "></td>
</tr>
</table>
</td></tr></table>
</form>

</body>
</html>