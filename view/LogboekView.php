<?php
    // require_once 'view/compleetLogboek.php';

    class LogboekView {
        public function __construct(){
        }

        public function __destruct(){   
        }

        function toon_logboek_dagen($logboekId) {
            // toon alle logboekdagen
            $logboekModel = new LogboekModel();
            $logboekdagen = $logboekModel->logboekDagen_ophalen($logboekId);

            $aantalDagen = 1;

            foreach($logboekdagen as $logboekdag) {
                $datum = strtotime($logboekdag->dag);
                $dag = date('d-m-Y', $datum);
                $wijzig = "<a href='" . SERVER_URL . "/LogboekController/bewerkDag/" . $logboekdag->id . "'>wijzig</a>";
                if($logboekdag->ingediend){
                    $ingediend = "Ingediend";
                } else {
                    $ingediend = "<a href='" . SERVER_URL . "/LogboekController/indienDag/" . $logboekdag->id . "'>Indienen</a>";
                }
                echo "<div class='logboekDag'><div class='logboekDag_dag'>$dag</div><div class='logboekDag_beschrijving'>$logboekdag->beschrijving_werkzaamheden</div><div class='logboekDag_urenGewerkt'>Uren gewerkt: $logboekdag->uur_gewerkt</div><div class='logboekDag_urenIngediend'>$ingediend</div><div class='logboekDag_wijzig'>$wijzig</div></div>";
               
                $check = $aantalDagen % 7;
                if(!$check) {
                    echo "<a href='" . SERVER_URL . "/LogboekController/indienDagen/" . $logboekdag->id . "'>Dien alle dagen met ingvulde uren in voor deze week</a>";;
                    echo "<br/><hr/>";
                }
                $aantalDagen++;
            }
        }
}