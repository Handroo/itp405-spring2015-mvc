@extends('dvdresultlayout')

@section('content')

<h3>
    You searched for "{{ $dvd_title }}" in "{{ $genre }}" genre and "{{ $rating }}" rating.
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
    @foreach($dvds as $dvd)
    <tr>
        <td>{{$dvd->title}}</td>
        <td>{{$dvd->rating_name }}</td>
        <td>{{ $dvd->genre_name }}</td>
        <td>{{ $dvd->label_name }}</td>
        <td>{{ $dvd->sound_name }}</td>
        <td>{{ $dvd->format_name }}</td>
        <td>{{ DATE_FORMAT(new DateTime($dvd->release_date),'F d Y \, h:ia ') }}</td>
        <td><a href="{{ "/dvds/".$dvd->dvd_id }}">Review</a></td>
    </tr>
    @endforeach
    </tbody>
</table>

@stop