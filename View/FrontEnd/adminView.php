<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Administrateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic:wght@400;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../../Public/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<?php require('header.php') ;?>
	<div id="TinyMCE">
		
	</div>

	<div id="commentsValidator">
		<?php echo $reportedComments; ?>
	</div>
	<?php require('footer.php') ;?>
</body>

</html>