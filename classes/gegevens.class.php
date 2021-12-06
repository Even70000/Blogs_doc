<?php 
//include class database.class.inc.php
include_once('database.class.php');
// create class Gegevens extends from Database class
class Gegevens extends Database{
    //properties
    private $id;
    private $uuid;
    private $naam;
    private $email;
    private $password;
    private $rol_id;

   //method for inserting data
   public function addGegevens($uuid,$naam,$email,$wachtwoord){
    $query = "INSERT INTO gegevens (uuid,naam,email,wachtwoord,rol_id)
     VALUES(:uuid,:naam,:email,:wachtwoord,1)";
    $stmt  = Database::connection()->prepare($query);
    $stmt->bindValue(":uuid",$uuid);
    $stmt->bindValue(":naam",$naam);
    $stmt->bindValue(":email",$email);
    $stmt->bindValue(":wachtwoord",$wachtwoord);
    $stmt->execute();
    return $stmt;
   }
   // method for selecting data
   public function getGegevens(){
       $query = "SELECT gegevens.uuid , gegevens.naam, gegevens.email , gegevens.wachtwoord , rol.gebruikers_rol
       FROM gegevens
       JOIN rol ON gegevens.rol_id = rol.id";
       $result = Database::getData($query);
       return $result;
   }
   // method for getting data by uuid
   public function getGegevensByUuid($uuid){
    $query = "SELECT gegevens.naam,gegevens.email,gegevens.wachtwoord,rol.gebruikers_rol
        FROM gegevens 
        JOIN rol ON gegevens.rol_id=rol.id
        WHERE gegevens.uuid = :uuid";
       $stmt = Database::connection()->prepare($query);
       $stmt->bindValue(":uuid",$uuid);
       $stmt->execute();
       $result = $stmt->fetch();
       return $result;
   }
   // method for to update data
   public function updateGegevensByUuid($uuid,$naam,$email,$wachtwoord,$rol_id){
       $query = "UPDATE gegevens SET naam = :naam , email = :email, wachtwoord = :wachtwoord, rol_id = :rol_id WHERE uuid = :uuid";
       $stmt  = Database::connection()->prepare($query);
       $stmt->bindValue(":uuid",$uuid);
       $stmt->bindValue(":naam",$naam);
       $stmt->bindValue(":email",$email);
       $stmt->bindValue(":wachtwoord",$wachtwoord);
       $stmt->bindValue(" :rol_id",$rol_id);
       $stmt->execute();
       return $stmt;
   }
   // method for deleting data
   public function deleteGegevensByUuid($uuid){
       $query = "DELETE FROM gegevens WHERE uuid = :uuid";
       $stmt  = Database::connection()->prepare($query);
       $stmt->bindValue(":uuid",$uuid);
       $stmt->execute();
       return $stmt;
   }

}