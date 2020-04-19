<?php
/**
 * Plugin Name: Nöbetci Eczane 
 * Plugin URI: https://www.wordpressyardim.com/eklentiler/nobetci-eczane
 * Description: Bu eklenti ile nöbetci eczaneleri sitenizde gösterebilirsiniz.
 * Version: 0.0.1
 * Author: Wordpress Yardım
 * Author URI: https://www.wordpressyardim.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: nobetci-eczane
 */
require __DIR__ . '/eczane.class.php';

function turkcetarih_formati($format, $datetime = 'now'){
    $z = date("$format", strtotime($datetime));
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}



function nobetci_eczaneleri_getir( $atts = array() ) {
  
    // set up default parameters
    extract(shortcode_atts(array(
     'il' => 'ankara'
    ), $atts));
    echo "<div class='baslik-eczane-genel'<center> <h1>".turkcetarih_formati('j F Y l')." ".$il." Nöbetçi Eczaneleri</h1></center></div>";
 
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
