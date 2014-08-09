
<!-- CORPS DE LA PAGE -->
<table style="margin:auto;" border="0" cellspacing="0" cellpadding="0" width="500px" class="compte">
<tr>
    <td>
        <!-- MENU -->
        <!--#include virtual="/modules/moncompte/include/menu.asp"-->       
    </td>
</tr>
<tr>
<td id="espace_horizontal_gris"></td>
</tr>
<tr>
    <td class="menu">
        
        R&eacute;siliation abonnement Premium
        <br/>
        
        <span>
            R&eacute;siliation de votre abonnement <strong>Premium</strong> r&eacute;f&eacute;rence <strong><?php echo $data['paypal_profileID'];?></strong>.        
        </span>
            
    </td>
</tr>
<tr>
<td id="espace_horizontal_gris"></td>
</tr>

<tr>
    <td>
        <?php if (!empty($data['msg'])) { ?>
            <br/>
            <p class="alert"><?php echo $data['msg'];?></p>
        <?php }?>
    </td>
</tr>

<form method="post" action="" name="form" onSubmit="return verifier(this);">
<input name="post" type="hidden" value="1" />
<input name="id" type="hidden" value="<?php echo $data['id'];?>" />
<input name="hash" type="hidden" value="<?php echo $data['hash'];?>" />         
<tr>
    <td>        
             
             <br/>
             <br/>

             <p class="info">
                Votre abonnement sera r&eacute;sili&eacute; suite &agrave; la validation de ce formulaire.
                <br/>  
                <strong>
                Veuillez noter que votre annonce sera imm&eacute;diatement d&eacute;sactiv&eacute;e et tous les paiements seront imm&eacute;diatement arr&ecirc;t&eacute;s.       
                </strong>                         
             </p>
         
             
            <br/>

            <div id="div_question2" align="center" style="width:100%; color:#333333; font-size:14px;">
            
                <strong>Merci de nous indiquer la raison pour laquelle vous souhaitez mettre fin &agrave; votre abonnement :</strong> 
                <br/>
                <br/>               
                Je souhaite me d&eacute;sabonner et d&eacute;sactiver mon annonce car :                 
                <br/>
                <br/>                     
            
            </div>
             
            <div style="padding-left:200px; font-size:14px;">
             
                <label>
                <input type="radio" name="raison" id="raison" value="J'ai vendu grâce a Immobilier.fr" onclick="choixchanged(this);">J'ai vendu gr&acirc;ce &agrave; Immobilier.fr</option>
                </label>
                <br/>
                <label>
                <input type="radio" name="raison" id="raison" value="J'ai vendu par un autre biais" onclick="choixchanged(this);">J'ai vendu par un autre biais</option>
                </label>
                <br/>
                <label>
                <input type="radio" name="raison" id="raison" value="Je ne souhaite plus vendre" onclick="choixchanged(this);">Je ne souhaite plus vendre</option>
                </label>
                <br/>
                <label>
                <input type="radio" name="raison" id="raison" value="Je reporte la mise en vente pour plus tard" onclick="choixchanged(this);">Je reporte la mise en vente pour plus tard</option>
                </label>
                <br/>
                <label>
                <input type="radio" name="raison" id="raison" value="Je ne suis pas satisfait de vos services" onclick="choixchanged(this);">Je ne suis pas satisfait de vos services</option>
                </label>
                <br/>
                <label>
                <input type="radio" name="raison" id="raison" value="Autre" onclick="choixchanged(this);">Autre raison</option>
                </label>
                <br/>
                    
                <br/>
                <br/>
                
            </div>
                
            
            <div id="information" 
            style="background-color:#FFF; color:#333333; 
            border-top:2px #C0C0C0 dotted; padding-left:20px;">
                
                
                <?php
                /*************************************************************************
                'AFFICHAGE INFO & REMARQUES SI + DE 30 AFFICHAGE DU DETAIL ANNONCE
                '*************************************************************************/

                $nbminvisualisation = 30; //Nb mini de visualisation d'annonce nécessaire pour afficher les informations et remarques suivantes
                $nbminacquereur     = 1; //Nb mini d'acquereur
                $nbminmots          = 20; //Nb mini de 

                if ($data['nb_visualisation'] >= $nbminvisualisation) { ?>
                
                    <span style="font-size:14px;">
                        
                        <br/>
                        <br/>

                        <font style="color:#C30; font-size:16px;">
                        
                            <strong>
                            Saviez-vous que votre annonce a &eacute;t&eacute; consult&eacute;e <?php echo $nbminvisualisation;?> fois et
                            <br/>                       
                        <?php               
                        //Nombre total d'acquereur envoyé :
                        //(dans ce cas tous les clients ont été immédiatement reçu -> aucun en attente)
                        $nba = $data['acquereur_total'];
                        //Affichage du nombre d'acquereur total :
                        if ($nba > 1) { ?>
                            que vous avez re&ccedil;u <?php echo $nba;?> clients int&eacute;ress&eacute;s par votre annonce ?
                        <?php } elseif($nba == 1) { ?>
                            que vous n'avez re&ccedil;u qu'un seul client int&eacute;ress&eacute; par votre annonce ?
                        <?php } else { ?>
                            que vous n'avez re&ccedil;u aucun client int&eacute;ress&eacute; par votre annonce ?
                        <?php }?>
                        </strong>
                        </font>
                        <br/>
                        <br/>
                        <font style="font-size:16px; font-weight:bold;">
                            <?php
                            //AFFICHAGE REMARQUE ANNONCE
                            if ($nba <= $nbminacquereur) { ?>
                                Cel&agrave; ne r&eacute;v&egrave;le-t'il pas un probl&egrave;me au niveau de votre annonce :
                            <?php } ?>
                       </font> 
                        <?php 
                        //Remarques générales :
                        if ($data['nb_photo'] < 1) { ?>
                            <br/>
                            <br/>
                            <br/>
                            <font style="color:#9C2929;">
                            <img src="/images/puces/v<?php echo $nbrem;?>.gif" border="0" align="absmiddle" />
                            &nbsp;<strong style="font-size:16px;">Vous n'avez pas souhait&eacute; diffuser de photos de votre bien !</strong>
                            </font>
                            <br/>
                            <br/>
                            <strong>
                            Savez-vous que le simple fait d'ins&eacute;rer des photos sur votre annonce peut multiplier par 4 
                            <br/>
                            ou 5 le nombre de visites ?
                            </strong>
                            <br/>
                            Les photos sont un atout essentiel pour attirer l'attention et l'int&eacute;r&ecirc;t des visiteurs !
                            <br/>
                            <br/>                           
                                Mettez toutes les chances de votre c&ocirc;t&eacute;, ajoutez tr&egrave;s simplement
                                <br/>
                                jusqu'&agrave; 12 photos sur votre annonce en cliquant sur le bouton suivant :
                            <br/>
                            <br/>
                            <center>
                            <button onclick="location.replace('../photos/photos.asp?uid=<?php echo 'uid';//annonce.contact.uid ?>&id=<?php echo $data['id'];?>');">
                                <img src="/images/icones/png/photos.png" alt="" width="16" height="16" border="0" align="absmiddle" /> Ajouter des photos
                            </button>
                            </center>
                        <?php 
                            //Incrementation du nb de remarque (pour l'image)
                            $nbrem = $nbrem + 1;
                        } elseif ($data['nb_photo'] <= 3) { ?>
                            <br/>
                            <br/>
                            <br/>
                            <font style="color:#9C2929;">
                            <img src="/images/puces/v<?php echo $nbrem;?>.gif" border="0" align="absmiddle" />
                            &nbsp;<strong style="font-size:16px;">Vous avez diffus&eacute; tr&egrave;s peu de photos de votre bien !</strong>
                            </font>
                            <br/>
                            <br/>
                            
                                <strong>Savez-vous que les photos sont un atout essentiel pour attirer l'attention et l'int&eacute;r&ecirc;t des visiteurs ?</strong>
                                <br/>
                                Vous pouvez augmenter largement le nombre de visites de votre annonce et favoriser ainsi 
                                <br/>
                                la d&eacute;marche d'entrer en contact avec vous en ins&eacute;rant simplement plus de photos !
                                <br/>
                                <br/>
                                Mettez toutes les chances de votre côté, ajoutez tr&egrave;s simplement
                                <br/>
                                jusqu'&agrave; 12 photos sur votre annonce en cliquant sur le bouton suivant :
                            <br/>
                            <br/>
                            <center>
                            <button onclick="location.replace('../photos/photos.asp?uid=<?php echo 'uid';//moncompte.annonce.contact.uid ?>&id=<?php echo $data['id'];?>');" >
                                <img src="/images/icones/png/photos.png" alt="" width="16" height="16" border="0" align="absmiddle" /> Ajouter des photos
                            </button>
                            </center>
                        <?php 
                            //Incrementation du nb de remarque (pour l'image)
                            $nbrem = $nbrem + 1;
                        }
                        //COMPTABILISE LE NOMBRE DE MOTS DANS LE DESCRIPTIF ANNONCE
                        $des    = explode(" ",$data['description']);
                        $nbmots = count($des);
                        if ($nbmots <= $nbminmots) { ?>
                            <br/>
                            <br/>
                            <br/>
                            <font style="color:#9C2929;">
                            <img src="/images/puces/v<?php echo $nbrem;?>.gif" border="0" align="absmiddle" />
                            &nbsp;<strong style="font-size:16px;">Vous avez saisi moins de <?php echo $nbminmots;?> mots dans votre commentaire !</strong>
                            </font>
                            <br/>
                            <br/>
                            <br/>
                                <strong>
                                Dans le but de retenir l'attention de vos visiteurs, nous vous conseillons
                                <br/>
                                de saisir un minimum de 80 mots dans le commentaire de votre annonce.
                                </strong>
                                <br/>
                                <br/>
                                Modifiez tr&egrave;s simplement le commentaire de votre annonce en cliquant sur le bouton suivant :
                            <br/>
                            <br/>
                            <center>
                            <button onclick="location.replace('../annonces/modifier.asp?id=<?php echo $data['id'];?>&hash=<?php echo $data['hash'];?>');" >
                                <img src="/images/icones/png/page_white_text.png" alt="" width="16" height="16" border="0" align="absmiddle" /> Modifier mon commentaire
                            </button>
                            </center>
                        <?php
                            //Incrementation du nb de remarque (pour l'image)
                            $nbrem = $nbrem + 1;
                        }?>
                            <!-- BAROMETRE DES VENTES -->
                            
                            <br/>
                            <br/>
                            <br/>
                            <font style="color:#9C2929;">
                            <img src="/images/puces/v<?php echo $nbrem;?>.gif" border="0" align="absmiddle" />
                            &nbsp;<strong style="font-size:16px;">V&eacute;rifiez la conformit&eacute; de votre prix par rapport au march&eacute; actuel.</strong>
                            </font>
                            <br/>
                            <br/>
                            
                                Vous pouvez consulter les chiffres de l'immobilier des Notaires de France en cliquant ci-dessous :
                            
                            <br/>
                            <br/>
                            <center>
                            <button onclick="location.replace('http://www.immoprix.com');" >
                                <img src="/images/icones/png/chart_line.png" alt="" width="16" height="16" border="0" align="absmiddle" /> Consulter le site des Notaires de France
                            </button>
                            </center>
                            <br/>
                            <br/>
                    </span>
                    
                    <br/>
                    <br/>
                                <?php } ?>
                </div>
                <!-- --> 
                <div id="commentaire" align="center" style="width:100%; background-color:#FFF; border-top:2px #C0C0C0 dotted; color:#333333;">
                    <br/>
                    <strong style="color:#060;">Vous pouvez nous laisser un commentaire d&eacute;taill&eacute; sur la raison de votre d&eacute;sabonnement : </strong>
                    <br/>
                    <textarea id="COMM_CLIENT" name="COMM_CLIENT" cols="70" rows="5"></textarea>
                    <br/>
                    <br/>
                </div>
            <div align="center" style="width:100%; background-color:#EEE; border-top:2px #FFF dotted; color:#333333">
                <br/>
                <input type="submit" name="Submit" value="Résilier mon abonnement >>" />
                <br/>
                <br/>
            </div>
        <br/>
        <br/>
    </td>
</tr>
</form>
</table>
<script>
    function pip(id,interesse,com){
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('/module/traitementProspection'); ?>',
            type: 'POST',
            data: "id="+id+"&interesse="+interesse+"&com="+escape(com),
            success: function(response)
            {
                if (response.ret == 1) {
                    pipcmd(id, interesse);
                } else {
                    alert(response.msg);
                }
            }
        });
        //sendQueryAjaxEval("ajax/traitementProspection.asp","id="+id+"&interesse="+interesse+"&com="+escape(com));
    }
</script>