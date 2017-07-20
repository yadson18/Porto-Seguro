<?php  
	/* 
	 * A classe Connection, serve para conectar-se a vários tipos de bancos de dados 
	 * através do PDO, tais como MySql, Firebird, PostgreSQL...
	 * Para a lista completa de bancos de dados suportados, consulte o manual do PHP.
	 */
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

		public function select($columns, $table, $condition = null, $conditionValues = null){
			if($this->getConnection()){
				if(is_string($columns) && is_string($table)){
					if(empty($condition) && empty($conditionValues)){
						$query = $this->getConnection()->query("SELECT {$columns} FROM {$table}");
						
						return $query->fetchAll(PDO::FETCH_ASSOC);
					}
					else{
						if(is_string($condition) && is_string($conditionValues)){
							$query = $this->getConnection()->prepare(
								"SELECT {$columns} FROM {$table} {$condition}"
							);
							$query->execute($conditionValues);
						
							return $query->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			}
			return false;
		}

		public function insert($table, $columns, $values){
			if($this->getConnection()){
				$columnFormat = "";
				$column = "";
				
				for($i = 0; $i < sizeof($columns); $i++){
					if($i < (sizeof($columns) - 1)){
						$columnFormat .= ":" . $columns[$i] . ", ";
						$column .= $columns[$i] . ", ";
					}
					else{
						$columnFormat .= ":" . $columns[$i];
						$column .= $columns[$i];
					}
				}
				$query = "INSERT INTO {$table}({$column}) VALUES({$columnFormat})";
				$query = $this->getConnection()->prepare($query);
				for($j = 0; $j < sizeof($columns); $j++){
					$query->bindParam(":" . $columns[$j], $values[$j], PDO::PARAM_STR);
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