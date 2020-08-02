<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $title ;?></title>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic:wght@400;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="Public/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/cxy8mcbrf7b9ewpuib9hf7pwuo5fymzll4e7ql35y7vhs3jv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
                        Né en 1974 à Antibes, il se prend de passion pour la littérature très jeune, consacrant tout son temps libre à dévorer des livres dans la bibliothèque municipale où travaille sa mère. C’est grâce à un concours de nouvelles proposé par son professeur de français qu’il découvre le bonheur de l’écriture. À compter de ce jour, et jusqu’à aujourd’hui, il ne cessera plus de noircir des carnets.
                    </p>
                    <p>
                        Ses études, son long voyage aux États-Unis, ses rencontres, tout vient enrichir son imagination et ses projets de roman. Diplômé de sciences économiques, il devient professeur dans l’est puis le sud de la France. 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="Public/admin.js"></script>
    <script type="text/javascript" src="Public/tinyMce.js"></script>
</body>

</html>