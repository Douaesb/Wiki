<?php
class tagModel{

    private $tagID;
    private $nomTag;
    private $conn;
    
    public function __construct() {
       
        $this->conn = Database::getDb()->getConn();

    }


    public function getTagID(){
        return $this->tagID;
    }

    public function setTagID($tagID){
        $this->tagID = $tagID;

    }
    public function getTag(){
        return $this->nomTag;
    }

    public function setTag($nomtag){
        $this->nomTag = $nomtag;
    }

    public function addTag()
    {
        $sql = "INSERT INTO tags (nomTag) VALUES (:nomC)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomC', $this->nomTag);
        return $stmt->execute();
    }


    public function DisplayTag()
    {
        $sql = "SELECT * FROM tags";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $tagsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tags = [];
        foreach ($tagsData as $ta) {
            $tag = new tagModel();
            $tag->setTagID($ta['tagID']);
            $tag->setTag($ta['nomTag']);
            $tags[] = $tag;
        }
        return $tags;
    }

    public function editTag($tagID)
    {
        $sql = "UPDATE tags SET nomTag = :nomT WHERE tagID = :tagID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tagID', $tagID);
        $stmt->bindParam(':nomT', $this->nomTag);
        return $stmt->execute();
    }

    public function deleteTag($tagID)
    {
        $sql = "DELETE FROM tags WHERE tagID = :tagID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tagID', $tagID);
        return $stmt->execute();
    }
    

}