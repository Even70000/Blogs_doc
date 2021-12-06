<?php
//include database connedtion
include('database.class.php');
//class for blogs
class Blogs extends Database{
    // prperties
    private $id;
    private $titel;
    private $onderwerp;
    private $inhoud;
    
    // method add blogs
    public function addBlogs($uuid,$titel,$onderwerp,$inhoud){
        $query = "INSERT INTO blogs(uuid,titel,onderwerp,inhoud) 
                             VALUES(:uuid,:titel,:onderwerp,:inhoud)";
        $stmt = Database::connection()->prepare($query);
        $stmt->bindValue(":uuid",$uuid);
        $stmt->bindValue(":titel",$titel);
        $stmt->bindValue(":onderwerp",$onderwerp);
        $stmt->bindValue(":inhoud",$inhoud);
        $stmt->execute();
        return $stmt;
    }//

    //get data from table blogs
    public function getBlogs(){
        $query = "SELECT * FROM blogs";
        $result = Database::getData($query);
        return $result;
    }

    // get data by uuid
    public function getBlogByUuid($uuid){
        $query = "SELECT * FROM blogs WHERE uuid = :uuid";
        $stmt = Database::connection()->prepare($query);
        $stmt->bindValue(":uuid",$uuid);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    // method to update blogs
    public function updateBlogsByUuid($uuid,$titel,$onderwerp,$inhoud){
        $query = "UPDATE blogs SET titel=:titel, onderwerp=:onderwerp, inhoud=:inhoud WHERE uuid = :uuid";
        $stmt = Database::connection()->prepare($query);
        $stmt->bindValue(":uuid",$uuid);
        $stmt->bindValue(":titel",$titel);
        $stmt->bindValue(":onderwerp",$onderwerp);
        $stmt->bindValue(":inhoud",$inhoud);
        $stmt->execute();
        return $stmt;
    }//

    // method to delete a row
    public function deleteBlogsByUuid($uuid){
        $query = "DELETE FROM blogs WHERE uuid = :uuid";
        $stmt = Database::connection()->prepare($query);
        $stmt->bindValue(":uuid",$uuid);
        $stmt->execute();
        return $stmt;
    }
}