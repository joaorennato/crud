<?php

setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$item_per_page = 7;

session_start();

class Main {
    private $_host;
    private $_dbname;
    private $_user;
    private $_pass;
    
    public $_conn;
    public $_data;
    
    public function __construct(){
        
        $this->_host = "localhost"; //endereço do servidor
        $this->_user = "root"; //nome de usuario do banco de dados
        $this->_pass = ""; //senha do banco de dados
        $this->_dbname = "crud"; //nome do banco de dados
        
        try{
            $this->_conn = new PDO("mysql:host=$this->_host;dbname=$this->_dbname", $this->_user, $this->_pass);
            $this->_conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch(PDOException $e){
            echo "Ocorreu um erro ao conectar ao banco de dados: ".$e->getMessage();
        }
        
    }
    
}

?>