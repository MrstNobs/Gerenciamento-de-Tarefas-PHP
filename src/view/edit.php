<?php 
    include_once __DIR__ . '/../config/model/classTask.php';
    $task = null;
    if(isset($_GET['editar'])){
        $taskID = $_GET['editar'];
        $classTask = new Task();
        $task = $classTask->getTask($taskID);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <h1>Editar Tarefa</h1>

        <div class="form">
            <form action="/src/config/service/serviceTask.php" method="POST">
                <input type="hidden" name="id" value="<?= $task['id']; ?>">

                <label for="taskName">Nome da Tarefa</label>
                <input type="text" name="taskName" id="taskName" placeholder="tarefa" value="<?= $task['nome']; ?>" required >

                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="5" placeholder="descrição" required><?= $task['descricao']; ?></textarea>

                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="<?= $task['status']; ?>"> <?= $task['status']; ?> </option>
                    <option value="pendente">Pendente</option>
                    <option value="andamento">Em andamento</option>
                    <option value="finalizado">Finalizado</option>
                </select>

                <div class="bts">
                    <button type="submit" name="button" value="editTask">Salvar Alterações</button>
                    <a href="index.php" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>