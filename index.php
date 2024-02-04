<?php
  define('API_KEY', '6819348912:AAG-c8kv4f7VfEYBIk4289it66fzEDz4b4s');
  function bot($method, $datas = []) {
    $ch = curl_init();
    $url = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
  
    $res = curl_exec($ch);
    curl_close($ch);

    if (!curl_error($ch)) {
      return json_decode($res);
    } else {
      return false;
    }
  }

  $update = json_decode(file_get_contents("php://input"));
  $message = $update->message;
  $cid = $message->chat->id;
  $cidTyp = $message->chat->type;
  $miid = $message->message_id;
  $name = $message->chat->first_name;
  $lastname = $message->chat->last_name;
  $user = $message->from->username;
  $tx = $message->text;
  $callback = $update->callback_query;
  $mmid = $callback->inline_message_id;
  $mes = $callback->message;
  $mid = $mes->message_id;
  $cmtx = $mes->text;
  $mmid = $callback->inline_message_id;
  $idd = $callback->message->chat->id;
  $cbid = $callback->from->id;
  $cbuser = $callback->from->username;
  $data = $callback->data;
  $ida = $callback->id;
  $cqid = $update->callback_query->id;
  $cbins = $callback->chat_instance;
  $cbchtyp = $callback->message->chat->type;

  $keyboard = json_encode([
      'resize_keyboard' => true,
      'keyboard' => [
          [['text' => "Key"],],
      ]
    ]);

  if ($tx == "/start") {
    bot('sendMessage', [
      'chat_id'=>$cid,
      'text'=>'Hello',
      'reply_markup'=>$keyboard
    ]);
  }

  

  $inline = json_encode([
      'inline_keyboard' => [
          [['callback_data' => "ok", 'text' => "Ha"],],
      ]
    ]);

    if ($tx == "Key") {
    bot('sendMessage', [
      'chat_id'=>$cid,
      'text'=>'Bosildi',
      'reply_markup'=>$inline
    ]);
  }

  if ($data == 'ok') {
    bot('sendMessage', [
      'chat_id'=>$cbid,
      'text'=>'click',
    ]);
  }

?>