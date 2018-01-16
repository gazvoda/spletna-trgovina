<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'database_init.php';

class DBSpletna {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT user_id, role, first_name FROM user");
        $statement->execute();

        return $statement->fetchAll();
    }
/*
    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM jokes WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes 
            WHERE id =:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($joke_date, $joke_text) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO jokes (joke_date, joke_text)
            VALUES (:joke_date, :joke_text)");
        $statement->bindParam(":joke_date", $joke_date);
        $statement->bindParam(":joke_text", $joke_text);
        $statement->execute();
    }
*/
    public static function updatePassword($user_id, $first_name, $password) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE user SET password = :password WHERE user_id =:user_id");
        $statement->bindParam(":password", $password);
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();
    }

}
