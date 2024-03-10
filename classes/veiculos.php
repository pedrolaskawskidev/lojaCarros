<?php


class Veiculos
{
    private $conexao;

    public function __construct()
    {
        $db = new Database();
        $this->conexao = $db->getConexao();
    }

    public function todasMarcas()
    {
        $sqlVeiculos = "SELECT * FROM marca_veiculos";
        $stmt = $this->conexao->prepare($sqlVeiculos);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function todosVeiculos()
    {
        $sqlVeiculos = "SELECT * FROM marca_veiculos mav INNER JOIN modelo_veiculos mov on mav.id = mov.marca_modelo ORDER BY nome_modelo ASC";
        $stmt = $this->conexao->prepare($sqlVeiculos);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selecionaVeiculo($id)
    {
        $sqlVeiculos = "SELECT mov.* FROM modelo_veiculos mov 
        INNER JOIN marca_veiculos mav on mov.marca_modelo = mav.id
        WHERE mov.id = :id";

        $stmt = $this->conexao->prepare($sqlVeiculos);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarVeiculo($id, $dados)
    {

        $sqlVeiculos = "UPDATE modelo_veiculos SET 
                      nome_modelo = :nome_modelo,
                      ano_modelo = :ano_modelo,
                      marca_modelo = :marca_modelo,
                      valor_modelo = :valor_modelo
                      WHERE id = :id";

        $stmt = $this->conexao->prepare($sqlVeiculos);

        $stmt->bindParam(':nome_modelo', $dados['nome_modelo'], PDO::PARAM_STR);
        $stmt->bindParam(':ano_modelo', $dados['ano_modelo'], PDO::PARAM_INT);
        $stmt->bindParam(':marca_modelo', $dados['marca_modelo'], PDO::PARAM_STR);
        $stmt->bindParam(':valor_modelo', $dados['valor_modelo'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function criaVeiculo($dadosVeiculo)
    {

        try {
            
            $this->conexao->beginTransaction();
            
            $sql = "INSERT INTO modelo_veiculos (nome_modelo, ano_modelo, valor_modelo, marca_modelo)
            VALUES (:nome_modelo, :ano_modelo, :valor_modelo, :marca_modelo)";
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':nome_modelo', $dadosVeiculo['nome_modelo']);
            $stmt->bindParam(':ano_modelo', $dadosVeiculo['ano_modelo']);
            $stmt->bindParam(':valor_modelo', $dadosVeiculo['valor_modelo']);
            $stmt->bindParam(':marca_modelo', $dadosVeiculo['marca_modelo']);
            $stmt->execute();

            $this->conexao->commit();
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao criar veículo: " . $e->getMessage());
        }
    }

    public function excluirVeiculo($id){
        try {
            
            $this->conexao->beginTransaction();

            $sqlExcluir = "DELETE FROM modelo_veiculos WHERE id = :id";
            $stmt = $this->conexao->prepare($sqlExcluir);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->conexao->commit();
            
            return true; 
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao excluir veículo: " . $e->getMessage());
        }
    }
}
