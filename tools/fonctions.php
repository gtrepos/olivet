<?
// nombres de journees d un championnat
function nb_journees($id_champ)
{
    $query="SELECT phpl_journees.numero FROM phpl_journees
	        WHERE phpl_journees.id_champ='$id_champ' AND phpl_journees.date_prevue!=0";
	$result=mysql_query($query);
	$nb_journees=mysql_num_rows($result);
	return("$nb_journees");
}

// Nombres d equipes dans un championnat
function nb_equipes($id_champ)
{
	$query="SELECT id FROM phpl_equipes WHERE id_champ='$id_champ'";
	$result=mysql_query($query);
	$nb_equipes=mysql_num_rows($result);
	return("$nb_equipes");
}

function aff_journee($champ, $numero, $legende, $proba)
{
	// SELECTION DES PARAMETRES
	$result=(mysql_query("SELECT * FROM phpl_parametres WHERE id_champ='$champ' "));
	$id_equipe_fetiche=0;
	while ($row=mysql_fetch_array($result))
	{
		$id_equipe_fetiche=$row['id_equipe_fetiche'];
		$fiches_clubs=$row['fiches_clubs'];
	}
	
	// NOM de EQUIPE FAVORITE a partir de son id
	$result=(mysql_query("SELECT nom FROM phpl_clubs, phpl_equipes WHERE phpl_equipes.id='$id_equipe_fetiche' AND phpl_clubs.id=phpl_equipes.id_club"));
	$equipe_fetiche=0;
	while ($row=mysql_fetch_array($result))
		$equipe_fetiche=$row[0];

	// cellule d'affichage des derniers résultats
	$query1="SELECT cldom.nom as cldom, clext.nom as clext, phpl_matchs.buts_dom, phpl_matchs.buts_ext, phpl_journees.date_prevue, cldom.id as cliddom, clext.id as clidext, date_reelle
	        FROM phpl_equipes as dom, phpl_equipes as ext, phpl_matchs, phpl_journees, phpl_clubs as cldom, phpl_clubs as clext
	        WHERE phpl_matchs.id_equipe_dom=dom.id
	                AND phpl_matchs.id_equipe_ext=ext.id
	                AND phpl_journees.id_champ='$champ'
	                AND phpl_journees.numero='$numero'
	                AND dom.id_club=cldom.id
	                AND ext.id_club=clext.id
	                AND phpl_matchs.id_journee=phpl_journees.id AND cldom.nom!='exempte' AND clext.nom!='exempte' order by date_reelle asc";
	$result=mysql_query($query1);
	$x=1;
	while ($row=mysql_fetch_array($result))
	{
		$domproba= $row[2];
		$extproba= $row[3];
		if ($row['buts_dom']=='' and $row['buts_ext']=='' and $proba==1 and $numero>=4)
	    {
			$query2="SELECT * FROM phpl_clmnt WHERE NOM='$row[cldom]'";
			$result2=mysql_query($query2);
			while ($row2=mysql_fetch_array($result2))
			{
				$dom_buts=($row2['DOMBUTSPOUR']);
				$dom_joues=($row2['DOMG']+$row2['DOMN']+$row2['DOMP']);
				$ext_buts=($row2['DOMBUTSCONTRE']);
				$ext_joues=($row2['DOMG']+$row2['DOMN']+$row2['DOMP']);
			}

			$query2="SELECT * FROM phpl_clmnt WHERE NOM='$row[clext]'";
			$result2=mysql_query($query2);
			while ($row2=mysql_fetch_array($result2))
			{
				$dom_joues+=($row2['EXTG']+$row2['EXTN']+$row2['EXTP']);
				$ext_joues+=$row2['EXTG']+$row2['EXTN']+$row2['EXTP'];
				$dom_buts+=($row2['EXTBUTSCONTRE']);
				$ext_buts+=($row2['EXTBUTSPOUR']);
				$dom_buts=intval((($dom_buts)/$dom_joues));
				$ext_buts=intval((($ext_buts)/$ext_joues));
			}

			$domproba="<i><font size=1>".$dom_buts."</i>";
			$extproba="<i><font size=1>".$ext_buts."</i>";
		}

	    if ($x==1)
	    {
			echo "<TABLE style=\"MARGIN-TOP: 14px\" cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			   <TBODY><TR><TD class=deco><SPAN class=deco3>".$legende."</SPAN><SPAN class=deco4>".$numero;
			   if($numero==1){echo "ère";}else{echo "ème";}
			   echo " journée</SPAN></TD></TR></TBODY></TABLE>";
			$date = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})$','\\3/\\2/\\1', $row[4]);
			echo "<TABLE style=\"MARGIN-BOTTOM: 14px; TEXT-ALIGN: center\" cellSpacing=0 align=center
				cellPadding=0 width=100% background=\"img/fclassement.gif\" border=0>";

			echo "<TBODY>
				<TR bgColor=#D1D1C5>
			    <TH width=\"19%\" height=20>Date</TH>
				<TH width=\"29%\">&nbsp;</TH>
				<TH width=\"8%\" colSpan=2>Score</TH>
				<TH width=\"29%\">&nbsp;</TH>
			    <TH width=\"17%\">&nbsp;</TH></TR>";
		}

		if ($row[0]==$equipe_fetiche or $row[1]==$equipe_fetiche)
			echo "<TR class=bgjaune style=\"FONT-WEIGHT: bold\">";
		else
			echo "<TR>";
	    $date_reelle = $row[7];

		$minute = substr($date_reelle,14,2); // on récupère la minute
		$heure = substr($date_reelle,11,2); // on récupère l'heure
		$jour = substr($date_reelle,8,2); // on récupère le jour
		$mois = substr($date_reelle,5,2); // puis le mois
		$annee = substr($date_reelle,0,4); // et l'annee

		setlocale(LC_TIME, "fr_FR");
		$t= mktime($heure,$minute,0,$mois,$jour,$annee);
		echo "<TD>";
		echo strftime("%d/%m/%y %H:%M",$t);
		echo "</TD>";
		echo "<TD align=\"right\" height=20 style='padding-right:5px;'>".$row[0]."<TD align=center width=4%>".$domproba."</TD><TD align=center width=4%>".$extproba."<TD align=\"left\" style='padding-left:5px;'>".$row[1];

		if ($row[0]==$equipe_fetiche or $row[1]==$equipe_fetiche)
			echo "<TD><A class=noir href=\"index.php?page=buteur&champ=$champ&fin=$numero\">Statistiques</A></TD></TR>";
		else
			echo "<TD>&nbsp;</TD></TR>";
		$x++;
	}
             
/*  $requete="SELECT phpl_clubs.nom, CLEXT.nom, phpl_matchs.buts_dom, phpl_matchs.buts_ext, phpl_matchs.id, phpl_matchs.date_reelle FROM phpl_clubs, phpl_clubs as CLEXT, phpl_matchs, phpl_journees, phpl_equipes, phpl_equipes as EXT WHERE phpl_clubs.id=phpl_equipes.id_club AND CLEXT.id=EXT.id_club AND phpl_equipes.id=phpl_matchs.id_equipe_dom AND EXT.id=phpl_matchs.id_equipe_ext AND phpl_matchs.id_journee=phpl_journees.id AND phpl_journees.numero='$numero' AND phpl_journees.id_champ='$champ' AND (CLEXT.nom='exempte' or phpl_clubs.nom='exempte')";
$resultats=mysql_query($requete) or die (mysql_error());

while ($row=mysql_fetch_array($resultats))
{
if ($row[0]=='exempte') {echo "<tr bgcolor=$bgcolor1 class=trphpl><td colspan=7>".ADMIN_RESULTS_1." : $row[1]</td></tr>";}
if ($row[1]=='exempte') {echo "<tr bgcolor=$bgcolor1 class=trphpl><td colspan=7 >".ADMIN_RESULTS_1." : $row[0]</td></tr>";}
}*/
	echo "</TBODY></table>";
}

// *** REMPLI LA TABLE CLMNT
function db_clmnt($legende, $type, $accession, $barrage, $relegation, $champ, $debut, $fin)
          {   
          mysql_query("DELETE FROM phpl_clmnt") or die (mysql_error());
 
          if (!$fin){$fin=(nb_equipes($champ)*2)-2;}
          if (!$debut){$debut=1;}

// SELECTION DES PARAMETRES
$query="SELECT * FROM phpl_parametres WHERE id_champ='$champ'";
$result=(mysql_query($query)) or die (mysql_error()) ;
      while ($row=mysql_fetch_array($result) )
      {
      $pts_victoire=$row['pts_victoire'];
      $pts_nul=$row['pts_nul'];
      $pts_defaite=$row['pts_defaite'];
      $id_equipe_fetiche=$row['id_equipe_fetiche'];
      }     
// NOM de EQUIPE FAVORITE a partir de son id
$result=(mysql_query("SELECT nom FROM phpl_clubs, phpl_equipes WHERE phpl_equipes.id='$id_equipe_fetiche' and phpl_clubs.id=phpl_equipes.id_club"));
     while ($row=mysql_fetch_array($result))
     {
     $equipe_fetiche=$row[0];
     }      
mysql_free_result($result);
// victoires domicile
$query="SELECT dom.id, count(dom.id), phpl_clubs.nom, sum(buts_dom), sum(buts_ext) FROM phpl_equipes as dom, phpl_clubs, phpl_matchs, phpl_journees, phpl_championnats
WHERE dom.id_champ='$champ'
      AND dom.id_club=phpl_clubs.id
      AND dom.id=phpl_matchs.id_equipe_dom
      AND buts_dom > buts_ext
      AND phpl_championnats.id=phpl_journees.id_champ
      AND phpl_journees.id=phpl_matchs.id_journee
      AND phpl_journees.numero>='$debut'
      AND phpl_journees.numero<='$fin'
      GROUP by phpl_clubs.nom ";
$dom = mysql_query($query) or die (mysql_error());    
     while($row= mysql_fetch_array($dom))
     {
     $clmnt[$row[2]]['GDOM']=$row[1];
     $clmnt[$row[2]]['BUTSDOMPOUR']=$row[3];
     $clmnt[$row[2]]['BUTSDOMCONTRE']=$row[4];
     }            
mysql_free_result($dom);
// Defaites domicile
$query="SELECT dom.id, count(dom.id), phpl_clubs.nom, sum(buts_dom), sum(buts_ext) FROM phpl_equipes as dom, phpl_clubs, phpl_matchs, phpl_journees, phpl_championnats
WHERE dom.id_champ='$champ'
      AND dom.id_club=phpl_clubs.id
      AND dom.id=phpl_matchs.id_equipe_dom
      AND buts_dom < buts_ext
      AND phpl_championnats.id=phpl_journees.id_champ
      AND phpl_journees.id=phpl_matchs.id_journee
      AND phpl_journees.numero>='$debut'
      AND phpl_journees.numero<='$fin'
      GROUP by phpl_clubs.nom ";
$dom = mysql_query($query) or die (mysql_error());
     while($row= mysql_fetch_array($dom))
     {
     $clmnt[$row[2]]['PDOM']=$row[1];
     $clmnt[$row[2]]['BUTSDOMPOUR']+=$row[3];
     $clmnt[$row[2]]['BUTSDOMCONTRE']+=$row[4];
     }            
mysql_free_result($dom);
// Nuls domicile
$query="SELECT dom.id, count(dom.id), phpl_clubs.nom, sum(buts_dom), sum(buts_ext) FROM phpl_equipes as dom, phpl_clubs, phpl_matchs, phpl_journees, phpl_championnats
WHERE dom.id_champ='$champ'
      AND dom.id_club=phpl_clubs.id
      AND dom.id=phpl_matchs.id_equipe_dom
      AND buts_dom = buts_ext
      AND buts_dom is not null
      AND buts_ext is not null
      AND phpl_championnats.id=phpl_journees.id_champ
      AND phpl_journees.id=phpl_matchs.id_journee
      AND phpl_journees.numero>='$debut'
      AND phpl_journees.numero<='$fin'
      GROUP by phpl_clubs.nom ";
$dom = mysql_query($query) or die (mysql_error());
     while($row= mysql_fetch_array($dom))
     {
     $clmnt[$row[2]]['NDOM']=$row[1];
     $clmnt[$row[2]]['BUTSDOMPOUR']+=$row[3];
     $clmnt[$row[2]]['BUTSDOMCONTRE']+=$row[4];
     }
mysql_free_result($dom);
// Resultats à domicile
$query="SELECT phpl_clubs.nom FROM phpl_clubs, phpl_equipes, phpl_championnats
WHERE phpl_equipes.id_champ=phpl_championnats.id
      AND phpl_championnats.id='$champ'
      AND phpl_equipes.id_club=phpl_clubs.id";
$result=mysql_query($query) or die (mysql_error());

// RESULTATS EXTERIEURS :
// victoires exterieur
$query="SELECT ext.id, count(ext.id), phpl_clubs.nom, sum(buts_ext), sum(buts_dom) FROM phpl_equipes as ext, phpl_clubs, phpl_matchs, phpl_journees, phpl_championnats
WHERE ext.id_champ='$champ'
      AND ext.id_club=phpl_clubs.id
      AND ext.id=phpl_matchs.id_equipe_ext
      AND buts_ext > buts_dom
      AND phpl_championnats.id=phpl_journees.id_champ
      AND phpl_journees.id=phpl_matchs.id_journee
      AND phpl_journees.numero>='$debut'
      AND phpl_journees.numero<='$fin'
      GROUP by phpl_clubs.nom ";
$dom = mysql_query($query) or die (mysql_error());;

               
     while($row= mysql_fetch_array($dom))
     {
     $clmnt[$row[2]]['GEXT']=$row[1];
     $clmnt[$row[2]]['BUTSEXTPOUR']=$row[3];
     $clmnt[$row[2]]['BUTSEXTCONTRE']=$row[4];
     }
 mysql_free_result($dom);
// Defaites exterieur
$query="SELECT ext.id, count(ext.id), phpl_clubs.nom, sum(buts_ext), sum(buts_dom) FROM phpl_equipes as ext, phpl_clubs, phpl_matchs, phpl_journees, phpl_championnats
WHERE ext.id_champ='$champ'
      AND ext.id_club=phpl_clubs.id
      AND ext.id=phpl_matchs.id_equipe_ext
      AND buts_ext < buts_dom
      AND phpl_championnats.id=phpl_journees.id_champ
      AND phpl_journees.id=phpl_matchs.id_journee
      AND phpl_journees.numero>='$debut'
      AND phpl_journees.numero<='$fin'
      GROUP by phpl_clubs.nom ";
$dom=mysql_query($query) or die (mysql_error());
                    
      While($row= mysql_fetch_array($dom))
      {
      $clmnt[$row[2]]['PEXT']=$row[1];
      $clmnt[$row[2]]['BUTSEXTPOUR']+=$row[3];
      $clmnt[$row[2]]['BUTSEXTCONTRE']+=$row[4];
      }

mysql_free_result($dom);
// Nuls exterieur
$query="SELECT ext.id, count(ext.id), phpl_clubs.nom, sum(buts_ext), sum(buts_dom) FROM phpl_equipes as ext, phpl_clubs, phpl_matchs, phpl_journees, phpl_championnats
WHERE ext.id_champ='$champ'
      AND ext.id_club=phpl_clubs.id
      AND ext.id=phpl_matchs.id_equipe_ext
      AND buts_ext = buts_dom
      AND buts_dom is not null
      AND buts_ext is not null
      AND phpl_championnats.id=phpl_journees.id_champ
      AND phpl_journees.id=phpl_matchs.id_journee
      AND phpl_journees.numero>='$debut'
      AND phpl_journees.numero<='$fin'
      GROUP by phpl_clubs.nom ";

$dom=mysql_query($query) or die (mysql_error());;

      while($row= mysql_fetch_array($dom))
      {
      $clmnt[$row[2]]['NEXT']=$row[1];
      $clmnt[$row[2]]['BUTSEXTPOUR']+=$row[3];
      $clmnt[$row[2]]['BUTSEXTCONTRE']+=$row[4];
      }
                 
mysql_free_result($dom);
// TABLEAU DE CLASSEMENT
$query="SELECT phpl_clubs.nom, phpl_tapis_vert.pts from phpl_clubs, phpl_equipes, phpl_championnats, phpl_tapis_vert
WHERE phpl_equipes.id_champ=phpl_championnats.id
      AND phpl_championnats.id='$champ'
      AND phpl_equipes.id_club=phpl_clubs.id
      AND phpl_equipes.id=phpl_tapis_vert.id_equipe";
$result=mysql_query($query) or die (mysql_error());
    
//mysql_query("LOCK TABLE phpl_clmnt WRITE, phpl_equipes WRITE, phpl_clubs WRITE") or die (mysql_error());
    
    if (mysql_num_rows($result)==0)
    {
    mysql_free_result($result);
    $query="SELECT phpl_clubs.nom from phpl_clubs, phpl_equipes, phpl_championnats
    WHERE phpl_equipes.id_champ=phpl_championnats.id
          AND phpl_championnats.id='$champ'
          AND phpl_equipes.id_club=phpl_clubs.id";
    $result=mysql_query($query) or die (mysql_error());
    }
    
             

    while($row = mysql_fetch_array($result))
    {
    $x=$row[0];
    $NOM=$row[0];
    $DOMJOUES=$clmnt[$x]['GDOM']+$clmnt[$x]['NDOM'] + $clmnt[$x]['PDOM'];
    $EXTJOUES=$clmnt[$x]['GEXT']+$clmnt[$x]['NEXT'] + $clmnt[$x]['PEXT'];
    $JOUES=$EXTJOUES + $DOMJOUES;
    $DOMPOINTS=(($clmnt[$x]['GDOM'])*$pts_victoire) + (($clmnt[$x]['NDOM'])*$pts_nul) + (($clmnt[$x]['PDOM'])*$pts_defaite);
    $EXTPOINTS=(($clmnt[$x]['GEXT'])*$pts_victoire) + (($clmnt[$x]['NEXT'])*$pts_nul) + (($clmnt[$x]['PEXT'])*$pts_defaite);
    $POINTS= $DOMPOINTS+ $EXTPOINTS + $row[1];
    $G=($clmnt[$x]['GEXT'])+($clmnt[$x]['GDOM']);
    $N=($clmnt[$x]['NEXT'])+($clmnt[$x]['NDOM']);
    $P=$clmnt[$x]['PEXT'] + $clmnt[$x]['PDOM'];
    $DOMG=($clmnt[$x]['GDOM']);
    $DOMN=($clmnt[$x]['NDOM']);
    $DOMP=$clmnt[$x]['PDOM'];
    $EXTG=($clmnt[$x]['GEXT']);
    $EXTN=($clmnt[$x]['NEXT']);
    $EXTP=$clmnt[$x]['PEXT'];
    $BUTSPOUR=$clmnt[$x]['BUTSEXTPOUR'] + $clmnt[$x]['BUTSDOMPOUR'];
    $DOMBUTSPOUR=$clmnt[$x]['BUTSDOMPOUR'];
    $EXTBUTSPOUR=$clmnt[$x]['BUTSEXTPOUR'];
    $BUTSCONTRE=$clmnt[$x]['BUTSEXTCONTRE'] + $clmnt[$x]['BUTSDOMCONTRE'];
    $DOMBUTSCONTRE= $clmnt[$x]['BUTSDOMCONTRE'];
    $EXTBUTSCONTRE=$clmnt[$x]['BUTSEXTCONTRE'] ;
    $DIFF=$BUTSPOUR - $BUTSCONTRE;
    $DOMDIFF=$DOMBUTSPOUR-$DOMBUTSCONTRE;
    $EXTDIFF=$EXTBUTSPOUR - $EXTBUTSCONTRE;
    $PEN= $row[1];

   $query1="SELECT phpl_equipes.id FROM phpl_equipes, phpl_clubs WHERE phpl_clubs.id=phpl_equipes.id_club and phpl_clubs.nom='$NOM' and phpl_equipes.id_champ='$champ'";

    $result1=mysql_query($query1) or die (mysql_error());
    while($row1=mysql_fetch_array($result1)){$id_equipe=$row1[0];}

    $question="INSERT INTO phpl_clmnt
          SET NOM='$NOM',
          ID_EQUIPE='$id_equipe',
          ID_CHAMP='$champ',
          POINTS='$POINTS',
          DOMPOINTS='$DOMPOINTS',
          EXTPOINTS='$EXTPOINTS',
          JOUES= '$JOUES',
          DOMJOUES= '$DOMJOUES',
          EXTJOUES= '$EXTJOUES',
          G='$G',
          DOMG='$DOMG',
          EXTG='$EXTG',
          N='$N',
          DOMN='$DOMN',
          EXTN='$EXTN',
          P='$P',
          DOMP='$DOMP',
          EXTP='$EXTP',
          BUTSPOUR='$BUTSPOUR',
          DOMBUTSPOUR='$DOMBUTSPOUR',
          EXTBUTSPOUR='$EXTBUTSPOUR',
          BUTSCONTRE='$BUTSCONTRE',
          DOMBUTSCONTRE='$DOMBUTSCONTRE',
          EXTBUTSCONTRE='$EXTBUTSCONTRE',
          DIFF='$DIFF',
          DOMDIFF='$DOMDIFF',
          EXTDIFF='$EXTDIFF',
          PEN='$PEN'";
          $result2=mysql_query($question) or die(mysql_error());
    }
$requete="DELETE FROM phpl_clmnt WHERE nom='exempte'" or die (mysql_error());
$resultat=mysql_query($requete) or die (mysql_error());
mysql_free_result($result);
//mysql_query("UNLOCK TABLES") or die (mysql_error());
}

function clmnt($legende, $type, $accession, $barrage, $relegation,  $champ, $requete, $lien, $class, $chemin)
{
	$query = "SELECT nom, id_equipe_fetiche FROM phpl_clubs, phpl_equipes, phpl_parametres WHERE id_equipe_fetiche=phpl_equipes.id AND phpl_equipes.id_club=phpl_clubs.id AND phpl_parametres.id_champ='$champ'";
	$result=mysql_query($query) or die(mysql_error());
	$row=mysql_fetch_array($result);

	if (!mysql_num_rows($result)=="0")
	      {
	      $equipe_fetiche=$row[0];
	      $id_equipe_fetiche=$row[1];
	      }
	else {$equipe_fetiche="0";$id_equipe_fetiche="0";}

	echo "<TABLE cellSpacing=0 cellPadding=2
	width=100% align=center style='TEXT-ALIGN:CENTER;'
	background=\"img/fclassement.gif\"
	border=0>
	    <TBODY>
	    <TR bgColor=#D1D1C5>
	    <TH width=\"5%\" height=20>&nbsp;</TH>
	    <TH align=left width=\"47%\">Club</TH>
	    <TH width=\"6%\">Pts</TH>
	    <TH width=\"6%\">J</TH>
	    <TH width=\"6%\">G</TH>
	    <TH width=\"6%\">N</TH>
	    <TH width=\"6%\">P</TH>
	    <TH width=\"6%\">bp</TH>
	    <TH width=\"6%\">bc</TH>
	    <TH width=\"6%\">diff</TH></TR>
	    </TBODY>";

	$result=mysql_query($requete) or die (mysql_error());
	$pl=1;
      
      while ($row=mysql_fetch_array($result))
      {
                        if ($row['NOM']==EXEMPT){continue;}
 /*                       if ($pl<=$accession and $type==GENERAL){echo "<TR class=trphpl bgcolor=#ccffcc>";}
                        elseif ($pl<=$barrage and $type==GENERAL){echo "</tr><TR class=trphpl bgcolor=#66CCFF>";}
                        elseif ($pl>$relegation and $type==GENERAL){echo "</tr><TR class=trphpl bgcolor=#ffcc99>";}
                        elseif (($pl%2)==0){echo "<TR class=trphpl bgcolor=#E5E5E5>";}
                      	else{echo "<TR class=trphpl bgcolor=#FFFFFF>";}*/
						if ($row['NOM']==$equipe_fetiche){echo "<TR class=bgjaune style=\"FONT-WEIGHT: bold\">";}
                      	else echo "<TR>";
                        
        echo "<TD align=left height=20>";
        print $pl;
        $pl++;
		echo "<td align=left>";
                    $query2="SELECT phpl_equipes.id, phpl_clubs.nom FROM phpl_equipes, phpl_clubs
                    WHERE phpl_clubs.nom='$row[0]'
                          AND phpl_equipes.id_champ='$champ'
                          AND phpl_clubs.id=phpl_equipes.id_club";
                    $result2=mysql_query($query2) or die(mysql_error());;

                                  while($id_equipe=mysql_fetch_array($result2))
                                  {
                                  $id=$id_equipe['id'];
                                  }
                  @mysql_free_result($result2);
                     if ($lien=='non'){echo "$row[0]";}
                     else {echo "<a class=noir href=\"index.php?page=calendindiv&champ=$champ&id_equipe=$id\">$row[0]</a>";}
        $x=1;

              while($x<9)
               {
                    echo "<td>";
					print $row[$x];
                    $x++;
               }
/*            echo "<td align=right>";
             $leg=CONSULT_CLUB_4;
             if ($type==GENERAL){echo "<a href=\"#\" onClick=\"window.open('graph.php?equipe=$id','Stats','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=560,height=320');\"><img src=\"graph.gif\" border=\"0\" alt=\"$leg\"></img></a> ";}
             echo "</td>";*/
			 echo "</TR>";
            }
        @mysql_free_result($result);
        echo "</table>";
}

function Buteur($legende, $requete, $type, $EquipeFetiche )
{
	echo "<TABLE style=\"MARGIN-TOP: 14px\" cellSpacing=0 cellPadding=0 width=100% align=center border=0>
	   <TBODY><TR><TD class=deco><SPAN class=deco3>".$legende."</SPAN>
	   <SPAN class=deco4>Classement des buteurs</SPAN></TD></TR></TBODY></TABLE>";
	echo "<TABLE cellSpacing=0 cellPadding=2
		width=100% align=center style='TEXT-ALIGN:CENTER;'
		background=\"img/fclassement.gif\"
		border=0>
		    <TBODY>
		    <TR bgColor=#D1D1C5>
		    <TH width=\"5%\" height=20>&nbsp;</TH>
		    <TH width=\"40%\" align=left>Nom</TH>
		    <TH width=\"40%\">Position</TH>
		    <TH width=\"15%\">Total</TH></TR>
		    </TBODY>";
	$query=$requete;
	$result=mysql_query($query) or die (mysql_error());
	$pl=1;

	while ($row=mysql_fetch_array($result))
	{
		echo "<TR height=20><TD align=left>".$pl."</TD>";
		$pl++;
		$Test="NON";
		$array = explode(",",$EquipeFetiche);

		if (sizeof($array)==1)
		{
			if ($row['idClub']==$array[0])
				$Test="OUI";
		}

		else
		{
			for ($i="0"; $i < sizeof($array); $i++)
			{
			if ("'$row[idClub]'"==$array[$i]){$Test="OUI";}
			}
		}

		echo "<TD align=left><b>".$row[3]." ".$row[2]."</b>" ;
		echo "<TD>".$row[6];
		echo "<TD>".$row[1];
	}
	echo "</table>";
}

// Affichage renseignements utilisée dans consult/club.php
function aff_rens ($id_classe, $id_clubs)
{
$query="SELECT phpl_donnee.id, phpl_donnee.nom, id_rens, id_clubs, phpl_rens.id, phpl_rens.nom, phpl_rens.id_classe, phpl_clubs.id, etat, phpl_donnee.url, phpl_rens.url
FROM phpl_donnee, phpl_rens, phpl_clubs
WHERE id_clubs='$id_clubs' 
      AND id_clubs=phpl_clubs.id
      AND id_rens=phpl_rens.id
      AND id_classe='$id_classe'
      AND etat='1' order by rang";
$result = mysql_query ($query) or die(mysql_error());
$nb_rens=mysql_num_rows($result);
if ($nb_rens=="0")
	echo "<center>".ADMIN_EQUIPE_8."</center>";
while($row = mysql_fetch_array($result))
{
	if (empty ($row[9]) and empty ($row[10])){echo "<b>$row[5] :</b> $row[1] <br>";}
	elseif (empty ($row[9])){echo "<b><a href=\"$row[10]\">$row[5]</a> :</b> $row[1]<br>";}
	elseif (empty ($row[10])){echo "<b>$row[5] :</b> <a href=\"$row[9]\">$row[1]</a><br>";}
	else {echo "<b><a href=\"$row[10]\">$row[5]</a> :</b> <a href=\"$row[9]\">$row[1]</a><br>";}
}
}

function clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini,  $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini)
{
// NOM de EQUIPE FAVORITE a partir de son id
$query="SELECT * FROM phpl_parametres WHERE id_champ='$champmini'";
$result=(mysql_query($query));

while ($row=mysql_fetch_array($result))
	$id_equipe_fetiche=$row['id_equipe_fetiche'];

$result=(mysql_query("SELECT nom FROM phpl_clubs, phpl_equipes WHERE phpl_equipes.id='$id_equipe_fetiche' AND phpl_clubs.id=phpl_equipes.id_club"));

while ($row=mysql_fetch_array($result))
	$equipe_fetiche=$row[0];

echo "<table width=170 border=0 cellspacing=0 cellpadding=0 style='margin-bottom:14px; border:1px #061922 solid; color:#E03127;'>";
echo "<tr><TD align=center colspan=3 class=bgnoir height=20><SPAN class=deco3><a href='index.php?page=classement&champ=$champmini&type=Général'><b class=jaune>CLASSEMENT</b></a></SPAN></td></tr>";

$result=mysql_query($requetemini) or die (mysql_error());
$pl=1;
$pl2=1;

while ($row=mysql_fetch_array($result))
{
	if ($row['NOM']==$equipe_fetiche)
	{
		$av=$pl2-$nb_dessusmini;
		$ap=$pl2+$nb_dessousmini;
	}
	$pl2++;
}
if ($av==0) {$ap++;}

$result=mysql_query($requetemini) or die (mysql_error());
while ($row=mysql_fetch_array($result))
{
	if ($pl<=$ap and $pl>=$av)
	{
		if ($row['NOM']==EXEMPT){continue;}
		elseif ($row[0]==$equipe_fetiche){echo "<TR class=bgjaune style='font-weight:bold;color=#000'>";}
		else {echo "<TR class=noir>";}
		echo "<td width=10% align='left' height=20 style='padding-left:3px;'>";
		print $pl;
		$pl++;
		$x=0;

		while($x<2)   // nb de colones
		{
			if ($x==0){}
			if ($x==0)
			{
				echo "<td align='left'>";
				$query2="SELECT phpl_equipes.id, phpl_clubs.nom FROM phpl_equipes, phpl_clubs
						 WHERE phpl_clubs.nom='$row[0]'
						 	AND phpl_equipes.id_champ='$champmini'
							AND phpl_clubs.id=phpl_equipes.id_club";
				$result2=mysql_query($query2);

				if ($lienmini=='non'){echo "$row[$x]";}
				else {echo "<a class='nav3' href='index.php?page=classement&champ=$champmini&type=Général'>$row[$x]</a>";}
			}

			else {echo "<td>".$row[$x]."</td>";}
			$x++;
		}
	}
	elseif ($pl>$ap){$pl++;}
	elseif ($pl<$av){$pl++;}
}
echo "</table>";
}

function time1 ()
{ //calcul du temps de debut de recherche
	$time_deb = microtime();
	$time_deb = explode(" ",$time_deb);
	$time_deb = $time_deb[0] + $time_deb[1];
}

function time2 ($page, $nom)
   {$time_fin = microtime();
	$time_fin = explode(" ",$time_fin);
	$time_fin = $time_fin[0] + $time_fin[1];
	$time_search = $time_fin - $time_deb;
print $time_search;
$query="INSERT into chargement (id_page, temps) VALUES ($page, $time_search) " ;
mysql_query($query) or die(mysql_error());
}

function next_mini($champ, $numero)
{
	$result=(mysql_query("SELECT * FROM phpl_parametres WHERE id_champ='$champ' "));
	$row=mysql_fetch_array($result);
	$id_equipe_fetiche=$row['id_equipe_fetiche'];

	$result=(mysql_query("SELECT nom FROM phpl_clubs, phpl_equipes WHERE phpl_equipes.id='$id_equipe_fetiche' AND phpl_clubs.id=phpl_equipes.id_club"));
	$row=mysql_fetch_array($result);
	$club=$row[0];

	$query="SELECT phpl_divisions.nom FROM phpl_championnats, phpl_divisions, phpl_saisons WHERE phpl_championnats.id='$champ' AND phpl_divisions.id=phpl_championnats.id_division AND phpl_saisons.id=phpl_championnats.id_saison";
	$result = mysql_query($query);
	while ($row=mysql_fetch_array($result))
	$shortchamp=$row[0];

	$query1="SELECT phpl_journees.numero, cldom.nom, clext.nom, phpl_matchs.date_reelle
	        FROM phpl_equipes as dom, phpl_equipes as ext, phpl_matchs, phpl_journees, phpl_clubs as cldom  , phpl_clubs as clext
	        WHERE phpl_matchs.id_equipe_dom=dom.id
	        AND phpl_matchs.id_equipe_ext=ext.id
			AND (clext.nom='$club' OR cldom.nom='$club')
	        AND phpl_journees.id_champ='$champ'
	        AND phpl_journees.numero='$numero'
	        AND dom.id_club=cldom.id
	        AND ext.id_club=clext.id
	        AND phpl_matchs.id_journee=phpl_journees.id
	        ORDER BY phpl_journees.numero";
	$result=mysql_query($query1);

	$row=mysql_fetch_array($result);
	$date = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})','\\3/\\2/\\1', $row[3]);
    echo "<TR><td align=center>".$date."</td>";
	if ($row[1]=='Exempte' or $row[2]=='Exempte')
		echo "<td colspan=3 align=center>".ADMIN_RESULTS_1."</td>";
	else
	{
		echo "<TD align=\"right\">";
		if($row[1]==$club)
		    echo "<b><a class=nav3 href='?page=classement&type=Général&champ=$champ'>";
		echo $row[1]."</a></td><td align=center>-</td><TD align='left'>";
		if($row[2]==$club)
			echo "<b><a class=nav3 href='?page=classement&type=Général&champ=$champ'>";
		echo $row[2]."</a></td>";
	}
	echo "<TD height=20 align=center><a class=nav href='?page=classement&type=Général&champ=$champ'><b>$shortchamp</b></td></tr>";

	@mysql_free_result($query1);
}

function last_mini($champ, $numero)
{
	$result=(mysql_query("SELECT * FROM phpl_parametres WHERE id_champ='$champ' "));
	$row=mysql_fetch_array($result);
	$id_equipe_fetiche=$row['id_equipe_fetiche'];

	$result=(mysql_query("SELECT nom FROM phpl_clubs, phpl_equipes WHERE phpl_equipes.id='$id_equipe_fetiche' AND phpl_clubs.id=phpl_equipes.id_club"));
	$row=mysql_fetch_array($result);
	$club=$row[0];

	$query="SELECT phpl_divisions.nom FROM phpl_championnats, phpl_divisions, phpl_saisons WHERE phpl_championnats.id='$champ' AND phpl_divisions.id=phpl_championnats.id_division AND phpl_saisons.id=phpl_championnats.id_saison";
	$result = mysql_query($query);
	while ($row=mysql_fetch_array($result))
	$shortchamp=$row[0];

	$query1="SELECT phpl_journees.numero, cldom.nom, clext.nom, phpl_matchs.buts_dom, phpl_matchs.buts_ext
	        FROM phpl_equipes as dom, phpl_equipes as ext, phpl_matchs, phpl_journees, phpl_clubs as cldom  , phpl_clubs as clext
	        WHERE phpl_matchs.id_equipe_dom=dom.id
	        AND phpl_matchs.id_equipe_ext=ext.id
			AND (clext.nom='$club' OR cldom.nom='$club')
	        AND phpl_journees.id_champ='$champ'
	        AND phpl_journees.numero='$numero'
	        AND dom.id_club=cldom.id
	        AND ext.id_club=clext.id
	        AND phpl_matchs.id_journee=phpl_journees.id
	        ORDER BY phpl_journees.numero";
	$result=mysql_query($query1);

	while ($row=mysql_fetch_array($result))
	{
	    echo "<TR><TD align=center height=20><a class=nav href='?page=classement&type=Général&champ=$champ'><b>$shortchamp</b></center>";
		if ($row[1]=='Exempte' or $row[2]=='Exempte')
			echo "<td colspan=5 align=center>".ADMIN_RESULTS_1."</td>";
		else
		{
			echo "<TD align=\"right\">";
			if($row[1]==$club)
			    echo "<b><a class=nav3 href='?page=classement&type=Général&champ=$champ'>";
			echo $row[1];
			echo "</a>&nbsp;&nbsp;</td><TD align=center width=5%><b>";
			if ($row[3]<>'' and $row[1]==$club)
			{
				if ($row[3]>$row[4]) echo "<font color=\"#339933\">";
				if ($row[3]<$row[4]) echo "<font color=\"#ff0000\">";
			}
			elseif ($row[3]<>'' and $row[2]==$club)
			{
				if ($row[3]<$row[4]) echo "<font color=\"#339933\">";
				if ($row[3]>$row[4]) echo "<font color=\"#ff0000\">";
			}
			elseif ($row[3]==$row[4])
				echo "<font color=\"#0000FF\">";
			echo $row[3];
			echo "</b><td align=center width=1%>-</td><td align='center' width=5%><b>";
			if ($row[3]<>'' and $row[1]==$club)
			{
				if ($row[3]>$row[4]) echo "<font color=\"#339933\">";
				if ($row[3]<$row[4]) echo "<font color=\"#ff0000\">";
			}
			elseif ($row[3]<>'' and $row[2]==$club)
			{
				if ($row[3]<$row[4]) echo "<font color=\"#339933\">";
				if ($row[3]>$row[4]) echo "<font color=\"#ff0000\">";
			}
			elseif ($row[3]==$row[4])
				echo "<font color=\"#0000FF\">";
			echo $row[4];
			echo "</td><TD align='left'>&nbsp;&nbsp;";
			if($row[2]==$club)
				echo "<b><a class=nav3 href='?page=classement&type=Général&champ=$champ'>";
			echo $row[2]."</a></td></tr>";
		}
	}
	@mysql_free_result($query1);
}

function Score($champ, $numero, $titre)
{
	$result=(mysql_query("SELECT * FROM phpl_parametres WHERE id_champ='$champ' "));
	$row=mysql_fetch_array($result);
	$id_equipe_fetiche=$row['id_equipe_fetiche'];

	$result=(mysql_query("SELECT nom FROM phpl_clubs, phpl_equipes WHERE phpl_equipes.id='$id_equipe_fetiche' AND phpl_clubs.id=phpl_equipes.id_club"));
	$row=mysql_fetch_array($result);
	$club=$row[0];

	$query1="SELECT cldom.nom, clext.nom, phpl_matchs.buts_dom, phpl_matchs.buts_ext
	        FROM phpl_equipes as dom, phpl_equipes as ext, phpl_matchs, phpl_journees, phpl_clubs as cldom  , phpl_clubs as clext
	        WHERE phpl_matchs.id_equipe_dom=dom.id
	        AND phpl_matchs.id_equipe_ext=ext.id
			AND (clext.nom='$club' OR cldom.nom='$club')
	        AND phpl_journees.id_champ='$champ'
	        AND phpl_journees.numero='$numero'
	        AND dom.id_club=cldom.id
	        AND ext.id_club=clext.id
	        AND phpl_matchs.id_journee=phpl_journees.id";
	$result=mysql_query($query1);

	$row=mysql_fetch_array($result);
	
	echo "<table width=100% align=center cellpadding=0 cellspacing=0 style='margin-top:14px;'>
    		<TR>";
	if ($row[0]=='Exempte' or $row[1]=='Exempte')
		echo "<td colspan=5 align=center>".ADMIN_RESULTS_1."</td>";
	else
	{
		echo "<TD width=42% height=33 align=right style='font-size:13pt; font-weight:bold; padding-right:6px;'>";
		echo $row[0];
		echo "</a></td><TD width=7% class=bgnoir align=center style='font-size:18pt; font-weight:bold;'><b class=jaune>";
		echo $row[2];
		echo "</b><td width=2%>&nbsp;</Td><td width=7% class=bgnoir align=center style='font-size:18pt; font-weight:bold;'><b class=jaune>";
		echo $row[3];
		echo "</td><TD width=42% align=left style='font-size:13pt; font-weight:bold; padding-left:6px;'>";
		echo $row[1]."</a></td></tr></table>";
	}
	@mysql_free_result($query1);
}
?>
