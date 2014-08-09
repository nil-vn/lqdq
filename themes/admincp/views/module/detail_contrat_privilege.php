		<br><br>
		********************
		<div style="margin: 50px 0 0 0;border:1px solid black">
				<h4><a href="module/statsprivilege" target="blank"><i>Voir toute la liste</i></a> 
				( Historique des contrats envoyés à partir du 22/07/2013 )</h4>
				<?php //if (!empty($rs)) { echo $rs;}
				if ($ret >0){
					echo $retStr;
				}?>
		</div><br>
		********************<br /><br />

		<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="tdgris">
		  
		  <tr class="titreorange">
		    <td width="50%"><strong>FICHE PRIVILEGE REFERENCE FP<?php echo isset($id_fiche) ? $id_fiche : '';?></strong></td>
		  </tr>
		  <tr>
		    <td class="fondvert"><br>REFERENCE ANNONCE:&nbsp;<strong><?php echo $id;?></strong><br></td>
		  </tr>
		  <tr class="titreorange">
		    <td height="2"></td>
		  </tr>
		  <tr>
		    <td >
				DATE CREATION FICHE:&nbsp;<strong><?php echo $date_creation;?></strong>
				<br>
				DATE SIGNATURE DU CONTRAT:&nbsp;<strong><?php echo $date_signature;?></strong>
			</td>
		  </tr>
		  <tr class="titreorange">
		    <td height="2"></td>
		  </tr>
		  <tr>
		    <td align="center">
			<br><strong class="Style1">FRAIS DE DIFFUSION :&nbsp;<?php echo $frais_diffusion;?>%</strong>
			</td>
		  </tr> 
		  <tr>
		    <td align="center">
			<br>
			<?php 
			$lien = "/back-office/contrat?id=".$id."&cle=".sha1($user_id);
			?>
				<input name="" type="button" value="VISUALISER LE CONTRAT" onClick="window.open('<?php echo $lien; ?>')">
			<br>
			<br>
			<br>
			<br>
			</td>
		  </tr>
		  <tr class="titreorange">
		    <td height="2"></td>
		  </tr>
		  
		  <?php
		  //LE BIEN EST VENDU
		  if (!empty($date_compromis)) { ?>
			  <tr class="titreorange">
				<td width="50%">UN COMPROMIS DE VENTE A ETE SIGNE LE <?php echo $date_compromis;?></td>
			  </tr>
			  <tr>
				<td align="center">
				<strong> 
				<br>
				Le client déclare que l'acquéreur de ce bien 
				<?php if ($client_immobilier==1) { ?>
					<span class="Style1">a été envoyé par immobilier.fr</span>		
					<?php } else { ?>
					<span class="Style2">n'a pas été envoyé par immobilier.fr</span>		
					<?php }?>
				</strong>
				<br>
				<br>
				</td>
			  </tr>
			  <tr class="titreorange">
				<td height="2"></td>
			  </tr>
			  <tr>
				<td class="fondvert">
				<strong>COORDONNEES DE L'ACQUEREUR:</strong>	
				</td>
			  </tr>
			  <tr class="titreorange">
				<td height="2"></td>
			  </tr>
			  <tr>
			  	<td>
				<br>
					<strong><?php echo strtoupper($nom)." ".$prenom;?></strong>
					<br>
					Tel : <strong><?php echo $tel;?></strong>
					<br>
					E-mail : <strong><?php echo isset($email) ? $email :'' ;?></strong><br>
				<br>
				<?php if ($client_fraude) {?>
				<center>
				Merci de vérifier les coordonnées du client en cliquant sur le bouton "Clients potentiel"<br>
				<input style="width:120px;" name="" type="button" value="Clients potentiels"><br>
				<!-- onclick='ouvre_fenetre(webroot+"/module/privilegeClients?id=<?php echo $id;?>","","600","500");' -->
				</center>
				<br>
				<?php }?>
				</td>
			  </tr>
			  <tr class="titreorange">
				<td height="2"></td>
			  </tr>
			  <tr>
				<td class="fondvert">
				NOM DU NOTAIRE EN CHARGE DE L'ACTE : <strong class="Style1"><?php echo strtoupper($notaire);?></strong>
				</td>
			  </tr>
			  
			 
			<?php } else { ?>
			  <tr>
				<td class="fondvert">
				<strong>PAS DE COMPROMIS DE VENTE EN COURS</strong>	
				</td>
			  </tr>
		  <?php }?>
			<tr class="titreorange">
				<td height="2"></td>
			</tr>
			<tr>
				<td class="fondvert">
				<strong>HISTORIQUE DU MANDAT</strong> 		
				</td>
			</tr>
			<?php
				if(!empty($privilege_mandats_actions)){
					foreach($privilege_mandats_actions as $action){
						echo "<tr><td><strong>".$action->type_action."</strong> le ".$action->date_action." (par ".$action->ip_client.")</td></tr>";
					}
				}
			?>
		</table>
	<script language="javascript">
		function ouvre_fenetre(url, rappel_client,largeur,hauteur)
		{
		    window.open(url, rappel_client, 'status=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizeable=yes,copyhistory=no,width='+largeur+',height='+hauteur);
		}
	</script>