<?php 
    session_start();
    
    include_once __DIR__ . '/../model/classTask.php';
        

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        // Requisição do tipo Get por status    
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        error_log('Content-Type recebido: ' . $contentType);
        if(str_contains($contentType, 'application/json')){
            $dados = json_decode(file_get_contents('php://input'), true);

            if(isset($dados['status'])){
                $status = $dados['status'];
                $Taskclass = new Task();
    
                $submit = $Taskclass->getTaskByStatus($status);    
                header('Content-Type: application/json');
                echo json_encode($submit);
                exit();
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Status não informado.']);
                exit();
            }
        }   
            
        // Tres tipos de requisição
        if(isset($_POST['id'])){  // 1° - Requisição do tipo Update

            if(isset($_POST['delete'])){  // 2° - Requisição do tipo Delete
                $taskID = $_POST['id'];
                $Taskclass = new Task();
                $submit = $Taskclass->deleteTask($taskID);
                
                $_SESSION['message'] = json_decode($submit, true)['message'];

                header('Content-Type: application/json');
                echo $submit;
                exit();
            }

            // Faz parte da 1° requisição
            $taskName = $_POST['taskName'];
            $taskDesc = $_POST['description'];
            $taskStatus = $_POST['status'];
            $taskID = $_POST['id'];
            
            $Taskclass = new Task();

            $submit = $Taskclass->updateTask($taskID, $taskName, $taskDesc, $taskStatus);

            $_SESSION['message'] = json_decode($submit, true)['message'];
            header('Location: /src/view/index.php');
            exit();
        } else{  
            // 3° - Requisição do tipo Create
            $taskName = $_POST['taskName'];
            $description = $_POST['description'];
            $status = $_POST['status'] ?? 'pendente'; // Default status if not provided

            $Taskclass = new Task();

            $submit = $Taskclass->createTask($taskName, $description, $status);

            $_SESSION['message'] = json_decode($submit, true)['message'];
            header('Location: /src/view/index.php');
            exit();
        }
    }
  
?>