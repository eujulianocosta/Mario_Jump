<?php
// Verifica se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do jogador
    $data = json_decode(file_get_contents('php://input'));

    // Carrega os dados existentes do arquivo JSON
    $rankingData = json_decode(file_get_contents('ranking.json'), true);

    // Adiciona os novos dados do jogador
    $rankingData[] = ['name' => $data->name, 'time' => $data->time];

    // Classifica o ranking (maior tempo primeiro)
    usort($rankingData, function($a, $b) {
        return $b['time'] - $a['time'];
    });

    // Mantém apenas os 10 melhores jogadores
    $rankingData = array_slice($rankingData, 0, 10);

    // Salva os dados atualizados no arquivo JSON
    file_put_contents('ranking.json', json_encode($rankingData));
}
?>
