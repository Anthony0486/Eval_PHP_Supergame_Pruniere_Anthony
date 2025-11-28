<!-- VIEW DE LA PAGE D'ACCUEIL -->

<?php
//Création de la classe ViewHome :
class ViewHome {
    //Attributs :
    private ?string $title = "";
    private ?string $content = "";
    private ?string $style = "";

    private ?string $message = "";

    private ?string $list= "";

    //Constructeur:
    public function __construct(){}
        
    //Guetters et setters :
    public function getTitle():string{
        return $this->title;
    }

    public function setTitle(string $newTitle):ViewHome{
        $this->title=$newTitle;
        return $this;
    }

    public function getContent():string{
        return $this->content;
    }

    public function setContent(string $newContent):ViewHome{
        $this->content = $newContent;
        return $this;
    }

    public function getStyle():string{
        return $this->style;
    }

    public function setStyle(string $newStyle):ViewHome{
        $this->style=$newStyle;
        return $this;
    }

    public function getMessage():string{
        return $this->message;
    }
    public function setMessage(string $message):ViewHome{
        $this->message=$message;
        return $this;
    }

    public function setList(string $list):ViewHome{
        $this->list=$list;
        return $this;
    }

    public function getList():string{
        return $this->list;
    }

    //Methode pour afficher la vue :
    public function renderHome(){
        return "<h2>Supergame</h2>
                <section>
                    <fieldset>
                    <legend>Enregistrer nouveau joueur</legend>
                        <form method='POST' style='width: 300px; display: flex; flex-direction : column;'>
                            <label for='pseudo'>Pseudo</label><input type='text' name='pseudo' id='pseudo'>
                            <label for='email'>Email</label><input type='email' name='email' id='email'>
                            <label for='score'>Score</label><input type='score' name='score' id='score'>
                            <label for='password'>Mot de passe</label><input type='text' name='password' id='password'>
                            <label for='passwordVerify'>Retappez votre Mot de passe</label><input type='text' name='passwordVerify' id='passwordVerify'>
                            <input type='submit' name='submit' id='submit' value='Envoyer'>
                            <?php echo <p>{$this->message}</p>
                        </form>
                    </fieldset>
                </section>
                <section>
                    <h3>Liste des joueurs :</h3>
                     ".$this->list."
                </section>";
        }

}

?>



