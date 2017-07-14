<?php  
	abstract class Connection{
		private static $connection;

		public function __construct($dsn, $user, $password){
			try {
				self::$connection = new PDO($dsn, $user, $password);
			}
			catch (PDOException $e) {
				self::$connection = null;
			}
		}

		public function getConnection(){
			if(!is_null(self::$connection)){
				return self::$connection;
			}
			return false;
		}

		public function select($colunas, $tabela, $condicao = null, $condicaoValues = null){
			if($this->getConnection()){
				if((strcmp($condicao, null) == 0) && (strcmp($condicaoValues, null) == 0)){ 
					$query = $this->getConnection()->query("SELECT {$colunas} FROM {$tabela}");
					
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}
				$query = $this->getConnection()->prepare("SELECT {$colunas} FROM {$tabela} {$condicao}");
				$query->execute($condicaoValues);
						
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}
			return false;
		}

		public function insert($tabela, $colunas, $valores){
			if($this->getConnection()){
				$columnFormat = "";
				$column = "";
				
				for($i = 0; $i < sizeof($colunas); $i++){
					if($i < (sizeof($colunas) - 1)){
						$columnFormat .= ":" . $colunas[$i] . ", ";
						$column .= $colunas[$i] . ", ";
					}
					else{
						$columnFormat .= ":" . $colunas[$i];
						$column .= $colunas[$i];
					}
				}
				$query = "INSERT INTO {$tabela}({$column}) VALUES({$columnFormat})";
				$query = $this->getConnection()->prepare($query);
				for($j = 0; $j < sizeof($colunas); $j++){
					$query->bindParam(":" . $colunas[$j], $valores[$j], PDO::PARAM_STR);
				} 
				$query->execute();
				return true;
			}
			return false;
		}
		
		/*public function update($table, $columnsAndValues, $condicion = null){
			$loopCount = 0;
			$prepareData = "";
			
			foreach($columnsAndValues as $column => $value){
				$loopCount++;
				if($loopCount == sizeof($columnsAndValues)){
					$prepareData .= "{$column} = :{$column}";
				}
				else{
					$prepareData .= "{$column} = :{$column},";
				}
			}
			
			$sql = "UPDATE {$table}
								SET {$prepareData}
            WHERE filmID = :filmID";
			$stmt = $pdo->prepare($sql);                                  
			$stmt->bindParam(':filmName', $_POST['filmName'], PDO::PARAM_STR);    
			
			
		}*/
	}
?>