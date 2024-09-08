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
        $this->price = $price;
        $this->link = $link;
        $this->img = $img;
    }

    public function removeBG()
    {
        $image_url = $this->img;

        // 6Jd4fzjBp24GWuUGFTWihKo2, GH4DH8AWqmCHPhCNouRK92U2
        $api_key = '6Jd4fzjBp24GWuUGFTWihKo2';

        // Setup der Daten für den API-Request
        $data = [
            'image_url' => $image_url,
            'size' => 'auto',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Api-Key: ' . $api_key,
        ]);

        // Response von der API
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Fehler: ' . curl_error($ch);
        } else {
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == 200) {
                // Verzeichnis für das Bild überprüfen und erstellen, falls es nicht existiert
                $directory = __DIR__ . '/../public/assets/img/items/';
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
                // Speichern des Bildes im Ordner img mit dem Namen schuh.png
                $image_path = $directory . '/'.$this->title.'.png';
                file_put_contents($image_path, $response);
            } else {
                // Fehler anzeigen
                echo 'Fehler beim Entfernen des Hintergrunds. Status Code: ' . $http_code . '<br>';
                echo 'API-Antwort: ' . $response;
            }
        }
        curl_close($ch);
    }

    function cropImageToContent() {

        $directory = __DIR__ . '/../public/assets/img/items/';
        $image = $directory .$this->title.'.png';
        $imagePath = $directory .$this->title.'.png';

        if (!file_exists($imagePath)) {
            die("Fehler: Die Datei '$imagePath' existiert nicht.");
        }

        // Versuche, das Bild zu laden
        $image = imagecreatefrompng($imagePath); // oder imagecreatefromjpeg() bei JPEG-Bildern

        // Überprüfe, ob das Bild korrekt geladen wurde
        if (!$image) {
            die("Fehler: Das Bild konnte nicht geladen werden. Stelle sicher, dass es sich um ein PNG-Bild handelt und der Pfad korrekt ist.");
        }

        // Bilddimensionen abfragen
        $width = imagesx($image);
        $height = imagesy($image);

        // Bestimme den Inhalt (keine transparenten oder weißen Bereiche)
        $left = $width;
        $right = 0;
        $top = $height;
        $bottom = 0;

        // Schleife durch alle Pixel
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $color = imagecolorat($image, $x, $y);
                $alpha = ($color >> 24) & 0x7F; // Transparenzwert

                if ($alpha < 127) { // Wenn das Pixel nicht vollständig transparent ist
                    if ($x < $left) $left = $x;
                    if ($x > $right) $right = $x;
                    if ($y < $top) $top = $y;
                    if ($y > $bottom) $bottom = $y;
                }
            }
        }

        // Neue Dimensionen berechnen
        $newWidth = $right - $left + 1;
        $newHeight = $bottom - $top + 1;

        // Neues Bild erstellen und zuschneiden
        $croppedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($croppedImage, false);
        imagesavealpha($croppedImage, true);
        imagecopy($croppedImage, $image, 0, 0, $left, $top, $newWidth, $newHeight);

        // Das Bild speichern und das ursprüngliche überschreiben
        imagepng($croppedImage, $imagePath); // Überschreibt das Originalbild
        imagedestroy($image);
        imagedestroy($croppedImage);

        echo "Das Bild wurde erfolgreich zugeschnitten und ersetzt!";
    }

    public function insert()
    {
        // Construct the file path with the title as the filename
        $filePath = __DIR__ . '/../items/items.php';
        $content = file_get_contents($filePath);

        // Generate the content and write it to the file
        file_put_contents($filePath,$content . $this->generate());
    }

    public function generate()
    {
        // Generate the PHP content as a string
        return "
    <div class='col-12 col-md-6 col-lg-4'>
    <div class='item'>
        <div>
        <img src='/assets/img/items/" . $this->title .".png' id='outputImage'> 
        <h1>" . htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8') . "</h1> 
        <div>
            <p>" . htmlspecialchars($this->price, ENT_QUOTES, 'UTF-8') . "</p> 
            <a class='cssanimation sequence leAboundTop' href='" . htmlspecialchars($this->link, ENT_QUOTES, 'UTF-8') . "'>Hier zum Produkt</a> 
        </div>
        </div>
        </div>
    </div>";
    }
}