<?php

				/*<? 
				session_start();
				if($_SESSION['permissao'] == '1'){
				?>
				
				<?
				}
				?>*/

				class DbConfig {
	    
		function onlyAdmin(){
			session_start();

			if($_SESSION['permissao'] == '2'){
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=client'>";
				die();
			}
			
		}
		
	   function DbAbreConexao($database) {
            $server = "fasmanutencao.one.mysql";
            $user = "fasmanutencao_one";
            $pass = "nazadeyse";
            if($database)
            {
                $dbase = $database;    
            } else {
                $dbase = "fasmanutencao_one";     
            }
            
            $conn = mysql_connect($server,$user,$pass);
            if(!$conn)
            {
                $this->error("Erro ao conectar ao banco de dados!");
            }
            if(!mysql_select_db($dbase,$conn))
            {
                $this->error("Erro ao selecionar o banco de dados!");
            }
            
            $this->CONN = $conn;
            return true;
	   }
       
       
       function DbFechaConexao(){
            $conn = $this->CONN ;            
           
                $close = mysql_close($conn);
            
            if(!$close)
            {
                $this->error("Erro ao fechar a conexão com o banco de dados!");
            }
            return true;
           }
           
       function insert($tabela, $campos=array(), $valores=array(), $conexao) {
        
            
			
                $this->DbAbreConexao();
            
            
            if(empty($tabela))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(empty($this->CONN))
            {
               
                    $this->DbFechaConexao();
                
                return false;
            }
            
            $conn = $this->CONN;
            
            $query = "INSERT INTO $tabela (";
            $conta = count($valores) - 1;
            
            if ($campos)
            {   
                foreach($campos as $campo)
                {
                    $query .= $campo;
                        if($conta > 0 ) 
                        {
                            $query .= ',';
                        }
                    $conta--;
                }
            }
            
            $query .= ") VALUES (";
            
            $conta = count($valores) - 1;
            
            if ($valores)
            {   
                foreach($valores as $valor)
                {
                    $query .= "'".$valor."'";
                        if($conta > 0) 
                        {
                            $query .= ",";
                        }
                    $conta--;
                }
            }
            
            $query .= ")";
            
            /*****teste*****
            
            echo $query;
            die();
            /***fim teste***/
           
                $results = mysql_query($query,$conn) or die("Insert falhou!<hr>" . mysql_error());
            
            if(!$results)
            {   
                $message = "Insert falhou! !";
                $this->error($message);
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(!(eregi("^select",$query) || eregi("^show",$query)))
            {
                
                    $this->DbFechaConexao();
                
                return true;
            }
            else
            {
                $count = 0;
                $data = array();
                
                    while($row = mysql_fetch_array($results))
                    {
                        $data[$count] = $row;
                        $count++;
                    }
                    mysql_free_result($results);
                
                
                
                    $this->DbFechaConexao();
                
                return $data;
             }
       }
       
       
       function update($tabela,$set=array(),$where=array(),$conexao)
       {
            
                $this->DbAbreConexao();
            
            
            if(empty($tabela))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(empty($this->CONN))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            
            $conn = $this->CONN;
            
            $query = 'UPDATE '.$tabela.' SET ';
            
            $conta = count($set);
            foreach($set as $key => $value)
            {
                $query .= $key.' = '."'".$value."'";
                if($conta > 1)
                {
                    $query .= ",";
                    $conta--;
                }
            }
            $conta = count($where);
            if (count($where) > 0)
            {
                $query .= ' WHERE ';
                foreach($where as $key => $value)
                {
                    $query .= $key.' = '."'".$value."'";
                    if($conta > 1)
                    {
                        $query .= ",";
                        $conta--;
                    }
                }
            }
            
            //echo $query;
            //die();
            
            
                $results = mysql_query($query,$conn) or die("Update falhou!<hr>" . mysql_error());
            
            if(!$results)
            {   
                $message = "Update falhou! !";
                $this->error($message);
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(!(eregi("^select",$query) || eregi("^show",$query)))
            {
                
                    $this->DbFechaConexao();
                
                return true;
            }
            else
            {
                $count = 0;
                $data = array();
                
                    while($row = mysql_fetch_array($results))
                    {
                        $data[$count] = $row;
                        $count++;
                    }
                    mysql_free_result($results);
                
                
                if ($conexao == 'totvs'){
                    $this->DbFechaConexao('totvs');
                } else {
                    $this->DbFechaConexao();
                }
                return $data;
             }
            
       }
       
       function delete($tabela, $where=array(), $conexao)
       {
           
                $this->DbAbreConexao();
            
            
            if(empty($tabela))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(empty($this->CONN))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            
            $conn = $this->CONN;
            
            $query = 'DELETE FROM '.$tabela;
            if (count($where) > 0)
            {
                $query .= ' WHERE ';
                foreach($where as $key => $value)
                {
                    $query .= $key.' = '."'".$value."'";
                    if($conta > 1)
                    {
                        $query .= " AND ";
                        $conta--;
                    }
                }
            }
            
            //echo $query;
            //die();
            
           
                $results = mysql_query($query,$conn) or die("Update falhou!<hr>" . mysql_error());
            
            if(!$results)
            {   
                $message = "Update falhou! !";
                $this->error($message);
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(!(eregi("^select",$query) || eregi("^show",$query)))
            {
               
                    $this->DbFechaConexao();
                
                return true;
            }
            else
            {
                $count = 0;
                $data = array();
              
                    while($row = mysql_fetch_array($results))
                    {
                        $data[$count] = $row;
                        $count++;
                    }
                    mysql_free_result($results);
                
                
                if ($conexao == 'totvs'){
                    $this->DbFechaConexao('totvs');
                } else {
                    $this->DbFechaConexao();
                }
                return $data;
             }
       }
       
      
       
	  function select2($query, $conexao, $database)
       {
            
                $this->DbAbreConexao($database);
            
            
            if(empty($this->CONN))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            
            $conn = $this->CONN;           
            
            
           
                $results = mysql_query($query,$conn) or die("Select falhou!<hr>" . mysql_error());
            
            if(!$results)
            {   
                $message = "Select falhou! !";
                $this->error($message);
               
                    $this->DbFechaConexao();
                
                return false;
            }
            if(!(eregi("^select",$query) || eregi("^show",$query)))
            {
               
                    $this->DbFechaConexao();
                
                return true;
            }
            else
            {
                $count = 0;
                $data = array();
               
                    while($row = mysql_fetch_array($results))
                    {
                        $data[$count] = $row;
                        $count++;
                    }
                    mysql_free_result($results);
                
                
                
                    $this->DbFechaConexao();
                
                return $data;
             }
       }
	   
           
       function select($tabela, $campos, $where=array(), $param=array(), $orderby, $conexao, $opcoes=array()) {
        
           
                $this->DbAbreConexao();
            
            
            if(empty($tabela))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            if(empty($this->CONN))
            {
                
                    $this->DbFechaConexao();
                
                return false;
            }
            
            $conn = $this->CONN;
            
            $query = 'SELECT '.$campos.' FROM '.$tabela;
            $i = 0;
            $conta = count($where);
            
            if ($where)
            {   
                $query .= ' WHERE ';
                foreach($where as $dado)
                {
                    if ($opcoes[$i] != NULL || $opcoes[$i] != '' || !empty($opcoes[$i]))
                    {
                        $query .= $dado.' LIKE ';
                    }else {
                        $query .= $dado.' = ';
                    }
                    $query .= "'".$param[$i]."'";
                        if($conta > 0 && $i != $conta-1) 
                        {
                            $query .= ' AND ';
                        }
                    
                    $i++;
                }
            }
            
            
            
            if($orderby)    
                $query .= ' ORDER BY '.$orderby;
            
            
            
            
                $results = mysql_query($query,$conn) or die("Select falhou!<hr>" . mysql_error());
            
            if(!$results)
            {   
                $message = "Select falhou! !";
                $this->error($message);
               
                    $this->DbFechaConexao();
                
                return false;
            }
            if(!(eregi("^select",$query) || eregi("^show",$query)))
            {
                
                    $this->DbFechaConexao();
                
                return true;
            }
            else
            {
                $count = 0;
                $data = array();
               
                    while($row = mysql_fetch_array($results))
                    {
                        $data[$count] = $row;
                        $count++;
                    }
                    mysql_free_result($results);
                
                
                
                    $this->DbFechaConexao();
                
                return $data;
             }
       }
    }
?>
