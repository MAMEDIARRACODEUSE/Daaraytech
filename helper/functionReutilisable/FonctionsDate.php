<?php 

    $format = "Y-m-d";
        
    function createDate($chaine, $format = "Y-m-d"){
        return date_create_from_format($format,$chaine);
    } 
        
    // rerourner une chaine de caractere a partir d'un format date
    function formatDate($date, $format = "Y-m-d"){
        return date_format($date,$format);
    } 
        
    // teste si une Heure est valide    
    function heureValide($heure){
        return preg_match("/^(([01][0-9])|(2[0-3])):[0-5][0-9]$/",$heure);
    } 

    
    // teste si une date est anterieur à la date courante
    function dateAnterieur($date, $format = "Y-m-d"){
        $d = createDate($date, $format);
        $d1 = new DateTime("now");
        return ($d <= $d1);
    }

    // Retourne le nombres de minutes entre deux Heures
    function nombresMinutes($heure_debut, $heureFin) : int{
        $nbHeure = 0;
        $nbMn = 0;
        if(heureValide($heure_debut) && heureValide($heureFin)){
            $array1 = explode(":",$heure_debut);
            $array2 = explode(":",$heureFin);
            $nbHeure = $array2[0] - $array1[0];
            $nbMn = $array2[1] - $array1[1];
            if($array1[0] > $array2[0]){
                $nbHeure = (24 - $array1[0]) + $array2[0];
            }
            if($array1[1] > $array2[1]){
                $nbHeure = $nbHeure==1 ? 0 : $nbHeure;
                $nbMn = (60 - $array1[1]) + $array2[1];
            }
        } else {
            return -1;
        }
        return $nbHeure*60+$nbMn;
    }
?>