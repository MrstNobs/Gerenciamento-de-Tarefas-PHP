<?php 
    session_start();
    include_once __DIR__ . '/../config/model/classTask.php';
    $TaskClass = new Task();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Tarefas</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="main">

        <!-- Mini pop up -->
        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert-success">
                <p><?php echo $_SESSION['message']; ?></p>
            </div>
        <?php unset($_SESSION['message']); endif; ?>

        <!-- formulario -->
        <h1>Gerenciamento de Tarefas</h1>
        <div class="form">
            <form action="/src/config/service/serviceTask.php" method="POST">
                <label for="taskName">Nome da Tarefa</label> <br>
                <input type="text" name="taskName" id="taskName" placeholder="tarefa" required>
                
                <br>

                <label for="description">Descrição</label> <br>
                <input type="text" name="description" id="description" placeholder="descrição" required>

                <br>
                <button type="submit" name="button" value="addTask">Adicionar Tarefa</button>
            </form>
        </div>

        <!-- Tarefas -->
        <div class="cards">
            <div class="coluna">
                <h2 class="coluna-titulo pendente">Pendente</h2>
                <?php foreach($TaskClass->getAllTasks() as $task): ?>
                    <?php if($task['status'] === 'pendente'): ?>
                        <form action="/src/config/service/serviceTask.php" method="POST">
                            <div class="card pendente">
                                <div class="card-head">
                                    <p><span><?php echo $task['nome']; ?></span></p>
                                    <p> Status: <?php echo $task['status']; ?> </p>
                                </div>
                                <div class="card-desc">
                                    <p><?php echo $task['descricao'] ?></p>
                                </div>
                                <div class="bts">
                                    <a href="./edit.php?editar=<?= $task['id']; ?>" class="btn-editar" >Editar</a>
                                    <input type="hidden" name="id" value="<?= $task['id']; ?>">
                                    <button type="submit" class="btn-excluir" name="delete" id="delete" value="<?= $task['id']; ?>"> Excluir </button>
                                </div>
                            </div>
                        </form> 
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
                        
            <div class="coluna">
                <h2 class="coluna-titulo andamento">Andamento</h2>
                <?php foreach($TaskClass->getAllTasks() as $task): ?>
                    <?php if($task['status'] === 'andamento'): ?>
                        <form action="/src/config/service/serviceTask.php" method="POST">
                            <div class="card andamento">
                                <div class="card-head">
                                    <p><span><?php echo $task['nome']; ?></span></p>
                                    <p> Status: <?php echo $task['status']; ?> </p>
                                </div>
                                <div class="card-desc">
                                    <p><?php echo $task['descricao'] ?></p>
                                </div>
                                <div class="bts">
                                    <a href="./edit.php?editar=<?= $task['id']; ?>" class="btn-editar" >Editar</a>
                                    <input type="hidden" name="id" value="<?= $task['id']; ?>">
                                    <button type="submit" class="btn-excluir" name="delete" id="delete" value="<?= $task['id']; ?>" > Excluir </button>
                                </div>
                            </div>
                        </form> 
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
                        
            <div class="coluna">
                <h2 class="coluna-titulo finalizado">Finalizado</h2>
                <?php foreach($TaskClass->getAllTasks() as $task): ?>
                    <?php if($task['status'] === 'finalizado'): ?>
                        <form action="/src/config/service/serviceTask.php" method="POST">
                            <div class="card finalizado">
                                <div class="card-head">
                                    <p><span><?php echo $task['nome']; ?></span></p>
                                    <p> Status: <?php echo $task['status']; ?> </p>
                                </div>
                                <div class="card-desc">
                                    <p><?php echo $task['descricao'] ?></p>
                                </div>
                                <div class="bts">
                                    <a href="./edit.php?editar=<?= $task['id']; ?>" class="btn-editar" >Editar</a>
                                    <input type="hidden" name="id" value="<?= $task['id']; ?>">
                                    <button type="submit" class="btn-excluir" name="delete" id="delete" value="<?= $task['id']; ?>" > Excluir </button>
                                </div>
                            </div>
                        </form> 
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
                        
        </div> 
    </div>

    <!-- PoP Up | Modal -->
    <dialog id="modal-confirmar" class="modal">
        <div class="modal-icone">!</div>
        <h3>Excluir tarefa?</h3>
        <p>Essa ação não pode ser desfeita.</p>
        <div class="modal-botoes">
            <button type="button" class="modal-cancelar">Cancelar</button>
            <button type="button" class="modal-confirmar">Sim, excluir</button>
        </div>
    </dialog>
</body>
</html>