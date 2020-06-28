<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $title ;?></title>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic:wght@400;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="Public/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php require('header.php') ;?>
    <div class="wrapper">
        <section id="main">
            <div id="corpsDePage">
            <!-- Debut partie changeante en fonction de l'onglet -->
            <?= $content ?>
            <!-- Fin partie changeante -->
            </div>

            <section id="rightMenu">
                <aside id="biographie">
                    <img id="asideImg" src="Public/images/ecrivain.png">
                    <h1>A propos de l'auteur...</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus orci nunc, nec pretium
                        mauris
                        bibendum sit amet. Vivamus in lorem non lorem efficitur congue sed at diam. Suspendisse eget
                        erat
                        nisl. Pellentesque ornare vel metus eu tempus. Vivamus non iaculis dolor, et placerat velit.
                        Donec
                        enim arcu, placerat non placerat vitae, dignissim ut massa. Proin in urna porta nibh rutrum
                        blandit.
                        Integer ut nisi nec dui porttitor hendrerit. Nulla interdum dolor lorem, vitae blandit nulla
                        efficitur et. Maecenas cursus ut magna a cursus.
                    </p>
                </aside>
                <aside id="portefolio">
                    <h1>Portefolio</h1>
                    <div>
                        <figure>
                            <img src="Public/images/couverture1.jpg" alt="image de livre">
                            <figcaption class="ficaptionPortefolio">
                                Juvenia, le premier livre de l'auteur
                            </figcaption>
                        </figure>
                        <figure>
                            <img src="Public/images/couverture2.jpg" alt="image de livre">
                            <figcaption class="ficaptionPortefolio">
                                Deuxieme superbe livre de l'auteur, un succes !
                            </figcaption>
                        </figure>
                        <figure>
                            <img src="Public/images/couverture3.jpg" alt="image de livre">
                            <figcaption class="ficaptionPortefolio">
                                Jamais deux sans trois !
                            </figcaption>
                        </figure>
                    </div>
                </aside>
            </section>
        </section>
    </div>
    <?php require('footer.php') ;?>
</body>

</html>