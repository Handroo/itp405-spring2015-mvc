<!doctype html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<head>
    <title>DVD Review</title>
</head>
<style>
    .middleBox{
        margin-left:10%;
        margin-right:10%;
    }
</style>
<body>
<?php $dvd = $dvdInfo[0]?>
<h1 class="text-center">Review for <?php echo $dvd->title?></h1>
<table class="table table-bordered">
    <thread>
        <tr>
            <th>Title</th>
            <th>Rating</th>
            <th>Genre</th>
            <th>Label</th>
            <th>Sound</th>
            <th>Format</th>
            <th>Release Date</th>
        </tr>
    </thread>
    <tbody>
        <tr>
            <td><?php echo $dvd->title ?></td>
            <td><?php echo $dvd->rating_name ?></td>
            <td><?php echo $dvd->genre_name ?></td>
            <td><?php echo $dvd->label_name ?></td>
            <td><?php echo $dvd->sound_name ?></td>
            <td><?php echo $dvd->format_name ?></td>
            <td><?php echo DATE_FORMAT(new DateTime($dvd->release_date),'F d Y \, h:ia ') ?></td>
        </tr>
    </tbody>
</table>

<div style="border: solid black 2px; padding:10px;" class="middleBox">
<h4 class="text-center">Submit a Review!</h4>
<form style="margin-left:35%;" class="form-inline" action="<?php echo url("/dvds/submitReview")?>" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="form-group">
        Title:
        <input class="form-control" type="text" name="title" placeholder="Review Title" value="<?php echo Request::old('title')?>">
    </div>
    &nbsp; Rating:
    <div class="form-group">
                <select class="form-control" name="rating">
                    <?php foreach($ratingRange as $rating):?>
                        <?php if ($rating == Request::old('rating')) : ?>
                            <option selected="selected">
                                <?php echo $rating?>
                            </option>
                        <?php else :?>
                            <option>
                                <?php echo $rating?>
                            </option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
    </div><br><br>
    <div class="form-group">
        Review:<br>
        <textarea rows="4" cols="50" class="form-control" name="comment"  placeholder="Description"><?php echo Request::old('comment')?></textarea>
    </div>
    <input type="hidden" name="dvd_id" value="<?php echo $dvd->dvd_id; ?>">
    <br><br>
    <div class="form-group">
        <input class="form-control btn btn-success" type="submit" name="submitReview">
    </div><br><br>
    <?php foreach($errors->all() as $errorMessage):?>
        <p style="color:red;">
            <?php echo $errorMessage?>
        </p>
    <?php endforeach ?>
    <?php if (Session::has('success')) : ?>
        <p style="color:green;">
            <?php echo Session::get('success') ?>
        </p>
    <?php endif ?>
</form>
</div>


<div class="middleBox">
<h4 class="text-center">Previous Reviews</h4>
<table class="table table-bordered">
    <thread>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Rating</th>
        </tr>
    </thread>
    <tbody>
        <?php foreach($dvdReviews as $review):?>
         <tr>
               <td><?php echo $review->title ?></td>
              <td><?php echo $review->description ?></td>
              <td><?php echo $review->rating ?></td>
         </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>

</body>
</html>