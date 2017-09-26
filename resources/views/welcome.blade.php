@extends('layouts.app')

@section('content')
<div id="message_general" class="hide" role="alert">
    <div id="message_general_content"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Highscores <a class="pull-right" href="#" onclick="$('#submitModal').modal('show');">Submit Score</a></div>
                <div class="panel-body">
                    <table id="highscores" class="table table-striped table-bordered"> 
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Difficulty</th>
                                <th>Score</th>
                                <th class="a_d" style="display:none">Approved</th>
                                <th class="a_d" style="display:none">Delete</th>
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
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <div id="message_login" class="hide" role="alert">
                    <div id="message_login_content"></div>
                </div>
                <form id="loginform" class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); login();">
                            Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="submitModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Submit a Score</h4>
            </div>
            <div class="modal-body">
                <div id="message_submit" class="hide" role="alert">
                    <div id="message_submit_content"></div>
                </div>
                <form id="submitscore" class="form-horizontal">
                    <div class="form-group">
                        <label for="fname" class="col-md-6">First Name</label>
                        <label for="lname" class="col-md-6">Last Name</label>
                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control" name="fname" required autofocus>
                        </div>
                        
                        <div class="col-md-6">
                            <input id="lname" type="text" class="form-control" name="lname" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-md-6">Score</label>
                        <label for="difficulty" class="col-md-6">Difficulty</label>
                        <div class="col-md-6">
                            <input id="score" type="number" class="form-control" name="score" required>
                        </div>
                        
                        <div class="col-md-6">
                            <select id="diff" name="difficulty" class="form-control" required>
                              <option value="1" selected>Easy</option>
                              <option value="2">Medium</option>
                              <option value="3">Hard</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" onclick="event.preventDefault(); submitScore();">
                            Submit Score
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
