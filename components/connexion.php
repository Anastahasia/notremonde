<?php
class MaConnexion
{
    private $DatabaseName;
    private $User = "root";
    private $Password = "";
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

    /**
     * The ConditionField is a filter to isolate a specific result
     * Returns an associative array of the results, or false on error */
    public function select($Table, $Column = 1, $ConditionField = 1)
    {
        try {
            $SQLQueryString = "SELECT * FROM `$Table` WHERE $Column = :condition";
            $query = $this->Connection->prepare($SQLQueryString);

            $query->bindParam(':condition', $ConditionField, PDO::PARAM_STR);

            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();

            return false;
        }
    }

    public function select_multi_conditions($Table, $ConditionField)
    {
        try {
            $SQLQueryString = "SELECT * FROM `$Table` WHERE <?>";

            $ConditionAsString = "";
            foreach ($ConditionField as $EachColumn => $EachValue) {
                $ConditionAsString .= ("`$EachColumn` = " . $this->Connection->quote($EachValue) . " AND ");
            }
            $ConditionAsString = rtrim($ConditionAsString, ' AND');

            $SQLQueryString = str_replace("<?>", $ConditionAsString, $SQLQueryString);

            $query = $this->Connection->prepare($SQLQueryString);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();

            return false;
        }
    }

    // selects random lines from the table according to the conditions
    public function select_random($Table, $Column, $ConditionField = 1)
    {
        try {
            $SQLQueryString = "SELECT * FROM `$Table` WHERE visible=1 ORDER BY rand() LIMIT 3";
            $query = $this->Connection->prepare($SQLQueryString);

            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();

            return false;
        }
    }

    // selects one occurence of a data 
    public function select_distinct($Column, $Table, $Condition = 1)
    {
        try {
            $SQLQueryString = "SELECT DISTINCT $Column FROM `$Table` WHERE $Condition";

            // var_dump($SQLQueryString);

            $Result = $this->Connection->query($SQLQueryString);

            return $Result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();

            return false;
        }
    }

    //selects steps for a circuit using inner join and left join
    public function select_etape($Intermediate, $Table1, $Key1, $Table2, $Key2, $CircuitID)
    {
        try {
            $SQLQueryString = "SELECT *
                FROM $Intermediate
                INNER JOIN $Table1 ON $Intermediate.$Table1 = $Table1.$Key1
                LEFT JOIN $Table2 ON $Table1.$Table2 = $Table2.$Key2
                WHERE $Intermediate.circuit = :condition
                ORDER BY ordre ASC";

            $query = $this->Connection->prepare($SQLQueryString);

            $query->bindParam(':condition', $CircuitID, PDO::PARAM_INT);

            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();

            return false;
        }
    }

    //selects using join
    public function select_join($Table1, $Key1, $Table2, $ID)
    {
        try {
            $SQLQueryString = "SELECT *
                FROM `$Table1`
                INNER JOIN $Table2 ON $Table1.$Key1 = $Table2.$Table1
                WHERE $Table1.$Key1 = '$ID'";

            // var_dump($SQLQueryString);

            $Result = $this->Connection->query($SQLQueryString);

            return $Result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();

            return false;
        }
    }

    //selects using inner join
    public function inner_join($Intermediate, $Table1, $Key1, $Table2, $Key2, $ID)
    {
        try {
            $SQLQueryString = "SELECT *
                FROM $Intermediate
                INNER JOIN $Table1 ON $Intermediate.$Table1 = $Table1.$Key1
                INNER JOIN $Table2 ON $Intermediate.$Table2 = $Table2.$Key2
                WHERE $Intermediate.$Table1 = '$ID'";

            // var_dump($SQLQueryString);

            $Result = $this->Connection->query($SQLQueryString);

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

            $query->bindParam(':nom', $surname, PDO::PARAM_STR, 40);
            $query->bindParam(':prenom', $name, PDO::PARAM_STR, 40);
            $query->bindParam(':num', $num, PDO::PARAM_STR, 30);
            $query->bindParam(':email', $email, PDO::PARAM_STR, 60);
            $query->bindParam(':mot_de_passe', $mdp, PDO::PARAM_STR);

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
            if (count($ConditionField) != 1) {
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
                $ConditionAsString .= ("`$EachColumn` = " . $this->Connection->quote($EachValue) . " AND ");
            }
            $ConditionAsString = rtrim($ConditionAsString, ' AND');

            $SQLQueryString = str_replace("<?>", $ConditionAsString, $SQLQueryString);

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

$NewConnection = new MaConnexion("notre_monde", "root", "", "localhost");
    // var_dump($Result = $NewConnection->select("circuit", "visible", "1"));
