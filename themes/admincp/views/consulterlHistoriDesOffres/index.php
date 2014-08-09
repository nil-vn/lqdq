<br>
<?php
if (!empty($demarchage))
{
    echo '<p align="center"><strong>HISTORIQUE DES DECALAGES ENVOI OFFRES</p>';
    ?>
    <table align="center">
        <?php
        foreach ($demarchage as $value)
        {
            echo "<tr><td>Démarchage décalé de " . $value->decalage . " jours le " . $value->date_action . "</td></tr>";
        }
        ?>	
        <tr class="deactivatedeca"></tr>
    </table>      
<?php } ?>
<br>
<br>
<?php
if (!empty($desage))
{
    echo '<p align="center"><strong>HISTORIQUE SUR LA SOUSCRIPTION DES OFFRES PROMO</p>';
    ?>
    <table align="center"> 
        <?php
        foreach ($desage as $value)
        {
            $m = DemarchageOption::model()->findByAttributes(array('num_demarchage' => $value['num_demarchage']));
            $m1 = $m->titre;
            echo "<tr><td>" . $m1 . "<span style='font-weight:normal;'> souscrit le </span>" . $value['date_creation'] . " </td></tr>";

            $date = date_create($value['date_creation']);
            date_add($date, date_interval_create_from_date_string('1 days'));


            if ($value['date_creation'] > date('Y-m-d H:i:s'))
            {
                echo "<tr><td>En cours -> échéance de l'offre le" . date_format($date, 'Y-m-d H:i:s') . "</td></tr>";
            } else
            {
                echo "<tr><td><span style='color:red;'>Terminé le " . date_format($date, 'Y-m-d H:i:s') . "</span></td></tr>";
            }
        }
        ?>	

    </table>
    <?php
} else
{
    echo '<p align="center"><strong>CE CLIENT N\'A SOUSCRIT A AUCUNE OFFRE PROMO</p>';
}
/* -------------------------------------------------------------- */
?>
<br>
<br>
<br>
<?php
if (!empty($desagelog))
{
    echo '<p align="center"><strong>HISTORIQUE DES ENVOIS D\'OFFRES PROMO</p>';
    ?>
    <table align="center"> 
        <?php
        foreach ($desagelog as $value)
        {
            $m = DemarchageOption::model()->findByAttributes(array('num_demarchage' => $value['numero_demarchage']));
            $m1 = $m->titre;
            echo "<tr><td><span style='font-weight:normal;'>le </span>" . $value['date_demarchage'] . "<span style='font-weight:normal;'>-> Offre </span>" . $m1 . " </td></tr>";
        }
        ?>	

    </table>
    <?php
} else
{
    echo '<p align="center"><strong>AUCUN HISTORIQUE CONCERNANT L\'ENVOI DES OFFRES PROMO</strong></p>';
}
?>


