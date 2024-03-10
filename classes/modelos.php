<?php


class Modelos
{
    private $conexao;

    public function __construct()
    {
        $db = new Database();
        $this->conexao = $db->getConexao();
    }

    public function todosModelos()
    {
        $sqlModelos = "SELECT * FROM modelo_veiculos";
        $stmt = $this->conexao->prepare($sqlModelos);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selecionaModelo($id)
    {
        $sqlModelos = "SELECT mov.* FROM modelo_veiculos mov WHERE mov.id = :id";

        $stmt = $this->conexao->prepare($sqlModelos);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarModelo($id, $dados)
    {

        $sqlModelos = "UPDATE modelo_veiculos SET 
                      nome_modelo = :nome_modelo,
                      ano_modelo = :ano_modelo,
                      valor_modelo = :valor_modelo
                      WHERE id = :id";

        $stmt = $this->conexao->prepare($sqlModelos);

        $stmt->bindParam(':nome_modelo', $dados['nome_modelo'], PDO::PARAM_STR);
        $stmt->bindParam(':ano_modelo', $dados['ano_modelo'], PDO::PARAM_INT);
        $stmt->bindParam(':valor_modelo', $dados['valor_modelo'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function criaModelo($dadosModelo)
    {

        try {
            
            $this->conexao->beginTransaction();
            
            $sql = "INSERT INTO modelo_veiculos (nome_modelo, ano_modelo, valor_modelo, marca_modelo)
            VALUES (:nome_modelo, :ano_modelo, :valor_modelo, :marca_modelo)";
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':nome_modelo', $dadosModelo['nome_modelo']);
            $stmt->bindParam(':ano_modelo', $dadosModelo['ano_modelo']);
            $stmt->bindParam(':valor_modelo', $dadosModelo['valor_modelo']);
            $stmt->bindParam(':marca_modelo', $dadosModelo['marca_modelo']);
            $stmt->execute();

            $this->conexao->commit();
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao criar modelo: " . $e->getMessage());
        }
    }

    public function excluirModelo($id){
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
            throw new Exception("Erro ao excluir modelo: " . $e->getMessage());
        }
    }
}
