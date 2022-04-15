
<?php 
	
    class ChatRooms
    {
        private $chat_id;
        private $sendmail;
        private $message;
        private $getmail;
        private $timesend;
        protected $connect;
    
        public function setChatId($chat_id)
        {
            $this->chat_id = $chat_id;
        }
    
        function getChatId()
        {
            return $this->chat_id;
        }
        public function settimesend($timesend)
        {
            $this->timesend = $timesend;
        }
    
        function gettimesend()
        {
            return $this->timesend;
        }
        function setsendmail($sendmail)
        {
            $this->sendmail = $sendmail;
        }
    
        function getsendmail()
        {
            return $this->sendmail;
        }
    
        function setMessage($message)
        {
            $this->message = $message;
        }
    
        function getMessage()
        {
            return $this->message;
        }
        public function setGetMail($getmail)
        {
            $this->$getmail =$getmail;
        }
    
        function getGetMail()
        {
            return $this->getmail;
        }
        function setCreatedOn($timesend)
        {
            $this->timesend = $timesend;
        }
    
        function getCreatedOn()
        {
            return $this->timesend;
        }
    
        public function __construct()
        {
            require_once("Database_connection.php");
    
            $database_object = new Database_connection;
    
            $this->connect = $database_object->connect();
        }
    
        function save_chat()
        {
            $query = "INSERT INTO tinnhan(no, sendmail, sendtext, getmail, timesend) VALUES (:dem, :sendmail, :msg, :getmail, :tm)";
    
            $statement = $this->connect->prepare($query);

            $statement->bindParam(':dem', $this->chat_id);

            $statement->bindParam(':sendmail', $this->sendmail);
    
            $statement->bindParam(':msg', $this->message);

            $statement->bindParam(':getmail', $this->getmail);

            $statement->bindParam(':tm', $this->timesend);
    
            $statement->execute();
        }
    
        function get_all_chat_data()
        {
            $query = "SELECT * FROM tinnhan ORDER BY no ASC";
    
            $statement = $this->connect->prepare($query);
    
            $statement->execute();
    
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        function get_all_chat_num()
        {
            $query = "SELECT COUNT(*) as count FROM tinnhan;
            ";
    
            $statement = $this->connect->prepare($query);
    
            $statement->execute();
    
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
        
    ?>