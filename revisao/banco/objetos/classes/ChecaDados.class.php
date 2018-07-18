<pre>
<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';
require_once 'classes/Poupanca.class.php';
require_once 'classes/Acoes.class.php';
require_once 'classes/BancoDB.class.php';

    class ChecaDados{

        public function validaCpf($cpfCliente) {
            //$cpf = "696.284.592-87";
            if (!is_numeric($cpfCliente)) {
                throw new Exception("O valor não é um NÚMERO");
            } else 
                if (preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/", $cpfCliente)){
                    return true;
            } else {
                throw new Exception("Número diferente de cpf");
            }

            // if (preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/", $cpfCliente)){
            //     return true;
            // } else {
            //     return false;
            // }
        }

    }


//var_dump($banco->listaTodas());

//var_dump($banco->obterContaCliente('6681-8'));
//var_dump($banco->obterNomeCliente('Carla Falcão'));



?>
</pre>