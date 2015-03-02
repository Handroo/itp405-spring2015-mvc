<!DOCTYPE html>
<html>
<head>
    <title>Add DVD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
        <!--    --><?php //var_dump($errors) ?>
        <?php foreach($errors->all() as $errorMessage):?>
            <p style="color:red;">
                <?php echo $errorMessage?>
            </p>
        <?php endforeach ?>
    <div style="background-color: greenyellow;">
        <?php if (Session::has('success')) : ?>
            <p>
                <?php echo Session::get('success') ?>
            </p>
        <?php endif ?>
    </div>

    <form method="post" action="<?php echo url("/dvds/createDvdSubmit")?>">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
        <div class="form-group">
            <label>Title:</label>
            <input name="title" class="form-control" value="<?php echo Request::old('title')?>">
        </div>
        Genre:
        <div class="form-group">
            <select class="form-control" name="genre">
<!--                <option> All </option>-->
                <?php foreach($genres as $genre) : ?>
                    <?php if ($genre->id == Request::old('genre')) : ?>
                        <?php echo " <option selected=\"selected\" value=\" $genre->id \"> $genre->genre_name </option>"?>
                    <?php else :?>
                        <?php echo " <option value=\" $genre->id \"> $genre->genre_name </option>"?>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        Labels:
        <div class="form-group">
            <select class="form-control" name="label">
<!--                <option> All </option>-->
                <?php foreach($labels as $label) : ?>
                    <?php if ($label->id == Request::old('label')) : ?>
                        <?php echo " <option selected=\"selected\" value=\" $label->id \"> $label->label_name </option>"?>
                    <?php else :?>
                        <?php echo " <option value=\" $label->id \"> $label->label_name </option>"?>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        Sound:
        <div class="form-group">
            <select class="form-control" name="sound">
<!--                <option> All </option>-->
                <?php foreach($sounds as $sound) : ?>
                    <?php if ($sound->id == Request::old('sound')) : ?>
                        <?php echo " <option selected=\"selected\" value=\" $sound->id \"> $sound->sound_name </option>"?>
                    <?php else :?>
                        <?php echo " <option value=\" $sound->id \"> $sound->sound_name </option>"?>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        Rating:
        <div class="form-group">
            <select class="form-control" name="rating">
<!--                <option> All </option>-->
                <?php foreach($ratings as $rating) : ?>
                    <?php if ($rating->id == Request::old('rating')) : ?>
                        <?php echo " <option selected=\"selected\" value=\" $rating->id \"> $rating->rating_name </option>"?>
                    <?php else :?>
                        <?php echo " <option value=\" $rating->id \"> $rating->rating_name </option>"?>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        Format:
        <div class="form-group">
            <select class="form-control" name="format">
<!--                <option> All </option>-->
                <?php foreach($formats as $format) : ?>
                    <?php if ($format->id == Request::old('format')) : ?>
                        <?php echo " <option selected=\"selected\" value=\" $format->id \"> $format->format_name </option>"?>
                    <?php else :?>
                        <?php echo " <option value=\" $format->id \"> $format->format_name </option>"?>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>

</body>
</html>