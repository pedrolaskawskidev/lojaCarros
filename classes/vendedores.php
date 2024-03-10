<?php


class Vendedores
{
    private $conexao;

    public function __construct()
    {
        $db = new Database();
        $this->conexao = $db->getConexao();
    }

    public function todosVendedores()
    {
        $sqlVendedores = "SELECT * FROM vendedores";
        $stmt = $this->conexao->prepare($sqlVendedores);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selecionaVendedor($id)
    {
        $sqlVendedores = "SELECT * FROM vendedores WHERE id = :id";

        $stmt = $this->conexao->prepare($sqlVendedores);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarVendedor($id, $dados)
    {
        $sqlVendedores = "UPDATE vendedores SET 
                      nome = :nome,
                      email = :email    
                      WHERE id = :id";

        $stmt = $this->conexao->prepare($sqlVendedores);

        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function criaVendedor($dadosVendedor)
    {

        try {
            
            $this->conexao->beginTransaction();
            
            $sql = "INSERT INTO vendedores (nome, email)
            VALUES (:nome, :email)";
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':nome', $dadosVendedor['nome']);
            $stmt->bindParam(':email', $dadosVendedor['email']);
            $stmt->execute();

            $this->conexao->commit();
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao criar vendedor: " . $e->getMessage());
        }
    }

    public function excluirVendedor($id){
        try {
            
            $this->conexao->beginTransaction();

            $sqlExcluir = "DELETE FROM vendedores WHERE id = :id";
            $stmt = $this->conexao->prepare($sqlExcluir);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->conexao->commit();
            
            return true; 
        } catch (PDOException $e) {
            $this->conexao->rollBack();
            throw new Exception("Erro ao excluir vendedor: " . $e->getMessage());
        }
    }
}
