<?php

class Op extends Main {
    
    public function localurl() {
        return "http://localhost/crud"; //colocar aqui a url base de acesso.
    }
    
    public function getSingle($tabela,$valor_ref,$campo,$campo_retorno) {
        try{
            $query = "SELECT * FROM `".$tabela."` WHERE `".$campo."` = '".$valor_ref."' LIMIT 1";
            $this->_data = $this->_conn->prepare($query);
            $this->_data->execute();
            while($row = $this->_data->fetch()){
                return $row[$campo_retorno];
            }
        } catch(PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function doQuery($query) {
        
        $operation = explode(" ",$query);
        $operation = $operation[0];
        
        try {
            $this->_data = $this->_conn->prepare($query);
            $this->_data->execute();
            
            if($operation == 'SELECT'){
                return array(
                    'status'=>'success',
                    'query_string'=>$this->_data,
                    'obj'=>$this->_data->fetchAll(PDO::FETCH_ASSOC),
                    'affected_rows'=>$this->_data->rowCount()
                );
            }
            
            if($operation == 'INSERT'){
                return array(
                    'status'=>'success',
                    'query_string'=>$this->_data,
                    'last_insert_id'=>$this->_conn->lastInsertId(),
                    'affected_rows'=>$this->_data->rowCount()
                );
            }
            
            if($operation == 'UPDATE'){
                return array(
                    'status'=>'success',
                    'query_string'=>$this->_data,
                    'affected_rows'=>$this->_data->rowCount()
                );
            }
            
            if($operation == 'DELETE'){
                return array(
                    'status'=>'success',
                    'query_string'=>$this->_data,
                    'affected_rows'=>$this->_data->rowCount()
                );
            }
            
        } catch(PDOException $e){
            return array(
                'status'=>'error',
                'message'=>$e->getMessage()
            );
        }
    }
    
}

?>