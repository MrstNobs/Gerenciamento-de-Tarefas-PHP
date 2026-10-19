<?php 
    include_once __DIR__ . '/../conn.php';

    class Task{
        public function createTask($nameTask, $description, $status){
            try{
                $pdo = Conn::getConn();

                $sql = "INSERT INTO tarefas (nome, descricao, status) VALUES (:nome, :descricao, :status)";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':nome', $nameTask);
                $stmt->bindParam(':descricao', $description);
                $stmt->bindParam(':status', $status);

                $stmt->execute();

                return json_encode(["message" => "Tarefa criada com sucesso."]);
            } catch(Exception $e) {
                error_log("\n"."Erro ao criar tarefa: ".$e->getMessage()."\n");
                return json_encode(["message" => "Erro ao criar tarefa."]);
            }
        }
        public function getTask($id){
            try{
                $pdo = Conn::getConn();

                $sql = "SELECT * FROM tarefas WHERE id = :id";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':id', $id);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                error_log("\n"."Erro ao buscar tarefa: ".$e->getMessage()."\n");
                return json_encode(["message" => "Erro ao buscar tarefa."]);
            }
        }
        public function updateTask($id, $nameTask, $description, $status){
            try{
                $pdo = Conn::getConn();

                $sql = "UPDATE tarefas SET nome = :nome, descricao = :descricao, status = :status WHERE id = :id";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nome', $nameTask);
                $stmt->bindParam(':descricao', $description);
                $stmt->bindParam(':status', $status);

                $stmt->execute();

                return json_encode(["message" => "Tarefa atualizada com sucesso."]);
            }catch(Exception $e){
                error_log("\n"."Erro ao atualizar tarefa: ".$e->getMessage()."\n");
                return json_encode(["message" => "Erro ao atualizar tarefa."]);
            }
        }
        public function deleteTask($id){
            try{
                $pdo = Conn::getConn();

                $sql = "DELETE FROM tarefas WHERE id = :id";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':id', $id);

                $stmt->execute();

                return json_encode(["message" => "Tarefa deletada com sucesso."]);
            }catch(Exception $e){
                error_log("\n"."Erro ao deletar tarefa: ".$e->getMessage()."\n");
                return json_encode(["message" => "Erro ao deletar tarefa."]);
            }
        }
        public function getAllTasks(){
            try{
                $pdo = Conn::getConn();

                $sql = "SELECT * FROM tarefas";
                $stmt = $pdo->prepare($sql);

                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                error_log("\n"."Erro ao buscar todas as tarefas: ".$e->getMessage()."\n");
                return json_encode(["message" => "Erro ao buscar todas as tarefas."]);
            }
        }
        public function getTaskByStatus($status){
            try{
                $pdo = Conn::getConn();

                $sql = "SELECT * FROM tarefas WHERE status = :status";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':status', $status);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }catch(Exception $e){
                error_log("\n". "Erro ao realizar a busca: " . $e->getMessage());
                return json_encode(["message" => "Erro ao realizar a busca."]);
            }
        }
    }
?>