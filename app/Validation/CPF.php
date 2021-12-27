<?php

namespace App\Validation;

class CPF{

    /**
     * Método para validar o cpf
     *
     * @param string $cpf
     * @return boolean
     */
    public static function validar($cpf){
        //vai retirar todos os caracteres especiais e vai deixar somente números
        $cpf = preg_replace('/\D/','',$cpf);
        
        //vai verificar se foi passado todos os 11 números que compõe um cpf
        if(strlen($cpf) != 11){
            return false;
        }
        //Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        //vai pegar somente os 9 números do cpf
        $cpfValidacao = substr($cpf,0,9);
        
        //vai calcular e retornar o primeiro dígito validor
        $cpfValidacao .= self::calcularDigitorValidor($cpfValidacao);
        //vai calcular e retornar o segundo dígito validor
        $cpfValidacao .= self::calcularDigitorValidor($cpfValidacao);

        

        
        return $cpfValidacao == $cpf;
    }

    /**
     * Método responsavel pelo calculo
     *
     * @param string $base
     * @return int
     */
    public static function calcularDigitorValidor($base){
        //Pega o tamanho do cpf
        $tamanho = strlen($base);
        $multiplicador = $tamanho + 1;

        $soma = 0;

        //Faz o calculo para validar o CPF
        for($i = 0; $i < $tamanho; $i++){
            $soma += $base[$i] * $multiplicador;
            $multiplicador --;
            
        }
       
        $resto = ($soma * 10) % 11;
       
        
        //Se o resto da divisão for igual a 10, nós o consideramos como 0
        if($resto == 10){
            $resto = 0;
        }

        return $resto;
    }

    
}



