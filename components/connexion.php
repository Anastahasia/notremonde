<?php
    class MaConnexion {
        private $DatabaseName;
        private $User = "root";
        private $Password ="";
        private $Host;
        private $Connection;

        public function __construct($NewDatabaseName, $NewUser, $NewPassword, $NewHost)
        {
            $this->DatabaseName = $NewDatabaseName;
            $this->User = $NewUser;
            $this->Password = $NewPassword;
            $this->Host = $NewHost;

            try {
                $DataSourceName = "mysql:host=$this->Host;dbname=$this->DatabaseName;charset=utf8mb4";
                $this->Connection = new PDO($DataSourceName, $this->User, $this->Password);
                $this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();
            }
        }

        //TODO: working through that, I think 'method chaining' would be a perfect interface, as in:
        //$NewConnection.prepare().delete().fromtable("User").where(array( "email" => "example@local") ).execute();

        /**
         * The ConditionField is a filter to isolate a specific result
         * Returns an associative array of the results, or false on error */
        public function select($Table, $Column, $ConditionField = 1)
        {
            // $SQLQueryString = 'SELECT * FROM `users` WHERE (`mail` = "superuser@local" AND `password` = "pass")';
            // $SQLQueryString = "SELECT $Column FROM $Table WHERE 1";
            try {
                // NOTE: we cannot wrap Column in `` because it could be a regex like '*'
                // $SQLQueryString = "SELECT `$Column` FROM `$Table` WHERE $ConditionField";
                $SQLQueryString = "SELECT $Column FROM `$Table` WHERE :condition";

                $Result = $this->Connection->prepare($SQLQueryString);

                $Result->bindParam(':condition', $ConditionField,PDO::PARAM_STR, 40);
                $Result->execute();

                return $Result->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

    // selects random data from the table
        public function select_random($Table, $Column, $LimitNumber, $ConditionField = 1)
        {
            // $SQLQueryString = 'SELECT * FROM `users` WHERE (`mail` = "superuser@local" AND `password` = "pass")';
            // $SQLQueryString = "SELECT $Column FROM $Table WHERE 1";
            try {
                // NOTE: we cannot wrap Column in `` because it could be a regex like '*'
                // $SQLQueryString = "SELECT `$Column` FROM `$Table` WHERE $ConditionField";
                $SQLQueryString = "SELECT $Column FROM `$Table` WHERE $ConditionField ORDER BY rand() LIMIT $LimitNumber";

                $Result = $this->Connection->prepare($SQLQueryString);
                $Result->execute();

                return $Result->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

        // public function select_distinct($Column, $Table, $Condition = 1)
        // {
        //     try {
        //         $SQLQueryString = "SELECT DISTINCT $Column FROM $Table WHERE $Condition";

        //         // var_dump($SQLQueryString);

        //         $Result = $this->Connection->query($SQLQueryString);

        //         return $Result->fetchAll(PDO::FETCH_ASSOC);

        //     } catch (PDOException $e) {
        //         echo "Erreur: " . $e->getMessage();

        //         return false;
        //     }
        // }

        public function select_etape($Intermediate, $Table1, $Key1, $Table2, $Key2, $CircuitID)
        {
            try {
                $SQLQueryString = "SELECT *
                FROM $Intermediate
                INNER JOIN $Table1 ON $Intermediate.$Table1 = $Table1.$Key1
                LEFT JOIN $Table2 ON $Table1.$Table2 = $Table2.$Key2
                WHERE $Intermediate.circuit = '$CircuitID'
                ORDER BY ordre ASC";

                // var_dump($SQLQueryString);

                $Result = $this->Connection->prepare($SQLQueryString);
                $Result->execute();

                return $Result->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

        /**Returns the id of inserted row on sucessful insert, false on failure */
        public function insert($Table, $Values)
        {
            try {
                $ValueAsString = "";
                $KeyAsString = "";

                foreach ($Values as $EachColumn => $EachValue) {
                    // echo "$EachColumn => $EachValue";
                    $KeyAsString .= "`$EachColumn`, ";
                    // var_dump($EachValue);
                    $ValueAsString .= ($this->Connection->quote($EachValue) . ", ");
                }
                $KeyAsString = rtrim($KeyAsString, ', ');
                $ValueAsString = rtrim($ValueAsString, ', ');

                $SQLQueryString = "INSERT INTO $Table (<?>) VALUES (<!>)";
                $SQLQueryString = str_replace("<!>", $ValueAsString, str_replace("<?>", $KeyAsString, $SQLQueryString));
                
                $query = $this->Connection->prepare($SQLQueryString);
                $query->execute();

                // return true;

                return $this->Connection->lastInsertId();

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

        public function insert_user($surname, $name, $num, $email, $mdp)
        {
            try {
                $SQLQueryString = "INSERT INTO utilisateur (nom, prenom, num, email, mot_de_passe, role) VALUES (:nom, :prenom, :num, :email, :mot_de_passe, 'guest')";
                $query = $this->Connection->prepare($SQLQueryString);

                $query->bindParam(':nom', $surname,PDO::PARAM_STR, 40);
                $query->bindParam(':prenom', $name,PDO::PARAM_STR, 40);
                $query->bindParam(':num', $num,PDO::PARAM_STR, 30);
                $query->bindParam(':email', $email,PDO::PARAM_STR, 60);
                $query->bindParam(':mot_de_passe', $mdp,PDO::PARAM_STR);

                $query->execute();

                // return true;

                return $this->Connection->lastInsertId();

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

        /**Returns true on sucessful update */                
        public function update($Table, $ConditionField, $Values)
        {
            try {
                if (count($ConditionField) != 1)
                {
                    return false;
                }

                $ValueAsString = "";
                $KeyAsString = "";

                foreach ($Values as $EachColumn => $EachValue) {
                    $ValueAsString .= ("`$EachColumn` = " . $this->Connection->quote($EachValue) . ", ");
                }
                $ValueAsString = rtrim($ValueAsString, ', ');

                foreach ($ConditionField as $EachColumn => $EachValue) {
                    $KeyAsString .= ("`$EachColumn` = " . $this->Connection->quote($EachValue));
                }

                $SQLQueryString = "UPDATE $Table SET <?> WHERE <!>";
                $SQLQueryString = str_replace("<!>", $KeyAsString, str_replace("<?>", $ValueAsString, $SQLQueryString));

                $query = $this->Connection->prepare($SQLQueryString);
                $query->execute();

                return true;

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

        /**Returns true on sucessful delete */
        public function delete($Table, $ConditionField)
        {
            try {
                $SQLQueryString = "DELETE FROM `$Table` WHERE <?>";

                $ConditionAsString = "";
                foreach ($ConditionField as $EachColumn => $EachValue) {
                    $ConditionAsString .= ("`$EachColumn` = " . $this->Connection->quote($EachValue) ." AND ");
                }
                $ConditionAsString = rtrim($ConditionAsString, ' AND');

                $SQLQueryString = str_replace("<?>", $ConditionAsString, $SQLQueryString);

                echo $SQLQueryString;

                $query = $this->Connection->prepare($SQLQueryString);
                $query->execute();

                return true;

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

        public function execute_file($FilePath)
        {
            try {
                $ScriptCreateDatabase = file_get_contents($FilePath);
                $Statement = $this->Connection->prepare($ScriptCreateDatabase);

                return $Statement->execute();

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();

                return false;
            }
        }

    }

    // $NewConnection = new MaConnexion("liste_utilisateurs", "root", "", "localhost");
    // $NewConnection = new MaConnexion("products", "root", "", "localhost");
    // echo var_dump($NewConnection);

    // $Result = $NewConnection->select("utilisateur", "email");
    // $Result = $NewConnection->select("produit", "*");
    // echo var_dump($Result);

    // $Result = $NewConnection->__deprecated_insert("utilisateur", array("Doe", "Jane", rand(0, 10000) . "@domain", "20230101", null, "path/to/image.jpg"));
    // $Result = $NewConnection->insert("utilisateur", array(
    //     "NameLast" => "Doe", 
    //     "NameFirst" => "Jane",
    //     "Email" => (rand(0, 10000) . "@domain"),
    //     "Birthday" => "20230101",
    //     "idUser" => "NULL",
    //     "Image" => "path/to/image.jpg")
    // );


    // $UpdateFieldCondition = array( "Email" => "1070@domain" );

    // $UpdateValues = array(
    //     "NameLast" => "Yoka",
    //     "NameFirst" => "dahl",
    //     "Email" => "1070@domain",
    //     "Birthday" => "20230121",
    //     "Image" => "image13.jpg"
    // );

    // $Result = $NewConnection->update("utilisateur", $UpdateFieldCondition, $UpdateValues);

    // $UpdateFieldCondition = array( "Email" => "ol@dsfdsfsf" );

    // $Result = $NewConnection->delete("utilisateur", $UpdateFieldCondition);

    $NewConnection = new MaConnexion('notre_monde', "root", "", "localhost");

?>
