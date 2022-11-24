<?php

class daoMysql {
    public $conexao;

    public function __construct($driver)
    {
        $this->conexao = $driver;
    }

    public function cadastrarForm($array){
        print_r($array);

        $sql = $this->conexao->prepare('
        INSERT INTO edu_form.contatos(nome, idade, email, senha, data, cor, sexo, intereresse, nivel, regiao, msg, foto) 
        VALUES (:nome, :idade, :email, :senha, :data, :cor, :sexo, :intereresse, :nivel, :regiao, :msg, :foto)
        ');

        $interesse = '';
        for($i = 0; $i < count($array['interesse']); $i++){
            $interesse = $interesse.','.$array['interesse'][$i];
        }

        
        $sql->bindParam(':nome', $array['nome']);
        $sql->bindParam(':idade', $array['idade']);
        $sql->bindParam(':email', $array['email']);
        $sql->bindParam(':senha', $array['senha']);
        $sql->bindParam(':data', $array['date']);
        $sql->bindParam(':cor', $array['cor']);
        $sql->bindParam(':sexo', $array['sexo']);
        $sql->bindParam(':intereresse', $interesse);
        $sql->bindParam(':nivel', $array['nivel']);
        $sql->bindParam(':regiao', $array['regiao']);
        $sql->bindParam(':msg', $array['msg']);
        $sql->bindParam(':foto', $array['foto']);
        $sql->execute();

        $resultado = $sql->rowCount();

        if ( $resultado > 0 ) {
            return true;
            
        } else {
            return false;
        }
    }
}