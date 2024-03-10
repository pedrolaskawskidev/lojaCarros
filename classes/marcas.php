<?php


class Marcas
{
    private $conexao;

    public function __construct()
    {
        $db = new Database();
        $this->conexao = $db->getConexao();
    }

    public function todasMarcas()
    {
        $sqlMarcas = "SELECT * FROM marca_veiculos";
        $stmt = $this->conexao->prepare($sqlMarcas);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selecionaMarca($id)
    {
        $sqlMarcas = "SELECT mav.* FROM marca_veiculos mav  WHERE mav.id = :id";

        $stmt = $this->conexao->prepare($sqlMarcas);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarMarca($id, $dados)
    {

        $sqlMarcas = "UPDATE marca_veiculos SET 
                      nome = :nome
                      WHERE id = :id";

        $stmt = $this->conexao->prepare($sqlMarcas);

        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function criaMarca($dadosMarca)
    {

        try {
            
            $this->conexao->beginTransaction();
            
            $sql = "INSERT INTO marca_veiculos (nome)
            VALUES (:nome)";
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':nome', $dadosMarca['nome']);
            $stmt->execute();

            $this->conexao->commit();
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao criar marca: " . $e->getMessage());
        }
    }

    public function excluirMarca($id){
        try {
            
            $this->conexao->beginTransaction();

            $sqlExcluir = "DELETE FROM marca_veiculos WHERE id = :id";
            $stmt = $this->conexao->prepare($sqlExcluir);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->conexao->commit();
            
            return true; 
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao excluir marca: " . $e->getMessage());
        }
    }

}