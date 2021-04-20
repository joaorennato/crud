<?php

class Login extends Main {
	
    public function entrar($email,$senha){
        try {
            $query = $this->_conn->prepare("SELECT * FROM `usuarios` WHERE `email` = :email LIMIT 1");
            $query->execute(array(':email'=>$email));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if($query->rowCount() > 0) {
                if(md5($senha)==$result['senha']){
                    $_SESSION['sessao_admin_id'] = $result['id'];
                    $_SESSION['sessao_admin_nome'] = $result['nome'];
                    $_SESSION['sessao_admin_email'] = $result['email'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function esta_logado(){
        if(isset($_SESSION['sessao_admin_id']) && isset($_SESSION['sessao_admin_nome']) && isset($_SESSION['sessao_admin_email'])){
            return true;
        }
    }
 
    public function redireciona($url){
        header("Location: $url");
    }
 
    public function logout(){
        session_destroy();
        unset($_SESSION['sessao_admin_id']);
        unset($_SESSION['sessao_admin_nome']);
        unset($_SESSION['sessao_admin_email']);
        return true;
    }
    
}


?>