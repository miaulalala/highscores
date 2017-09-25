@extends('layouts.app')

@section('content')
<script>
$.ajax({
    url: "/api/highscores",
    type: "GET",

    contentType: 'application/json; charset=utf-8',
    success: function(resultData) {
        console.log(resultData);
        //var obj = $.parseJSON(resultData);
        //console.log(obj);
        $i = 1;
        $.each(resultData, function(key, value) {
            $row = $('<tr>'+
                      '<td>'+$i+'</td>'+
                      '<td>'+ value.fname + ' ' + value.lname +'</td>'+
                      '<td>'+ value.difficulty['difficulty'] +'</td>'+
                      '<td>' + value.score + '</td>' +
                      '</tr>'); 
            $('table>tbody:last').append($row);
            $i++;
        });
    },
    error : function(jqXHR, textStatus, errorThrown) {
    },

    timeout: 120000,
});

</script>
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Highscores</div>

                    <div class="panel-body">
                        <table id="highscores" class="table table-striped table-bordered"> 
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Name</th>
                                    <th>Difficulty</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
