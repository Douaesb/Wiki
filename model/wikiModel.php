<?php
    require_once('database.php');

class wikiModel
{

    private $wikiID;
    private $title;
    private $content;
    private $creationDate;



    private $conn;

    public function __construct()
    {

        $this->conn = Database::getDb()->getConn();
    }


    public function getwikiID()
    {
        return $this->wikiID;
    }

    public function setwikiID($wikiID)
    {
        $this->wikiID = $wikiID;
    }
    public function getwiki()
    {
        return $this->title;
    }

    public function setwiki($title)
    {
        $this->title = $title;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function addWiki($iduser, $categorieID)
    {
        $sql = "INSERT INTO wiki (title, content, creationDate, iduser, categorieID) VALUES (:title, :content, :creationDate, :iduser, :categorieID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':creationDate', $this->creationDate);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->bindParam(':categorieID', $categorieID);

        $result = $stmt->execute();

        $wikiID = $this->conn->lastInsertId();

        return $result ? $wikiID : false;
    }


    public function addWikiTag($wikiID, $tagID)
    {
        $sql = "INSERT INTO wikitag (wikiID, tagID) VALUES (:wikiID, :tagID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':wikiID', $wikiID);
        $stmt->bindParam(':tagID', $tagID);
        return $stmt->execute();
    }



    public function displayWikis($iduser)
    {
        $wikis = [];

        try {
            $sql = "SELECT w.wikiID, w.title,w.content, w.creationDate,c.categorieID, c.nomCategorie, u.nom, u.prenom,t.tagID, GROUP_CONCAT(t.nomTag) as tagnames
                    FROM wiki w
                    LEFT JOIN categorie c ON w.categorieID = c.categorieID
                    LEFT JOIN user u ON w.iduser = u.iduser
                    LEFT JOIN wikitag wt ON w.wikiID = wt.wikiID
                LEFT JOIN tags t on t.tagID = wt.tagID
                WHERE u.iduser = :iduser AND archive IS NULL
                GROUP BY w.wikiID
                    ORDER BY w.creationDate DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $stmt->execute();

            $wikisData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($wikisData as $wi) {
                $wiki = new wikiModel();
                $wiki->setwikiID($wi['wikiID']);
                $wiki->setwiki($wi['title']);
                $wiki->setContent($wi['content']);
                $wiki->setCreationDate($wi['creationDate']);

                $cat = new CategorieModel();
            $cat->setCategorieID($wi['categorieID']);
                $cat->setCategorie($wi['nomCategorie']);

                $user = new UserModel();
                $user->setNom($wi['nom']);
                $user->setPrenom($wi['prenom']);

                $tagNames = explode(',', $wi['tagnames']);
                $tags = array_map('trim', $tagNames);
                $tag = new tagModel();
                $tag->setTag($tags);
                $tag->setTagID($wi['tagID']);

                $wikiData = [
                    'wiki' => $wiki,
                    'category' => $cat,
                    'user' => $user,
                    'tags' => $tag,
                ];
                $wikis[] = $wikiData;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $wikis;
    }


    public function displayAllWikis()
    {
        $sql = "SELECT w.wikiID, w.title, w.creationDate, c.nomCategorie, u.nom, u.prenom, GROUP_CONCAT(t.nomTag) as tagnames
                FROM wiki w
                LEFT JOIN categorie c ON w.categorieID = c.categorieID
                LEFT JOIN user u ON w.iduser = u.iduser
                LEFT JOIN wikitag wt ON w.wikiID = wt.wikiID
                LEFT JOIN tags t on t.tagID = wt.tagID
                WHERE archive IS NULL
                GROUP BY w.wikiID
                ORDER BY w.creationDate DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $wikisData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $wikis = [];
        foreach ($wikisData as $wi) {
            $wiki = new wikiModel();
            $wiki->setwikiID($wi['wikiID']);
            $wiki->setwiki($wi['title']);
            $wiki->setCreationDate($wi['creationDate']);

            $cat = new CategorieModel();
            $cat->setCategorieID($wi['categorieID']);
            $cat->setCategorie($wi['nomCategorie']);

            $user = new UserModel();
            $user->setNom($wi['nom']);
            $user->setPrenom($wi['prenom']);

            $tagNames = explode(',', $wi['tagnames']);
            $tags = array_map('trim', $tagNames);
            $tag = new tagModel();
            $tag->setTagID($wi['tagID']);
            $tag->setTag($tags);
            $wikiData = [
                'wiki' => $wiki,
                'category' => $cat,
                'user' => $user,
                'tags' => $tag,
            ];

            $wikis[] = $wikiData;
        }

        return $wikis;
    }


    public function deleteWiki($wikiID)
    {
        $sql = "DELETE FROM wiki WHERE wikiID = :wikiID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':wikiID', $wikiID);
        return $stmt->execute();
    }


    public function ArchiveWiki($wikiID)
    {
        $sql = "UPDATE wiki SET archive = 1 WHERE wikiID = :wikiID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':wikiID', $wikiID);
        return $stmt->execute();
    }




    public function detailsWiki($wikiID)
    {
        $sql = "SELECT w.wikiID, w.title,w.content, w.creationDate, c.nomCategorie, u.nom, u.prenom, GROUP_CONCAT(t.nomTag) as tagnames
    FROM wiki w
    LEFT JOIN categorie c ON w.categorieID = c.categorieID
    LEFT JOIN user u ON w.iduser = u.iduser
    LEFT JOIN wikitag wt ON w.wikiID = wt.wikiID
    LEFT JOIN tags t on t.tagID = wt.tagID
    WHERE w.wikiID = :wikiID AND archive IS NULL";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':wikiID', $wikiID, PDO::PARAM_INT);
        $stmt->execute();

        $wikisData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $wikis = [];
        foreach ($wikisData as $wi) {
            $wiki = new wikiModel();
            $wiki->setwikiID($wi['wikiID']);
            $wiki->setwiki($wi['title']);
            $wiki->setContent($wi['content']);
            $wiki->setCreationDate($wi['creationDate']);
            $cat = new CategorieModel();
            $cat->setCategorie($wi['nomCategorie']);
            $user = new UserModel();
            $user->setNom($wi['nom']);
            $user->setPrenom($wi['prenom']);
            $tagNames = explode(',', $wi['tagnames']);
            $tags = array_map('trim', $tagNames);
            $tag = new tagModel();
            $tag->setTag($tags);
            $wikiData = [
                'wiki' => $wiki,
                'category' => $cat,
                'user' => $user,
                'tags' => $tag,
            ];

            $wikis[] = $wikiData;
        }

        return $wikis;
    }

    public function searchWiki($keyword) {
        $keyword = '%' . $keyword . '%';

        $query = "SELECT w.wikiID, w.title, w.content, w.creationDate, c.nomCategorie, u.nom, u.prenom, GROUP_CONCAT(t.nomTag) as tagnames
        FROM wiki w
        LEFT JOIN categorie c ON w.categorieID = c.categorieID
        LEFT JOIN user u ON w.iduser = u.iduser
        LEFT JOIN wikitag wt ON w.wikiID = wt.wikiID
        LEFT JOIN tags t ON t.tagID = wt.tagID
        WHERE archive IS NULL AND (w.title LIKE :keyword OR c.nomCategorie LIKE :keyword OR t.nomTag LIKE :keyword)
        GROUP BY w.wikiID
        ORDER BY w.creationDate DESC";
    
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalWikis(){
        $sql = "SELECT COUNT(*) as totalWikis FROM wiki";
        $stmt = $this->conn->prepare($sql);
         $stmt->execute();
         return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getMostUsedCategory(){
        $sql = " SELECT c.nomCategorie, COUNT(w.categorieID) as categoryCount
        FROM wiki w
        JOIN categorie c ON w.categorieID = c.categorieID
        GROUP BY w.categorieID
        ORDER BY categoryCount DESC
        LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    }

    public function getTotalCategories(){
        $sql = "SELECT COUNT(*) as totalCategories FROM categorie";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    }

    public function getTotalTags(){
        $sql = "SELECT COUNT(*) as totalTags FROM tags";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    }

    public function getTotalAuthors(){
        $sql = "SELECT COUNT(iduser) as totalAuthors FROM user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    }

    public function getMostPostAuthor() {
        $sql = "SELECT u.nom, COUNT(w.iduser) as wikiCount
        FROM wiki w
        JOIN user u ON w.iduser = u.iduser
        GROUP BY w.iduser
        ORDER BY wikiCount DESC
        LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);    }

    public function editWiki($wikiID, $title, $content, $categoryID, $tagIDs)
    {
        $sql = "UPDATE wiki SET title = :title, content = :content, categorieID = :categoryID WHERE wikiID = :wikiID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':wikiID', $wikiID);

        $result = $stmt->execute();

        // Remove existing tags for the wiki
        $deleteTagsQuery = "DELETE FROM wikitag WHERE wikiID = :wikiID";
        $deleteTagsStmt = $this->conn->prepare($deleteTagsQuery);
        $deleteTagsStmt->bindParam(':wikiID', $wikiID);
        $deleteTagsStmt->execute();

        // Insert new tags for the wiki
        foreach ($tagIDs as $tagID) {
            $insertTagQuery = "INSERT INTO wikitag (wikiID, tagID) VALUES (:wikiID, :tagID)";
            $insertTagStmt = $this->conn->prepare($insertTagQuery);
            $insertTagStmt->bindParam(':wikiID', $wikiID);
            $insertTagStmt->bindParam(':tagID', $tagID);
            $insertTagStmt->execute();
        }

        // Close statements
        $stmt->close();
        $deleteTagsStmt->close();
        $insertTagStmt->close();

        return $result;
    }

}
