<div style="padding-bottom: 50px;">
    <?php echo $headerfooter; ?>
</div>
<div id="wrrap">
    <div>
<!--        <img id="logo" src="<?php //echo Yii::app()->theme->baseUrl;  ?>/img/immobilier.fr.jpg"/>
        <div id="vien"></div>-->
    </div>
    <!--part 2-->
    <div id="dialogplus">
        <div id="dialogleft">
            <div style="padding-top: 20px; padding-left: 15px;">
                <div><strong>Facture du</strong>  <?php echo "<strong>" . $ladate . "</trong>"; ?></div>
                <div><strong>n° de facture :</strong> V<?php echo "<strong>" . $id . "</trong>" ?></div>
                <div><strong>n° de client :</strong> <?php echo "<strong>" . $user_id . "</trong>"; ?></div>
                <div><strong>Référence annonce :</strong> <?php echo "<strong>" . $idannonce . "</trong>"; ?></div>
            </div>
        </div>
        <div id="dialogright"><div style="padding-top: 20px; padding-left: 15px;"><?php echo "<strong>" . $user . "</trong>"; ?></div></div>
    </div>
    <!--part 3-->
    <div style="margin-top: 30px;">
        <span id="fontchu">Votre facture en détail</span>
        <div id="tieude"><span>Mode de paiement</span></div>
        <div id="tieude1">
            <div style="padding: 20px 20px 20px 20px;"><?php
                if ($check == 1)
                {
                    ?>
                    <input type="checkbox" name="QPL1" value="QPL-ON" readonly="readonly" checked="checked" disabled="disabled"> Chèque<br><br>       
                    <input type="checkbox" name="QPL" value="QPL-ON" readonly="readonly"  disabled="disabled"> Carte de crédit<br>
                    <?php
                } else
                {
                    ?>
                    <input type="checkbox" name="QPL1" value="QPL-ON" readonly="readonly" disabled="disabled"> Chèque<br><br>       
                    <input type="checkbox" name="QPL" value="QPL-ON" readonly="readonly" checked="checked" disabled="disabled"> Carte de crédit<br>            
                <?php } ?></div>
        </div>
    </div>
    <!--part 4-->
    <div>
        <div id="denation">
            <div id="dena_1" style=" margin-left: 5px;">Désignation</div>
            <div id="dena_2">Quantité</div>
            <div id="dena_3">Total HT</div>
        </div>
        <div id="denation1">
            <div id="dena_11">
                <p style=" font-size: 17px; margin-left: 5px;">Abonnement Premium :</p> 
                <?php
                if ($nbs > 1)
                {
                    ?>
                    <p style=" font-size: 12px; margin-left: 5px;">Diffusion de votre annonce pour une durée de <?php echo $nbm ?> mois</p>
                    <?php
                } else
                {
                    ?>
                    <p style=" font-size: 12px; margin-left: 5px;">Diffusion de votre annonce pour une durée d'une semaine</p>
                <?php }
                ?>
            </div>
            <div id="dena_22"><p>1</p></div>
            <div id="dena_33"><p><?php echo $totalht . ' €'; ?></p></div>
        </div>
    </div>
    <!--part 5-->

    <div id="denation2">

        <div id="dena_2bt">
            <div>Total H.T</div>
            <div>T.V.A. (19,6%)</div>
        </div>
        <div id="dena_3ct">
            <div><?php echo $totalht . ' €' ?></div>
            <div><?php echo $tva . ' €' ?></div>
        </div>
        <div id="denation2b3c">
            <div id="dena_2b">Total T.T.C.</div>
            <div id="dena_3c"><?php echo $pttc . ' €' ?></div>
        </div>   
    </div>
</div>