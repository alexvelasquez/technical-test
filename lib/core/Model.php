<?php
abstract class Model 
{
    protected abstract static function tableName();

    /** get all the records **/
    public static function findAll()
    {
        try {
            $query = "SELECT * FROM ".static::tableName();
            $execute = self::executeQuery($query);
            $result = self::fetchQuery($execute);
            return $result;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /** get records by condition */
    public static function findBy($params)
    {
        try {
            $query = self::filterParams($params);
            $execute = self::executeQuery($query,$params);
            $result = self::fetchQuery($execute);
            return $result;
        } catch (\Throwable $th) {
            print_r($th->getMessage());
            return false;
        }
    }

    /** get records by condition */
    public static function findOneBy($params)
    {
        try {
            $query = self::filterParams($params);
            $execute = self::executeQuery($query,$params);
            $result = self::fetchQuery($execute);
            return !empty($result) ? $result[0] : null;
        } catch (\Throwable $th) {
            print_r($th->getMessage());
            return null;
        }
    }

    /** perisist database record */
    public static function persist($params)
    {
        try {
            $isInsert = empty($params['id']);
            if($isInsert){
                $values='(';
                $valueParams='VALUES(';
                foreach ($params as $key => $value) {
                    $values .= "$key,";
                    $valueParams .= "?,";
                }
                $values = trim($values,',');
                $valueParams = trim($valueParams,',');
                $values.=')';
                $valueParams.=')';
                $query = "INSERT INTO ".static::tableName()."$values "." $valueParams";
            }
            else{
                $values = '';
                foreach ($params as $key => $value) {
                    $values .= "$key = ?,";
                }
                $values = trim($values,',');
                $query = "UPDATE ".static::tableName()." SET $values WHERE id = ".$params['id'];                
            }

            $result = self::executeQuery($query,$params,$isInsert);
            if($result){
                $id = ($isInsert) ? $result : $params['id'];
                $data = self::findOneBy(['id'=>(int)$id]);
            }
            return $data ?? null;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function delete($id)
    {
        $query = "DELETE FROM ".static::tableName()." WHERE id= ?";
        $execute = self::executeQuery($query,[$id]);
        return $execute;
    }

    /** create customer query  **/
    public static function executeQuery($query,$params=[],$lastId=false)
    {
        try {
            
            $connection = Connection::getConnection();
            $connection->beginTransaction();
            $result = $connection->prepare($query);
            if(!$result->execute(!empty($params) ? array_values($params) : $params)){
                throw new Exception("Error database");
            }
            $result = ($lastId) ? $connection->lastInsertId() : $result; /** catch last id insert */
            $connection->commit();
            return $result;
        } catch (\Throwable $th) {
            $connection->rollback();
            return false;
        }
    }

    /** return fetch assoc */
    public static function fetchQuery($result){
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value) {
            $data[] = new static($value);
        }
        return $data ?? [];
    } 

    /** include where with filters */
    private static function filterParams($params=[])
    {   
        $where = '';
        if (!empty($params)) {
            $where = 'WHERE ';
            foreach ($params as $index=>$value) {
                $where .= $index.' = ? AND '; 
            }
            $where = trim($where,'AND ');//delete and
        }
        $query = "SELECT * FROM ".static::tableName()." $where";
        return $query;
    }

}