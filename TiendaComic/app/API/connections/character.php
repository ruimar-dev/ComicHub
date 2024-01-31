<?php
// Verifica si la solicitud proviene de XMLHttpRequest y si se proporciona un character-id.
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
 if (isset($_GET['character-id'])) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $character_id = $_GET['character-id'];

  // Configuración de claves y parámetros para la solicitud a la API de Marvel.
  $ts = time();
  $public_key = 'dfb0f50315bf6369eb209d35020cf6f3';
  $private_key = 'b2d45cbb2af82b2028b987c60565c1a73d4c4f52';
  $hash = md5($ts . $private_key . $public_key);

  $query = array(
   'format' => 'comic',
   'formatType' => 'comic',
   'apikey' => $public_key,
   'ts' => $ts,
   'hash' => $hash,
  );
  // Configura la URL de la solicitud a la API de Marvel.
  curl_setopt($curl, CURLOPT_URL,
   "https://gateway.marvel.com:443/v1/public/characters/" . $character_id . "/comics" . "?" . http_build_query($query)
  );
   // Ejecuta la solicitud cURL y decodifica la respuesta JSON.
  $result = json_decode(curl_exec($curl), true);

  // Cierra la sesión cURL.
  curl_close($curl);

  // Devuelve la respuesta JSON al cliente.
  echo json_encode($result);
} else {
  // Si no se define el ID del personaje, muestra un mensaje de error.
  echo "Character Id no esta definido";
}
} else {
// Si la solicitud no es XMLHttpRequest, muestra un mensaje de error.
echo "Error: Servidor equivocado.";
}

