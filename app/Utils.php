<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Utils
 *
 * @author atxal
 */
class Utils {

    //put your code here
    public static function moedaToDB($get_valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
    
    public static function dbToMoeda($valor){
        return number_format($valor, 2, ',', '.');
    }
            
}
