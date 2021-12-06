<?php
//class database connection
abstract class Database{
  protected static function connection(){
       $localhost = 'localhost';
       $user      = 'root';
       $password  = '';
       $dbname    = 'blog'; 
       try{
           $dsn = "mysql:host=".$localhost.";dbname=".$dbname;
           $connection = new PDO($dsn,$user,$password);
           $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           return $connection; 
        }catch(PDOException $e){
           return $e->getMessage();
        }
    }//

    protected static function getData($data){
        $stmt = Database::connection()->prepare($data);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}