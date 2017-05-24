<?php
/*
    Class Dbrecord_Core
    @author Maickon Rangel 2017
*/
class Dbrecord{
    private $conn, $dns, $db, $db_type, $host, $user, $pass, $now;
    
    public function __construct(){
        if($this->isConfigured()):
            $this->db = DB_NAME;
            $this->db_type = "mysql";
            $this->host = DB_HOST;
            $this->user = DB_USER;
            $this->pass = DB_PASS;

            $this->dns = $this->db_type . ":host=" . $this->host . ";dbname=" . $this->db;

            try{
                $this->conn = new PDO($this->dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            }catch(PDOException $ex){
                die("Error to connect with Database");
            }
        endif;
    }

    public function getConn(){
        return $this->conn;
    }

    private function run($instruction){
        if(($instruction == 0) || ($instruction == null)){
            return 0;
        } else {
            return 1;
        }
    }

    public function isConfigured(){
        if(defined('DB_NAME') && defined('DB_HOST') && defined('DB_USER') && defined('DB_PASS') && (DB_NAME != '')):
            return true;
        else:
            die("Banco de dados não está configurado.");
            return false;
        endif;
    }
    
    protected function __checkTableExists($table){

        $tables = $this->conn->query("SHOW TABLES LIKE '$table'");
        if($tables->rowCount() > 0){
            return true;
        } else {
            $tables = explode(',', $table);
            $check = 0;
            foreach ($tables as $key => $value) {
                $name = explode(' ', $value);
                $more_tables = $this->conn->query("SHOW TABLES LIKE '{$name[$key]}'");
                if($more_tables->rowCount() > 0){
                    $check += 1;
                }
            }
        }
        if ($check == count($tables)) {
            return true;
        } else {
            return false;
        }
    }
    /*
    __select
    string:$table
    string:$colums
    string:$where
    ex: select('user','id,name','id=1'); or select('user'); or select('user','date');
    */
    public function __select($table, $columns = null, $where = null){
        if($this->__checkTableExists($table)){
            $query = "SELECT ";
            if ($columns == null and $where == null) {
                $query .= "* FROM {$table}";
            } elseif ($columns != null) {
                if ($where != null) {
                    $query .= "{$columns} FROM {$table} WHERE {$where}";
                } else {
                    $query .= "{$columns} FROM {$table}";
                }
            }
            $statemant = $this->conn->prepare($query);
            $statemant->execute();
            if($statemant->rowCount() > 0){
                return $statemant->fetchAll(PDO::FETCH_OBJ);
            } else {
                return 0;
            }
        }
    }

     /*
    __selectOrder - Ordena os dados de uma instrucao select
    string:$table
    string:$order - Definir a ordenacao por uma coluna escolhida. 
    ex coluna nome (os dados vem ordenados pelo nome)
    string:$columns - Quais campos exibir. ex nome,id
    string:$where - Uma condicao WHERE. ex id = 2
    ex: 
    $users = $base->selectOrder('usuarios','id desc'); 
    //ordena pelo id de forma decrescente
    $users = $base->selectOrder('usuarios','nome desc', 'nome'); 
    //ordena pelo nome e so exibe nomes
    $users = $base->selectOrder('usuarios','id asc', 'nome,idade,peso','nome=\'joel\''); 
    //ordena pelo id de forma ascendente, exibe apenas o nome, idade e peso apenas de 
    //registros com o nome igual a joel

    */
    public function __selectOrder($table, $order, $columns = null, $where = null){
        if($this->__checkTableExists($table)){
            $query = "SELECT ";
            if ($columns == null and $where == null) {
                $query .= "* FROM {$table} ORDER BY {$order}";
            } elseif ($columns != null) {
                if ($where != null) {
                    $query .= "{$columns} FROM {$table} WHERE {$where} ORDER BY {$order}";
                } else {
                    $query .= "{$columns} FROM {$table} ORDER BY {$order}";
                }
            }
            $statemant = $this->conn->prepare($query);
            $statemant->execute();
            if($statemant->rowCount() > 0){
                return $statemant->fetchAll(PDO::FETCH_OBJ);
            } else {
                return 0;
            }
        }
    }
    /*
    __insert
    string:$table
    array/object:$fields
    ex:(Object)
    $obj = new StdClass;
    $obj->name = 'Rick'; $obj->email = 'rick@mail.com';
    insert($obj);
    ex:(Array)
    $array = ['name'=>'Rick','email'=>'rick@mail.com'];
    insert($array);
    */
    public function __insert($table, $fields){
        if($this->__checkTableExists($table)){
            $query = "INSERT INTO ";
            if (is_array($fields) || is_object($fields)) {
                if (is_object($fields)) {
                    (array)$fields;
                }
                $columns_names  = '';
                $columns_values = '';
                foreach ($fields as $key => $value) {
                    $columns_names  .= "{$key},";
                    $columns_values .= "'{$value}',";
                }

                $columns_names  = str_replace(',)', ')', "({$columns_names})");
                $columns_values = str_replace(',)', ')', "VALUES({$columns_values});"); 
                $query .= " {$table} {$columns_names} {$columns_values}";
            }
            $statemant = $this->conn->prepare($query);
            return $this->run($statemant->execute());
        }
    }

    /*
    __update
    strign:$table
    array/object:$fields
    array/object:$fields
    ex:(Object)
    $obj = new StdClass;
    $obj->id = '1'; $obj->name = 'Rick'; $obj->email = 'rick@mail.com';
    update($obj);
    ex:(Array)
    $array = ['id'=>'1','name'=>'Rick','email'=>'rick@mail.com'];
    update($array);
    */
    public function __update($table, $fields){
        if($this->__checkTableExists($table)){
            $query = "UPDATE ";
            if (is_array($fields) || is_object($fields)) {
                if (is_object($fields)) {
                    $fields = (array)$fields;
                }
                $all_fields = '';
                if (!isset($fields['id'])) {
                    return 0;
                } else {
                    $id = $fields['id'];
                    unset($fields['id']);
                }
                foreach ($fields as $key => $value) {
                    $all_fields  .= "{$key} = '{$value}',";
                }
                $all_fields .= " WHERE id={$id}";
                $all_fields  = str_replace(', WHERE', ' WHERE', "{$all_fields}"); 
                $query .= " {$table} SET {$all_fields}";
            }
            $statemant = $this->conn->prepare($query);
            return $this->run($statemant->execute());
        }
    }

    /*
    __delete
    strign:$table
    int/string:$id
    ex:delete('user',1); or delete('user','1');
    */
    public function __delete($table, $id){
        if($this->__checkTableExists($table)){
            $query = "DELETE FROM {$table} WHERE id={$id}";
            $statemant = $this->conn->prepare($query);
            return $this->run($statemant->execute());
        }
    }

    /*
    __duplicate
    string:$table
    array:$fields
    ex: duplicate('user',['id'=>'1','name'=>'Rick']); or duplicate(['login'=>'rick_master']);
    */
    public function __duplicate($table, $fields){
        if($this->__checkTableExists($table)){
            $query = "SELECT count(*) as qtd FROM {$table} WHERE ";
            $all_fields = '';
            foreach ($fields as $key => $value) {
                $all_fields  .= "{$key} = '{$value}' AND ";
            }
            $all_fields .= "END";
            $all_fields = str_replace('AND END', ' ', "{$all_fields}");
            $query .= $all_fields;
            $statemant = $this->conn->prepare($query);
            $statemant->execute();
            if($statemant->fetchColumn() == 1){
                return 1;
            } else {
                return 0;
            }
        }
    }

    /*
    __sql
    string:$instruction
    ex: __sql('SELECT * FROM usuarios WHERE id=1');
    */
    public function __sql($instruction){
        $instruction = $this->conn->prepare($instruction);
        if($instruction->execute()){
            return $instruction->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 0;
        }
    }

    /*
    __count : retorna a quantidade de elementos de uma consulta
    string:$table
    string/array:$fields
    ex: __count('user',[nome=>'Rick']); or __count('user','nome LIKE '\%Ri%'\'); or __count('user','nome=Rick'); 
    */
    public function __count($table, $fields = null){
        $query = "SELECT COUNT(*) as count FROM {$table}";
        if ($fields != null and is_array($fields)) {
            $all_fields = '';
            foreach ($fields as $key => $value) {
                $all_fields  .= "{$key} = '{$value}' AND ";
            }
            $all_fields .= "END";
            $all_fields = str_replace('AND END', ' ', "{$all_fields}");

            $query .= " WHERE {$all_fields}";
        } else if($fields != null and is_string($fields)) {
            $query .= " WHERE {$fields}";
        }
        $statemant = $this->conn->prepare($query);
        if($statemant->execute()){
            return $statemant->fetchAll(PDO::FETCH_OBJ)[0]->count;
        } else {
            return 0;
        }
    }
}