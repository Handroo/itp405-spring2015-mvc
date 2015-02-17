<!doctype html>
<html>
<head>
    <title>Song Search</title>
</head>
<body>

<p>
    You searched for <?php echo $song_title ?>
</p>

<table>
    <thread>
        <tr>
            <th>Artist</th>
            <th>Title</th>
            <th>Genre</th>
        </tr>
    </thread>
    <tbody>
    <?php foreach($songs as $song):?>
       <tr>
           <td><?php echo $song->artist_name ?></td>
           <td><?php echo $song->title ?></td>
           <td><?php echo $song->genre ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

</body>
</html>