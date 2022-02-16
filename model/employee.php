<?php
class Employee {
    private $table = "transactions";
    private $Connection;

    public function __construct($Connection) {
		$this->Connection = $Connection;
    }

    public function getId() {
        return $this->id;
    }

    public function setWalletID($WalletID) {
        $this->wallet_id = $WalletID;
    }

    public function getWalletID() {
        return $this->wallet_id;
    }

    public function setTransactionID($TransactionID) {
        $this->transaction = $TransactionID;
    }

    public function getTransactionID() {
        return $this->transaction;
    }

    public function setImgPath($imgPath) {
        $this->img_path = $imgPath;
    }

    public function getImgPath() {
        return $this->img_path;
    }

    public function save(){

        $consultation = $this->Connection->prepare("INSERT INTO " . $this->table . " (wallet_id,transaction,img_path)
                                        VALUES (:wallet_id,:transaction,:img_path)");
        $result = $consultation->execute(array(
            "wallet_id" => $this->wallet_id,
            "transaction" => $this->transaction,
            "img_path" => $this->img_path
        ));
        $this->Connection = null;

        return $result;
    }   
    
    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT id,wallet_id,transaction,img_path FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;

    }
    
    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT id,wallet_id,transaction,img_path
                                                FROM " . $this->table . " WHERE :column = :value");
        $consultation->execute(array(
            "column" => $column,
            "value" => $value
        ));
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //connection closure
        return $resultados;
    }

    public function deleteByID($id){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE id=?");
            $consultation->execute([$id]);
            $this->Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteBy): ' . $e->getMessage();
            return -1;
        }
    }
    
}
?>
