<?php
// function sendRequest($method, $module, $path, $data, $type = false)
function sendRequest($method, $url, $data, $type = false)
{
  $headers = array();
  $headers[]  = "Content-Type: application/json";

  $curl_handle = curl_init();
  curl_setopt($curl_handle, CURLOPT_URL, API . $url);
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl_handle, CURLOPT_POST, TRUE);
  curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $method);
  curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($data));
  $response = curl_exec($curl_handle);

  if ($type==="api") {
    # code...
    echo 'Method : '.$method.'<br>';
    echo 'URL : ';
    // echo (BASE_URL_API . $module . '/' . $path);
    echo (API.$url);
    echo '<br><br>Params : <br>';
    echo json_encode($data);
    echo '<br><br>Response : <br>';
    var_dump($response);
  }

  if (curl_errno($curl_handle)) {
    $error_msg = curl_error($curl_handle);
  }
  curl_close($curl_handle);

  if (isset($error_msg)) {
    var_dump(1);
    exit();
  }
  $result = json_decode($response, $type);

  if(!$result) {
      # code...
      echo 'Method : '.$method.'<br>';
      echo 'URL : ';
    //   echo (BASE_URL_API . $module . '/' . $path);
      echo (API.$url);
      echo '<br><br>Params : <br>';
      echo json_encode($data);
      echo '<br><br>Response : <br>';
      var_dump($response);
      die();
  }

  return $result;
}