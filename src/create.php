<?php
class product
{
    private $title;
    private $img;
    private $price;
    private $link;

    public function __construct($title, $img, $price, $link)
    {
        $this->title = $title;
        $this->img = $img;
        $this->price = $price;
        $this->link = $link;
    }

    public function insert()
    {
        // Construct the file path with the title as the filename
        $filePath = __DIR__ . '/../items/' . $this->title . '.php';

        // Generate the content and write it to the file
        file_put_contents($filePath, $this->generate());
    }

    public function generate()
    {
        // Generate the PHP content as a string
        return "
    <div class='col-12 col-md-6 col-lg-3'>
    <div class='item'>
        <img src='" . htmlspecialchars($this->img, ENT_QUOTES, 'UTF-8') . "'> 
        <h1>" . htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8') . "</h1> 
        <div>
            <p>" . htmlspecialchars($this->price, ENT_QUOTES, 'UTF-8') . "</p> 
            <a href='" . htmlspecialchars($this->link, ENT_QUOTES, 'UTF-8') . "'>Hier zum Produkt.</a> 
        </div>
        </div>
    </div>";

    }
}