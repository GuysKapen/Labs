<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3>Search Post</h1>
        <br>
        <hr>
        <form action="">
            <input type="text" name="keyword" value="<?php echo htmlentities($_GET['keyword'])?>">
            <button type="submit">Search</button>
        </form>



        <?php if (isset($_GET['keyword'])) {
            include('search_func.php');
            search($_GET['keyword']);
        } ?>
</body>

</html>