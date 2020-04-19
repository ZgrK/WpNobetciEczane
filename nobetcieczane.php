<?php
/**
 * Plugin Name: Wordpress Nöbetci Eczane 
 * Plugin URI: https://www.wordpressyardim.com/eklentiler/nobetci-eczane
 * Description: Bu eklenti ile nöbetci eczaneleri sitenizde gösterebilirsiniz.
 * Version: 0.0.1
 * Author: Wordpress Yardım
 * Author URI: https://www.wordpressyardim.com
 */
require __DIR__ . '/eczane.class.php';


function nobetci_eczaneleri_getir( $atts = array() ) {
  
    // set up default parameters
    extract(shortcode_atts(array(
     'il' => 'ankara'
    ), $atts));
 
    foreach (NobetciEczane::Find($il) as $eczane) {

        echo "<hr>";
        echo "<div class='eczane'>";
        echo "<div class='ecnaneAdi'><h4>".$eczane['name']."<h4></div>";
        echo "<div class='ecnaneAdresi'><strong>Adres :</strong>".$eczane['address']."</div>";
        for ($i=0; $i < (strlen($eczane['phone'])/11) ; $i++) { 
            echo "<div class='ecnanePhone'><strong>Telefon :</strong>";
            $telefonNumara = substr($eczane['phone'], 0+(11*$i), 11+(11*$i));
            echo "<a href=+9".$telefonNumara.">".$telefonNumara."</a>";
            echo "</div>";
        } 
        echo "</div>";
        echo "<hr>";
    }
   
}


add_shortcode('nobetciEczane', 'nobetci_eczaneleri_getir');
