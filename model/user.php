<?php
class User {
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

        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $result = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $result;

    }
    
    public function getBy($value){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->table . " WHERE wallet_id = :wallet_id");
        $consultation->execute(array('wallet_id' => $value));
        $result = $consultation->fetchAll();
        $this->Connection = null; //connection closure
        return $result;
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
