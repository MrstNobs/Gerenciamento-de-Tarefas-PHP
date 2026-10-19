<?php
    include_once 'classTask.php';

    $classTask = new Task();


    // TESTES INDIVIDEUAIS DAS FUNÇÕES DA CLASSE TASK EM PHP

    // $TarefaCrate = $classTask->createTask("Nome Tarefa", "Descrição da tarefa", "status da terafa");
    // echo $TarefaCrate;
    
    // $TarefaGet = $classTask->getTask(1);
    // foreach($TarefaGet as $info){
    //     echo $info;
    //     echo "\n";
    // }
    
    // $Tarefas2 = $classTask->updateTask(1, "Nome Tarefa Atualizada", "Descrição da tarefa atualizada", "Atualizado");
    // echo $Tarefas2;

    
    // $x = 10;
    // while($x > 0) {
    //     $deletedTask = $classTask->deleteTask($x);
    //     echo $deletedTask;
    //     $x--;
    // }

    // $Alltasks = $classTask->getAllTasks();
    // foreach($Alltasks as $task){
    //     echo "ID: ".$task['id']."\n";
    //     echo "Nome: ".$task['nome']."\n";
    //     echo "Descrição: ".$task['descricao']."\n";
    //     echo "Status: ".$task['status']."\n";
    //     echo "------------------------\n";
    // }

?>