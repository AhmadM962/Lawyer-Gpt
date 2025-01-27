

<?php


function getAIResponse($userMessage) {
    $apiKey = '';  // Ensure your API key is correct
    
    $url = 'https://api.openai.com/v1/chat/completions';
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ];

    $data = [
        'model' => 'gpt-3.5-turbo',  
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful jordanian lawyer.'],
            ['role' => 'user', 'content' => $userMessage]
        ],
        'max_tokens' => 500  
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        return ['error' => 'Error with the request.'];
    }

    // Debugging: Check the full response
    $responseData = json_decode($response, true);
    if (isset($responseData['error'])) {
        return ['error' => $responseData['error']['message']];
    }

    // Debugging: Check the full structure of the response
    return $responseData;
}

?>
