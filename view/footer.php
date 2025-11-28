<?php
//Création de la classe Footer :
class Footer{
    //Attributs :
    private ?string $title = "";
    private string $content = "";
    private string $style = "";
    
    //Constructeur
    public function __construct(){}

    //Guetters et setters :
    public function getTitle():string{
        return $this->title;
    }

    public function setTitle(string $newTitle):Footer{
        $this->title=$newTitle;
        return $this;
    }

    public function getContent():string{
        return $this->content;
    }

    public function setContent(string $newContent):Footer{
        $this->content = $newContent;
        return $this;
    }
        public function getStyle():string{
        return $this->style;
    }

    public function setStyle(string $newStyle):Footer{
        $this->style=$newStyle;
        return $this;
    }
    
    //Methode pour afficher le footer :
    public function renderFooter(){
        return "</main>
                <footer>
                     <p>{$this->getContent()}</p>
                    
                </footer>
            </body>
            </html>";
    }
}
?>