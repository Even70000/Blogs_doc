<?php 
//include class database.class.inc.php
include_once('database.class.php');
class Reactie extends Database{
    //properties 
    private $uuid;
    private $commentaar;
    private $blog_uuid;
    private $gegevens_id;
    private $status_id;

    //method for adding commentaar
    public function addCommentaar($commentaarUuid,$commentaar,$blogsUuid,$gebruikersUuid, $statusCommentaar){
       $query = "INSERT INTO blogscommentaren(uuid,commentaar,blog_uuid,gegevens_uuid,status_id) 
       VALUES(:uuid,:commentaar,:blog_uuid,:gegevens_uuid,:status_id)";
       $stmt = Database::connection()->prepare($query);
       $stmt->bindValue(":uuid"           ,$commentaarUuid);      
       $stmt->bindValue(":commentaar"     ,$commentaar);   
       $stmt->bindValue(":blog_uuid"      ,$blogsUuid);   
       $stmt->bindValue(":gegevens_uuid"  ,$gebruikersUuid);   
       $stmt->bindValue(":status_id",$statusCommentaar);   
       $stmt->execute();  
    }
    // method for adding leuk en niet leuk reaction
    public function addLeukEnNietLeuk($mening,$blogsUuid,$gebruikersUuid){
        $query = "INSERT INTO blogsreacties(mening_id,blog_uuid,gegevens_uuid)
         VALUES(:mening_id,:blog_uuid,:gegevens_uuid)";
        $stmt = Database::connection()->prepare($query);
        $stmt->bindValue(":mening_id",$mening);
        $stmt->bindValue(":blog_uuid",$blogsUuid);
        $stmt->bindValue(":gegevens_uuid",$gebruikersUuid);
        $stmt->execute();
    }
    //method for getting leuk
    public function getLeuk(){
        $query = "SELECT * FROM blogsreacties WHERE mening_id = 1";
        $result = Database::getData($query);
        return $result;
    }
    //method for getting niet leuk
    public function getNietLeuk(){
        $query = "SELECT * FROM blogsreacties WHERE mening_id = 2";
        $result = Database::getData($query);
        return $result;
    }
    //method for getting commentaar
    public function getCommentaren(){
       $query = "SELECT blogscommentaren.uuid,blogscommentaren.commentaar,blogs.titel,gegevens.naam,gegevens.email,reactiestatus.reactie_status,blogscommentaren.datum
       FROM blogscommentaren
       JOIN blogs ON blog_uuid=blogs.uuid
       JOIN gegevens ON gegevens_uuid=gegevens.uuid
       JOIN reactiestatus ON status_id=reactiestatus.id";
       $result = Database::getData($query);
       return $result;
    }
    // method for getting commentaar by uuid
    public function getCommentaarByUuid($uuid){

    }
    //method for updating commentaar by uuid
    public function updateCommentaarByUuid($uuid,$status,$commentaarInhoud){
        $query = "UPDATE blogscommentaren SET commentaar = :commentaar, status_id = :status_id WHERE uuid = :uuid";
        $stmt = Database::connection()->prepare($query);
        $stmt->bindValue("uuid"        ,$uuid);
        $stmt->bindValue(":commentaar" ,$commentaarInhoud);
        $stmt->bindValue(":status_id"  ,$status);
        $stmt->execute();
    }
    //method for deleting commentaar
    public function deleteCommentaarByUuid($uuid){

    }
}