<?php
/**
 * Funzione di ordine superiore funzione che restituisce una funzione
 * Programmazione Funzionale - dichiarativo 
 */
function searchText($searchText) {
    $result = strpos($taskItem['taskName'], $searchText) !==false;
        return $result;
   
}

/**
 * @var string $status è la stringa che corrisponde allo status da cercare
 * (progress|done|todo)
 * @return callable La funzione che verrà utilizzata da array_filter
 */
function searchStatus(string $status) : callable {
    return function ($taskItem) use ($status) {
        
        $result = strpos($taskItem['status'], $status) !==false;
        return $result;

    };
} 


