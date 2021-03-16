<?php

require "./lib/JSONReader.php";
require "./lib/searchFunctions.php";

$taskList = JSONReader('./dataset/TaskList.json');

if(isset($_GET['searchText']) && trim($_GET['searchText'])!==''){

    $searchText=trim(filter_var($_GET['searchText'], FILTER_SANITIZE_STRING));

    $taskList = array_filter($taskList, searchText($searchText));
    
    if(isset($_GET['status']) && ($_GET['status'])!=='all'){
        $status=($_GET['status']);
           
        $taskList= array_filter($taskList, searchStatus($status));
        
    }else{
        
        $status='all';
    }
}else{

    $searchText='';

    if(isset($_GET['status']) && ($_GET['status'])!=='all'){
        $status=($_GET['status']);
    
        
        $taskList= array_filter($taskList, searchStatus($status));
        
    }else{
        
        $status='all';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Taklist</title>
</head>
<body>

    <div class="container-fluid bg-secondary py-3 mb-3 text-light">
        <div class="container">
            <h1 class="display-1">Tasklist</h1>
        </div>
    </div>
 
    <form action="index.php">
        
            <div class="container">
                <div class="input-group pb-3 my-1">
                    <label class="w-100 pb-1 fw-bold" for="searchText">Cerca</label>
                    <input id="searchText" name="searchText" type="text" class="form-control" placeholder="attività da cercare" value="<?=$searchText?>">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Invia</button>
                    </div>
                </div>
        
                <div id="status-radio" class=" mb-3">
                    <div class="fw-bold pe-2 w-100">Stato attività</div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name='status'  value="all" id="all" <?php if ($status == "all") echo "checked";?>>
                        <label class="form-check-label" >tutti</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name='status'  value="todo" id="todo" <?php if ($status == "todo") echo "checked";?>>
                        <label class="form-check-label" >da fare</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name='status'  value="progress" id="progress" <?php if ($status == "progress") echo "checked";?>>
                        <label class="form-check-label" >in lavorazione</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name='status'  value="done" id="done" <?php if ($status == "done") echo "checked";?>>
                        <label class="form-check-label" >fatto</label>
                      </div>
                </div>
            


    </form>

        <section class="tasklist mt-3">
            <h1 class="fw-bold fs-6">Elenco delle attività</h1>
            <table class="table">
                <tr>
                    <th class="w-100">nome</th>
                    <th class="text-center">stato</th>
                    <th class="text-center">data</th>
                </tr>

                <?php
                foreach ($taskList as $key => $task) { ?>
        
                    <?php
                    $status = $task['status'];
                    $taskName = $task['taskName'];
                    $expirationDate = $task['expirationDate'];
                    ?>
                    <tr>
                        <td><?=$taskName?></td>
                        <td class="text-center">
                            <span class="badge bg-<?= coloreStatus($status)?> text-uppercase"><?=$status?></span>
                        </td> 
                        <td class="text-nowrap">
                            <?=$expirationDate?>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
