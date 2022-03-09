<?php
    class Diena{
        public static function numToName(int $dienaNr){
            switch($dienaNr){
                case 1:
                    return "Pirmdiena";
                break;
                    
                case 2:
                    return "Otrdiena";
                break;
                    
                case 3:
                    return "Trešdiena";
                break;
                    
                case 4:
                    return "Ceturtdiena";
                break;
                    
                case 5:
                    return "Piektdiena";
                break;
                    
                default:
                    return null;
                break;
            }
        }
        
        public static function nameToNum($diena):int{
            switch($diena){
                case "Pirmdiena":
                    return 1;
                break;
                    
                case "Otrdiena":
                    return 2;
                break;
                    
                case "Trešdiena":
                    return 3;
                break;
                    
                case "Ceturtdiena":
                    return 4;
                break;
                    
                case "Piektdiena":
                    return 5;
                break;
                    
                default:
                    return 0;
                break;
            }
        }
    }
?>