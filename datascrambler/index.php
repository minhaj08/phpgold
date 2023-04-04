<?php

$string = "abcdefghijklmnopqrstuvwxyz0123456789";

if (isset($_POST['generateKeyBtn'])) {
  $key = generateKey($string);
} else {
  $key = "";
}

$result = "";

if (isset($_POST['encodeBtn'])) {
  $key = $_POST['key'];
  $text = $_POST['text'];
  if($text!=""){
    $result= encode($text, $key, $string);
  }
} 

if (isset($_POST['decodeBtn'])) {
  $key = $_POST['key'];
  $text = $_POST['text'];
  if($text!=""){
    $result= decode($text, $key, $string);
  }
} 

//function for generating the key
function generateKey($string) {
    
    $chars = str_split($string);
  
    
    shuffle($chars);
    $key = implode('', $chars);
  
    return $key;
  }

//function for encoding the text
  function encode($text, $key, $string) {

    $text = strtolower($text);
    $chars_arr = str_split($string);
    $key_arr = str_split($key);
    $text_arr = str_split($text);  
    $encrypted_text = "";

    foreach ($text_arr as $char) {
    
      $pos = array_search($char, $chars_arr);
    
      $encrypted_text .= $key_arr[$pos];
    }
    return $encrypted_text;
  }
  
//function for decoding  the text
  function decode($text, $key, $string) {
    $text = strtolower($text);    
    $chars_arr = str_split($string);
    $key_arr = str_split($key);
    $text_arr = str_split($text);
    $decrypted_text = "";

    foreach ($text_arr as $char) {
     
      $pos = array_search($char, $key_arr);
    
      $decrypted_text .= $chars_arr[$pos];
    }
    return $decrypted_text;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
  <div
    class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover relative items-center"
    style="
        background-image: url(https://images.unsplash.com/photo-1621243804936-775306a8f2e3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);
      ">
    <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
    <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
      <div class="text-center">
        <h2 class="mt-5 text-3xl font-bold text-gray-900">Data Scrumbler</h2>
        <p class="mt-2 text-sm text-gray-400">
          Scrumbling your data into peices
        </p>
      </div>
      <form class="mt-8 space-y-3" action="index.php" method="POST">
        <div class="flex space-x-4">
          <button type="submit" name="generateKeyBtn" id="generateKeyBtn">Generate
            Key</button>
          <button type="submit" name="encodeBtn" id="encodeBtn">Encode Text</button>
          <button type="submit" name="decodeBtn" id="decodeBtn">Decode Text</button>
        </div>
        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Key</label>
          <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
            type="text" name="key" id="key" placeholder="Key" value="<?php echo $key; ?>" readonly />
        </div>
        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Your Text</label>
          <div class="flex items-center justify-center w-full">
            <textarea class="w-full border-dashed border-2 border-sky-500" name="text" id="text"></textarea>
          </div>
        </div>

        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Result</label>
          <div class="flex items-center justify-center w-full">
            <textarea class="w-full border-dashed border-2 border-sky-500" name="result" id="result"
              readonly><?php echo $result; ?></textarea>
          </div>
        </div>
      </form>



    </div>
  </div>

  <style>
  .has-mask {
    position: absolute;
    clip: rect(10px, 150px, 130px, 10px);
  }
  </style>
</body>

</html>