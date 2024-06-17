<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forum</title>
</head>
<body>
    <br><br>
    <form action="forum.php" class="container" method="POST">
        <div>
            <label for="exampleInputEmail" class="">Titre de la question</label>
            <input type="text" name="titre">
        </div>
        <div>
            <label for="exampleInputEmail" class="">Description de la question</label>
            <textarea name="description"></textarea>
        </div>
        <div>
        <label for="exampleInputEmail" class="">Contenue de la question</label>
            <textarea name="contenu"></textarea>
        </div>

        <button type="submit" class="" name="validate">Publier la question</button>
    </form>
</body>
</html>