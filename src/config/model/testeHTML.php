<?php
    include_once 'classTask.php';
    $classTask = new Task();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ambiente teste</title>
</head>
<body>
    <h1>Olá, seja bem-vindo ao teste de classe Task!</h1>
    <br>

    <h3>Editar Tarefas</h3>
    <?php foreach($classTask->getAllTasks() as $task): ?>
        <form method="POST">
            <strong>ID: </strong>
            <input type="number" name="id" value="<?= $task['id']; ?>" readonly>
            <br>

            <strong>Nome: </strong>
            <input type="text" name="nome" value="<?= $task['nome']; ?>" readonly>
            <br>

            <strong>Descrição: </strong>
            <input type="text" name="desc" value="<?= $task['descricao']; ?>" readonly>
            <br>

            <label for="status"><strong>status:</strong></label>
            <select id="status" name="status" disabled>
                <option value="<?= $task['status'] ?>"><?= $task['status'] ?></option>
                <option value="pendente">Pendente</option>
                <option value="andamento">Andamento</option>
                <option value="finalizado">Finalizado</option>
            </select>
            <br>

            <button type="button" id="editTask" name="editTask" value="<?= $task['id']; ?>">Editar Tarefa</button>
            <button type="button" id="delete" name="delete" value="<?= $task['id']; ?>">Deletar Tarefa</button>
        </form>
        <p>============================================</p>
    <?php endforeach;?>

    <br><br><br><br><br><br>

    <h3>Lista de Tarefas</h3>
    <label for="filtroStatus">Selecione o status</label>
    <select id="filtroStatus" name="status">
        <option value="">Todos</option>
        <option value="pendente">Pendente</option>
        <option value="andamento">Em andamento</option>
        <option value="finalizado">Finalizado</option>
    </select>
    <div id="listaTarefas"></div>

    <br><br><br><br><br><br>


    <h3>Lista de Tarefas Pendente</h3>
    <?php foreach($classTask->getAllTasks() as $task){
        if($task['status'] == 'pendente'){
            echo "<strong>ID:</strong> " . $task['id'] ;
            echo "<br>";
            echo "<strong>Nome:</strong> " . $task['nome'];
            echo "<br>";
            echo "<strong>descrição:</strong> " . $task['status'];
            echo "<br>";
            echo "- - - - - - - - - - - - - - - - - -";
            echo "<br>";
        }
    }
    ?>

    <br>
    <h3>Lista de Tarefas Andamento</h3>
    <?php foreach($classTask->getAllTasks() as $task){
        if($task['status'] == 'andamento'){
            echo "<strong>ID:</strong> " . $task['id'] ;
            echo "<br>";
            echo "<strong>Nome:</strong> " . $task['nome'];
            echo "<br>";
            echo "<strong>descrição:</strong> " . $task['status'];
            echo "<br>";
            echo "- - - - - - - - - - - - - - - - - -";
            echo "<br>";
        }
    }
    ?>

    <br>
    <h3>Lista de Tarefas Finalizado</h3>
    <?php foreach($classTask->getAllTasks() as $task){
        if($task['status'] == 'finalizado'){
            echo "<strong>ID:</strong> " . $task['id'] ;
            echo "<br>";
            echo "<strong>Nome:</strong> " . $task['nome'];
            echo "<br>";
            echo "<strong>descrição:</strong> " . $task['status'];
            echo "<br>";
            echo "- - - - - - - - - - - - - - - - - -";
            echo "<br>";
        }
    }
    ?>


    <script>
        // PEga os botoes dos formualrios Edita tarfas
        const botoes = document.querySelectorAll('[name="editTask"]');  
        botoes.forEach((botao) => {
            // Serve pra saber se está sendo editado ou não | "false" = modo edição & "true" = editando e pode salvar
            botao.dataset.editando = "false";

            botao.addEventListener('click', async () => {
                const formulario = botao.closest('form'); // Pega o elemento 'form' mais proximo | ou seja, pega o formualario especiico
                const camposForm = formulario.querySelectorAll('[name]'); // pega todos os atributos 'name' do formulario
                
                // Alteração dos campos
                if(botao.dataset.editando === "false"){
                    camposForm.forEach((campo) => {
                        if(campo.tagName === 'SELECT'){
                            campo.disabled = !campo.disabled;
                            botao.textContent = "Salvar Edição";
                        } else{
                            campo.readOnly = !campo.readOnly;
                        }
                    });
                    botao.dataset.editando = "true";
                }else{
                    // Criação de um fetch de formulario para envio de dados alterados
                    const data = new FormData(formulario);
                    const response = await fetch('/src/config/service/serviceTask.php', {
                        method: formulario.method,
                        body: data
                    });

                    // fins debugativos
                    // console.log(response.status);
                    // console.log(await response.text());
                    // console.log([...data.entries()]);

                    // ALteração dos campos 
                    camposForm.forEach((campo) => {
                        if(campo.tagName === 'SELECT'){
                            campo.disabled = !campo.disabled;
                            botao.textContent = "Editar Tarefa";
                        } else{
                            campo.readOnly = !campo.readOnly;
                        }
                    });
                    botao.dataset.editando = "false";
                }
            });
        });

        const botoesDelete = document.querySelectorAll('[name="delete"]');      
        botoesDelete.forEach((botao) =>{
            botao.addEventListener('click', async () => {
                const formulario = botao.closest('form');

                const confirmarExclusao = confirm("Tem certeza que deseja deletar esta tarefa?");

                if(confirmarExclusao === true){
                    const data = new FormData(formulario);
                    data.append('delete', botao.value);

                    // console.log(formulario.method);
                    // console.log(data.get('id'));
                    // console.log(data.get('delete'));

                    const response = await fetch('/src/config/service/serviceTask.php', {
                        method: formulario.method,
                        body: data
                    });

                    const resposta = await response.json();
                    console.log(resposta['message']);
                }
            });
        });

        // Pega o Select
        const filtroStatus = document.querySelector('#filtroStatus');
        // Captura a opção seleciona
        filtroStatus.addEventListener('change', async () => {
            const status = filtroStatus.value; // salva a captura

            // fins debugativos
            // console.log('Status selecionado: ', status);

            const response = await fetch('/src/config/service/serviceTask.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({status: status})
            });

            // fins debugativos
            // console.log(response.status);

            // Lista as tareas inserindo no 'listaTarefas' criando-as
            const listaTarefa = document.getElementById('listaTarefas');
            listaTarefa.innerHTML = '';
            const tarefas = await response.json();
            tarefas.forEach((tarefa) => {
                const item = document.createElement('div');
                item.innerHTML = `
                    <strong>ID: </strong> ${tarefa.id} 
                    <br>
                    <strong>Nome: </strong> ${tarefa.nome}
                    <br>
                    <strong>Descrição: </strong> ${tarefa.descricao}
                    <br>
                    <strong>Status: </strong> ${tarefa.status}
                    <br>
                    <p> ================================== </p>
                    <br>
                `;
                listaTarefa.appendChild(item);
            });

        });
    </script>
</body>
</html>