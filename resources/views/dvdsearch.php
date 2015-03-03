<!doctype html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<head>
    <title>DVD Search</title>
</head>
<body>
<div style="border:black solid 2px; float:left; width:15%;padding:15px;">
    <?php foreach($genres as $genre) : ?>
       <?php $n = rawurlencode(rawurlencode($genre->genre_name)) ?>
        <?php echo "<a href=\" /genres/$n/dvds \"> $genre->genre_name </a>"?><br>
    <?php endforeach ?>
</div>
<div style="position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 300px;
  width: 700px;
  padding: 50px;">

    <h1 style="text-align: center; padding:20px;">DVD Search</h1>
    <form class="form-inline" action="/dvds" method="get">
        <div class="form-group">
            <input class="form-control" type="text" name="dvd_title" placeholder="DVD Title">
        </div>
        <div class="form-group">
            <select class="form-control" name="genre">
                <option> All </option>
                <?php foreach($genres as $genre) : ?>
                    <?php echo " <option> $genre->genre_name </option>"?>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="rating">
                <option> All </option>
                <?php foreach($ratings as $rating) : ?>
                    <?php echo " <option> $rating->rating_name </option>"?>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <input class="form-control btn btn-success" type="submit" name="search">
        </div>
    </form>

</div>

</body>
</html>