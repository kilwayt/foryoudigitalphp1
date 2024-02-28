<?php
class Database {
    private $host = 'localhost:3307';
    private $dbname = 'soutenance1';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn; // Return the connection object
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit(); // Stop script execution if connection fails
        }
    }
    public function query($sql) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            echo "Query execution failed: " . $e->getMessage();
            return null;
        }
    }


    public function insertClient($name, $link, $email, $phone, $platform) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("INSERT INTO clients (name, link, email, phone, id_platform) VALUES (:name, :link, :email, :phone, :platform)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':platform', $platform);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Insertion failed: " . $e->getMessage();
        }
    }

    public function updateClient($id, $name, $link, $email, $phone, $platform) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("UPDATE clients SET name = :name, link = :link, email = :email, phone = :phone, id_platform = :platform WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':platform', $platform);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }

    public function deleteClientById($id) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("DELETE FROM clients WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Deletion failed: " . $e->getMessage();
        }
    }

    public function deleteAchatById($achatId) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("DELETE FROM achats WHERE id = :id");
            $stmt->bindParam(':id', $achatId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Deletion failed: " . $e->getMessage();
        }
    }

    public function insertProduct($categorie, $Periode, $description, $prix, $start_date, $end_date) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("INSERT INTO produit (categorie, Periode, description, prix, start_date, end_date) VALUES (:categorie, :Periode, :description, :prix, :start_date, :end_date)");
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':Periode', $Periode);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Insertion failed: " . $e->getMessage();
        }
    }

    public function getAllProduits() {
        try {
            $this->connect(); // Ensure database connection
            $stmt = $this->conn->prepare("SELECT id, categorie, Periode FROM produit");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch products: " . $e->getMessage();
            return [];
        }
    }

    public function getProduitById($id) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT * FROM produit WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch product: " . $e->getMessage();
            return null;
        }
    }

    public function getAllProduit() {
        try {
            $this->connect(); // Ensure database connection
            $stmt = $this->conn->prepare("SELECT * FROM produit"); // Assuming "produit" is the name of your product table
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch products: " . $e->getMessage();
            return [];
        }
    }

    public function deleteProduit($productId) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("DELETE FROM produit WHERE id = :id");
            $stmt->bindParam(':id', $productId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Deletion failed: " . $e->getMessage();
        }
    }

    public function getAllFournisseurs() {
        try {
            $this->connect(); // Ensure database connection
            $stmt = $this->conn->prepare("SELECT id, name_fournisseur, link_fournisseur FROM fournisseurs");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch fournisseurs: " . $e->getMessage();
            return [];
        }
    }

    public function deleteFournisseur($fournisseurId) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("DELETE FROM fournisseurs WHERE id = :id");
            $stmt->bindParam(':id', $fournisseurId);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Deletion failed: " . $e->getMessage();
        }
    }

    public function updateFournisseur($id, $name_fournisseur, $link_fournisseur) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("UPDATE fournisseurs SET name_fournisseur = :name_fournisseur, link_fournisseur = :link_fournisseur WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name_fournisseur', $name_fournisseur);
            $stmt->bindParam(':link_fournisseur', $link_fournisseur);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }

    public function getFournisseurById($id) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT * FROM fournisseurs WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch fournisseur: " . $e->getMessage();
            return null;
        }
    }

    public function gettwoClients() {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT id , name FROM clients");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch clients: " . $e->getMessage();
            return [];
        }
    }

    public function getAllClients() {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT clients.id, clients.name, clients.link, clients.email, clients.phone, platform.name AS platform_name FROM clients LEFT JOIN platform ON clients.id_platform = platform.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch clients: " . $e->getMessage();
            return [];
        }
    }

    public function insertVente($client_id, $id_produit, $description, $prix, $date_vente) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("INSERT INTO ventes (client_id, id_produit, description, prix, date_vente) VALUES (:client_id, :id_produit, :description, :prix, :date_vente)");
            $stmt->bindParam(':client_id', $client_id);
            $stmt->bindParam(':id_produit', $id_produit);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':date_vente', $date_vente);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Insertion failed: " . $e->getMessage();
        }
    }

    public function getAllVentes() {
        try {
            // Ensure database connection
            $conn = $this->connect();
            
            // Prepare and execute the query
            $stmt = $conn->prepare("SELECT * FROM ventes");
            $stmt->execute();
            
            // Fetch and return the result
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getVenteById($id) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT * FROM ventes WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch vente: " . $e->getMessage();
            return null;
        }
    }
    public function getClientById($clientId) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT * FROM clients WHERE id = :id");
            $stmt->bindParam(':id', $clientId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch client: " . $e->getMessage();
            return null;
        }
    }
    

    public function updateVente($id, $client_id, $id_produit, $description, $prix, $date_vente) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("UPDATE ventes SET client_id = :client_id, id_produit = :id_produit, description = :description, prix = :prix, date_vente = :date_vente WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':client_id', $client_id);
            $stmt->bindParam(':id_produit', $id_produit);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':date_vente', $date_vente);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }

    public function deleteVenteById($id) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("DELETE FROM ventes WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Deletion failed: " . $e->getMessage();
        }
    }

    public function insertFournisseur($name_fournisseur, $link_fournisseur) {
        try {
            $this->connect(); // Ensure database connection
            $stmt = $this->conn->prepare("INSERT INTO fournisseurs (name_fournisseur, link_fournisseur) VALUES (:name_fournisseur, :link_fournisseur)");
            $stmt->bindParam(':name_fournisseur', $name_fournisseur);
            $stmt->bindParam(':link_fournisseur', $link_fournisseur);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Insertion failed: " . $e->getMessage();
        }
    }

    public function insertachat($fournisseur_id, $produit_id, $date_achat) {
        try {
            $this->connect(); // Ensure database connection
            $stmt = $this->conn->prepare("INSERT INTO achats (fournisseur_id, produit_id, date_achat) VALUES (:fournisseur_id, :produit_id, :date_achat)");
            $stmt->bindParam(':fournisseur_id', $fournisseur_id);
            $stmt->bindParam(':produit_id', $produit_id);
            $stmt->bindParam(':date_achat', $date_achat);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Insertion failed: " . $e->getMessage();
        }
    }

    public function getAllAchats() {
        try {
            // Ensure database connection
            $conn = $this->connect();
            
            // Prepare and execute the query
            $stmt = $conn->prepare("SELECT achats.id, fournisseurs.name_fournisseur, produit.categorie, produit.Periode, achats.date_achat 
                                      FROM achats 
                                      JOIN fournisseurs ON achats.fournisseur_id = fournisseurs.id 
                                      JOIN produit ON achats.produit_id = produit.id");
            $stmt->execute();
            
            // Fetch and return the result
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            // Handle any errors
            echo "Failed to fetch achats: " . $e->getMessage();
            return [];
        }
    }

    public function updateAchat($achatId, $fournisseurId, $produitId, $dateAchat) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("UPDATE achats SET fournisseur_id = :fournisseur_id, produit_id = :produit_id, date_achat = :date_achat WHERE id = :id");
            $stmt->bindParam(':id', $achatId);
            $stmt->bindParam(':fournisseur_id', $fournisseurId);
            $stmt->bindParam(':produit_id', $produitId);
            $stmt->bindParam(':date_achat', $dateAchat);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }

    public function getAchatById($id) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("SELECT * FROM achats WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed to fetch achat: " . $e->getMessage();
            return null;
        }
    }

    public function updateProduct($product_id, $categorie, $periode, $description, $prix, $start_date, $end_date) {
        try {
            $conn = $this->connect(); // Ensure database connection
            $stmt = $conn->prepare("UPDATE produit SET categorie = :categorie, Periode = :periode, description = :description, prix = :prix, start_date = :start_date, end_date = :end_date WHERE id = :id");
            $stmt->bindParam(':id', $product_id);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':periode', $periode);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }
}
?>
