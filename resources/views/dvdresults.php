<!doctype html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<head>
    <title>DVD Results</title>
</head>
<body>

<h3>
    You searched for "<?php echo $dvd_title ?>" in "<?php echo $genre ?>" genre and "<?php echo $rating ?>" rating.
</h3>
<!---->
<table class="table table-bordered">
    <thread>
        <tr>
<!--            <th>Artist</th>-->
            <th>Title</th>
            <th>Rating</th>
            <th>Genre</th>
            <th>Label</th>
            <th>Sound</th>
            <th>Format</th>
            <th>Release Date</th>
            <th>Reviews</th>
        </tr>
    </thread>
    <tbody>
    <?php foreach($dvds as $dvd):?>
        <tr>
            <td><?php echo $dvd->title ?></td>
            <td><?php echo $dvd->rating_name ?></td>
            <td><?php echo $dvd->genre_name ?></td>
            <td><?php echo $dvd->label_name ?></td>
            <td><?php echo $dvd->sound_name ?></td>
            <td><?php echo $dvd->format_name ?></td>
            <td><?php echo DATE_FORMAT(new DateTime($dvd->release_date),'F d Y \, h:ia ') ?></td>
            <td><a href="<?php echo "dvds/".$dvd->dvd_id ?>">Review</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

</body>
</html>