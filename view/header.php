<?php
//Création de la classe Header :
class Header {
    //Attributs :
    private ?string $title = "";
    private ?string $content = "";
    private ?string $style = "";

   //Constructeur:
    public function __construct(){}

    //Guetters et setters :
    public function getTitle():string{
        return $this->title;
    }

    public function setTitle(string $newTitle):Header{
        $this->title=$newTitle;
        return $this;
    }

    public function getContent():string{
        return $this->content;
    }

    public function setContent(string $newContent):Header{
        $this->content = $newContent;
        return $this;
    }

    public function getStyle():string{
        return $this->style;
    }

    public function setStyle(string $newStyle):Header{
        $this->style=$newStyle;
        return $this;
    }

    //Methode pour afficher le header :
        public function renderHeader(){
        return "<!DOCTYPE html>
                <html lang='en'>
                <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Document</title>
                </head>
                    <body>
                        <header>
                            <nav>
                                <h1>{$this->getContent()}</h1>
                            </nav>
                        </header>
                    <main>";
        }
}

?>



