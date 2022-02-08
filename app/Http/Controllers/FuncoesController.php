<?php

namespace App\Http\Controllers;

class FuncoesController extends Controller
{
    public static function formataData($data){
        $dia = substr($data, 8, 2);
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);

        switch($mes){
            case '01': $mes = 'janeiro'; break;
            case '02': $mes = 'fevereiro'; break;
            case '03': $mes = 'março'; break;
            case '04': $mes = 'abril'; break;
            case '05': $mes = 'maio'; break;
            case '06': $mes = 'junho'; break;
            case '07': $mes = 'julho'; break;
            case '08': $mes = 'agosto'; break;
            case '09': $mes = 'setembro'; break;
            case '10': $mes = 'outubro'; break;
            case '11': $mes = 'novembro'; break;
            case '12': $mes = 'dezembro'; break;
            default: $mes = $mes;
        }
        $data_formatada = $dia.' de '.$mes.' de '.$ano;

        return $data_formatada;
    }

    public static function generateRandomString($size){

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";         
        $randomString = '';         
        for($i = 0; $i < $size; $i = $i+1){
            $randomString .= $chars[mt_rand(0,35)];
        }
        return $randomString;

    } 

}
