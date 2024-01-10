<?php
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
            $sql = "SELECT w.wikiID, w.title, w.creationDate, c.nomCategorie, u.nom, u.prenom
                    FROM wiki w
                    LEFT JOIN categorie c ON w.categorieID = c.categorieID
                    LEFT JOIN user u ON w.iduser = u.iduser
                    WHERE u.iduser = :iduser AND archive IS NULL
                    ORDER BY w.creationDate DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $stmt->execute();

            $wikisData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($wikisData as $wi) {
                $wiki = new wikiModel();
                $wiki->setwikiID($wi['wikiID']);
                $wiki->setwiki($wi['title']);
                $wiki->setCreationDate($wi['creationDate']);

                $cat = new CategorieModel();
                $cat->setCategorie($wi['nomCategorie']);

                $user = new UserModel();
                $user->setNom($wi['nom']);
                $user->setPrenom($wi['prenom']);

                $wikiData = [
                    'wiki' => $wiki,
                    'category' => $cat,
                    'user' => $user,
                ];

                $wikis[] = $wikiData;
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or rethrow as needed
            echo "Error: " . $e->getMessage();
        }

        return $wikis;
    }


    public function displayAllWikis()
    {
        $sql = "SELECT w.wikiID, w.title, w.creationDate, c.nomCategorie, u.nom, u.prenom
                FROM wiki w
                LEFT JOIN categorie c ON w.categorieID = c.categorieID
                LEFT JOIN user u ON w.iduser = u.iduser
                WHERE archive IS NULL
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
            $cat->setCategorie($wi['nomCategorie']);

            $user = new UserModel();
            $user->setNom($wi['nom']);
            $user->setPrenom($wi['prenom']);

            $wikiData = [
                'wiki' => $wiki,
                'category' => $cat,
                'user' => $user,
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
}
