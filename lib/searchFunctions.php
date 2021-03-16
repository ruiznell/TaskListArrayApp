<?php
/**
 * Funzione di ordine superiore funzione che restituisce una funzione
 * Programmazione Funzionale - dichiarativo 
 */
function searchText($searchText) {
    return function ($taskItem) use ($searchText) {
    $result = strpos($taskItem['taskName'], $searchText) !==false;
        return $result;
    };  
}

/**
 * @var string $status è la stringa che corrisponde allo status da cercare
 * (progress|done|todo)
 * @return callable La funzione che verrà utilizzata da array_filter
 */
function searchStatus(string $status) : callable {

    return function ($taskItem) use ($status) {
        if ($status==""){
            $result = count($taskItem);
        }else{
            if ($status!='all') {
                $result = strpos($taskItem['status'], $status) !==false;
            }else{
                $result = count($taskItem);
            }
        }
        return $result;
    };
}


function coloreStatus(string $status)
    {
        
        if ($status === "todo")
        {
            return "danger";
        }
    
        elseif ($status === "progress")
        {
            return "primary";
        } 
    
        else
        {
            return "secondary";
        }
    }
    




