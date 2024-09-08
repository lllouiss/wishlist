<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sequenceElements = document.getElementsByClassName('sequence');

        for (let i = 0; i < sequenceElements.length; i++) {
            sequenceElements[i].addEventListener('mouseover', function () {
                if (!this.classList.contains('animated')) {
                    animateSequence(this);
                    this.classList.add('animated');
                }
            });

            sequenceElements[i].addEventListener('mouseleave', function () {
                resetAnimation(this); // Text auf den ursprünglichen Zustand zurücksetzen
                this.classList.remove('animated');
            });
        }
    });

    function animateSequence(element) {
        var originalText = element.getAttribute('data-original-text') || element.textContent.trim();
        if (!element.getAttribute('data-original-text')) {
            element.setAttribute('data-original-text', originalText); // Ursprünglichen Text speichern
        }

        var str = '';
        var delay = 100;

        for (let l = 0; l < originalText.length; l++) {
            if (originalText[l] !== ' ') {
                str += "<span style='display:inline-block; animation-delay:" + delay + "ms;'>" + originalText[l] + "</span>";
                delay += 150;
            } else {
                str += ' '; // Normales Leerzeichen
            }
        }
        element.innerHTML = str; // HTML-Inhalt für Animation setzen
    }

    function resetAnimation(element) {
        var originalText = element.getAttribute('data-original-text'); // Ursprünglichen Text abrufen
        element.innerHTML = originalText; // Text auf ursprünglichen Zustand zurücksetzen
    }

</script>

<div class='col-12 col-md-6 col-lg-4'>
    <div class='item'>
        <div>
            <img src='/assets/img/items/Baggys.png' id='outputImage'>
            <h1>Baggys</h1>
            <div>
                <p>CHF 69.90</p>
                <a class='cssanimation sequence leAboundTop'
                   href='https://www.zalando.ch/bershka-mega-baggy-jeans-relaxed-fit-dark-grey-bej22g0bm-c11.html'>Hier
                    zum Produkt</a>
            </div>
        </div>
    </div>
</div>

<div class='col-12 col-md-6 col-lg-4'>
    <div class='item'>
        <div>
            <img src='/assets/img/items/Sneaks.png' id='outputImage'>
            <h1>Sneaks</h1>
            <div>
                <p>CHF 69.90</p>
                <a class='cssanimation sequence leAboundTop'
                   href='https://www.bershka.com/ch/herren-sneaker-im-skate-stil-mit-dicker-sohle-c0p162286249.html?colorId=004'>Hier
                    zum Produkt</a>
            </div>
        </div>
    </div>
</div>

<div class='col-12 col-md-6 col-lg-4'>
    <div class='item'>
        <div>
            <img src='/assets/img/items/Zipper.png' id='outputImage'>
            <h1>Zipper</h1>
            <div>
                <p>CHF 29.24</p>
                <a class='cssanimation sequence leAboundTop'
                   href='https://www.zalando.ch/def-zip-hoody-sweatjacke-green-washed-d6622s00a-m12.html'>Hier zum
                    Produkt</a>
            </div>
        </div>
    </div>
</div>
<div class='col-12 col-md-6 col-lg-4'>
    <div class='item'>
        <div>
            <img src='/assets/img/items/Sleeve.png' id='outputImage'>
            <h1>Sleeve</h1>
            <div>
                <p>CHF 49.90</p>
                <a class='cssanimation sequence leAboundTop'
                   href='https://www.zalando.ch/bershka-short-sleeve-t-shirt-print-green-off-white-bej22o13f-t11.html'>Hier
                    zum Produkt</a>
            </div>
        </div>
    </div>
</div>
<div class='col-12 col-md-6 col-lg-4'>
    <div class='item'>
        <div>
            <img src='/assets/img/items/Stricker.png' id='outputImage'>
            <h1>Stricker</h1>
            <div>
                <p>CHF 45.90</p>
                <a class='cssanimation sequence leAboundTop'
                   href='https://www.bershka.com/ch/pullover-im-washed-look-c0p169784651.html?colorId=900&amp;stylismId=1'>Hier
                    zum Produkt</a>
            </div>
        </div>
    </div>
</div>