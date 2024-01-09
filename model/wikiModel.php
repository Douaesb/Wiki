<?php
class wikiModel{

    private $wikiID;
    private $title;
    private $content;
    private $creationDate;
    


    private $conn;
    
    public function __construct() {
       
        $this->conn = Database::getDb()->getConn();

    }


    public function getwikiID(){
        return $this->wikiID;
    }

    public function setwikiID($wikiID){
        $this->wikiID = $wikiID;

    }
    public function getwiki(){
        return $this->title;
    }

    public function setwiki($title){
        $this->title = $title;
    }
    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;

    }
    public function getCreationDate(){
        return $this->creationDate;
    }

    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
    }

    public function addwiki($iduser,$categorieID)
    {
        $sql = "INSERT INTO wiki (title,content,creationDate,iduser,categorieID) VALUES (:title, :content, :creationDate, :iduser, :categorieID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':creationDate', $this->creationDate);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->bindParam(':categorieID', $categorieID);
        return $stmt->execute();
    }


    // public function Displaywiki()
    // {
    //     $sql = "SELECT * FROM wiki";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute();
    //     $wikisData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $wikis = [];
    //     foreach ($wikisData as $ta) {
    //         $wiki = new wikiModel();
    //         $wiki->setwikiID($ta['wikiID']);
    //         $wiki->setwiki($ta['title']);
    //         $wiki->setContent($ta['content']);
    //         $wiki->setCreationDate($ta['creationDate']);
    //         $wikis[] = $wiki;
    //     }
    //     return $wikis;
    // }
    

}