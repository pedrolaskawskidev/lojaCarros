<?php

define('HOST', '');
define('USER', '');
define('PASS', '');
define('DATABASE', '');

class Database {
    private $host;
    private $usuario;
    private $senha;
    private $banco;
    private $conexao;

    public function __construct() {
        $this->host = HOST;
        $this->usuario = USER;
        $this->senha = PASS;
        $this->banco = DATABASE;

        try {
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->banco}", $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConexao() {
        return $this->conexao;
    }
}
?>
