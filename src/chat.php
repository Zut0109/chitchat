<?php

//Chat.php

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
require dirname(__DIR__) . "/database/ChatUser.php";
require dirname(__DIR__) . "/database/chatroom.php";

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo 'Server Started';
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        echo 'Server Started';
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from,$msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $data = json_decode($msg, true);

        $chat_object = new \ChatRooms;

        $chat_object->setChatId($data['chatnumber']);
        $chatid =$data['chatnumber'];
        $chat_object->setsendmail($data['usermail']);
        $sendmail =$data['usermail'];
        $chat_object->setMessage($data['msg']);
        $text =$data['msg'];
        $chat_object->setGetMail($data['sendto']);
        $getmail = $data['sendto'];
        $chat_object->settimesend(date("Y-m-d h:i:s"));
        $time =date("d-m-Y h:i:s");

        $link=mysqli_connect("localhost","root","") or die("Cannot connect to the localhost");
	    mysqli_select_db($link ,"nhantin") or die("Cannot connect to the database");
	    mysqli_query($link, "SET NAMES 'UTF8'");
        $sql_check2 = mysqli_query($link, "INSERT INTO tinnhan(no, sendmail, sendtext, getmail, timesend) VALUES ($chatid,'$sendmail','$text','$getmail','$time')");
        $user_object = new \ChatUser;

        $user_object->setUserEmail($data['usermail']);

        $user_data = $user_object->get_user_data_by_email();

        $user_name = $user_data['name'];

        $data['dt'] = date("d-m-Y h:i:s");


        foreach ($this->clients as $client) {
            /*if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }*/

            if($from == $client)
            {
                $data['username'] = 'Me';
            }
            else
            {
                $data['username'] = $user_name;
            }

            $client->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}

?>
