<?php
//MODEL POUR LA CLASS MODELPLAYER

//Création de la classe Players :
class Players {
    //Attributs :
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?int $score;
    private ?string $password;
    private ?PDO $bdd;

    //Constructeur avec objet bdd obligatoire et autres arguments optionnels :
    public function __construct(PDO $bdd, ?string $pseudo = null, ?string $email = null, ?int $score = null, ?string $password = null){
        $this->bdd = $bdd;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->score = $score;
        $this->password = $password;
    }

    //Guetters et setters :
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }
    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self {
        $this->pseudo = $pseudo;
        return $this;
    }

     public function getEmail(): ?string {
        return $this->email;
    }
    public function setEmail(?string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getScore(): ?int {
        return $this->score;
    }
    public function setScore(?int $score): self {
        $this->score = $score;
        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): self {
        $this->password = $password;
        return $this;
    }


    public function getBdd(): ?PDO {
        return $this->bdd;
    }

    public function setBdd(?PDO $bdd): self {
        $this->bdd = $bdd;
        return $this;
    }

    //Methode pour creer un joueur :
    public function addPlayer(){
        try{
            $req = $this->getBDD()->prepare("INSERT INTO players (pseudo, email, score, psswrd) VALUES (?,?,?,?)");

            
            $pseudo = $this->getPseudo();
            $email = $this->getEmail();
            $score = $this->getScore();
            $password = $this->getPassword();
            
            $req->bindParam(1,$pseudo,PDO::PARAM_STR);
            $req->bindParam(2,$email,PDO::PARAM_STR);
            $req->bindParam(3,$score,PDO::PARAM_INT);
            $req->bindParam(4,$password,PDO::PARAM_STR);

            $req->execute();
           
            $req = $this->getBDD()->prepare('SELECT p.id FROM players p WHERE p.id = ? ORDER BY p.id DESC LIMIT 1');

            $req->bindParam(1,$id,PDO::PARAM_INT);

            $req->execute();

            $id = $this->getBDD()->lastInsertId();

            return [
            "message" => "$pseudo a été ajouté à la liste des joueurs",
            "id" => $id
            ];

        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }

    //Methode pour récuperer un joueur :
    function getPlayers(){
        try{

            $req = $this->getBDD()->prepare("SELECT p.pseudo, p.email, p.score FROM players p");

            $req->execute();

            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            return $data;

            }catch(EXCEPTION $error){
                die($error->getMessage());
            }
    }

    //Methode pour récuperer un joueur avec son email:
    public function getPlayerByMail():array{
        try{
            $req = $this->getBDD()->prepare("SELECT p.id, p.pseudo, p.email, p.psswrd FROM players p WHERE p.email = ? LIMIT 1");
            $email = $this->getEmail();
            $req->bindParam(1,$email,PDO::PARAM_STR);

            $req->execute();

            $data = $req->fetchAll();

            print_r($data);

            return $data;

            }catch(EXCEPTION $error){
                die($error->getMessage());
            }
        }


}






?>