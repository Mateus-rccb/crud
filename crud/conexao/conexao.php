<?php

class UsuarioDAO {
    private $conexao; // Armazena a conexão com o banco de dados

    // Construtor que recebe a conexão com o banco de dados
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    // Método para criar um novo usuário no banco de dados
    public function create(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (nome, sobrenome, idade, sexo)
                    VALUES (:nome, :sobrenome, :idade, :sexo)";

            // Preparação da query SQL
            $p_sql = $this->conexao->prepare($sql);

            // Vincula os valores dos parâmetros
            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":sobrenome", $usuario->getSobrenome());
            $p_sql->bindValue(":idade", $usuario->getIdade());
            $p_sql->bindValue(":sexo", $usuario->getSexo());

            // Executa a inserção e retorna o resultado
            $result = $p_sql->execute();

            // Lança uma exceção em caso de falha na inserção
            if (!$result) {
                throw new Exception("Erro ao inserir um usuário.");
            }

            return $result;
        } catch (Exception $e) {
            // Captura e relança uma exceção com mensagem mais descritiva
            throw new Exception("Erro ao inserir um usuário: " . $e->getMessage());
        }
    }

    // Método para ler todos os usuários do banco de dados
    public function read() {
        try {
            $sql = "SELECT * FROM usuario ORDER BY nome ASC";

            // Preparação da query SQL
            $p_sql = $this->conexao->prepare($sql);
            $p_sql->execute();

            // Retorna todos os usuários em um array associativo
            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Captura e relança uma exceção com mensagem mais descritiva
            throw new Exception("Erro ao ler os usuários: " . $e->getMessage());
        }
    }
}

?>
