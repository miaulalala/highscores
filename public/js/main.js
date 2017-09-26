$(document).ready(function(){
    token = getCookie('token');
    console.log(token);
    if(typeof(token) != "undefined" && token !== null && token !== ''){
        
        $('#loginlink').hide();
        $('#logoutlink').show();
        $('.a_d').show();
        getAll(token);
    } else {
        
        $('#loginlink').show();
        $('#logoutlink').hide();
        $('.a_d').hide();
        getVerified();
    }
    $('#loginModal').modal({ show: false});
    $('#submitModal').modal({ show: false})
});


/*********/
/* Login */
/*********/

function login(){
    var data = {};
    $('#loginform input').each(function(){
        if($(this).attr('name') == 'email'){
         data.email = $(this).val();
        }
        if($(this).attr('name') == 'password'){
         data.password = $(this).val();
        }
    });
    data = JSON.stringify(data);
    console.log(data);
    $.ajax({
        url: "/api/login",
        type: "POST",
        contentType: 'application/json; charset=utf-8',
        data: data,
        success: function(responseData){
            $('#loginform').hide();
            $('#message_login').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#message_login_content').html('Successfully logged in');
            document.cookie="token=" + responseData.data.api_token;
            window.setTimeout('window.location.reload()', 1000);
            
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_login').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_login_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Wrong Username or Password. Please try again.');
        },

        timeout: 120000,
    });
}


/***************************/
/* Logout and destroy token */
/***************************/

function logout(){
    $.ajax({
        url: "/api/logout",
        type: "POST",
        contentType: 'application/json; charset=utf-8',
        success: function(responseData){
            document.cookie="token=;";   
            location.reload();        
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_general').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_general_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An error occured. Please reload the page and try again. <br /><small>' + errorThrown + '</small>');
        },

        timeout: 120000,
    });
}



/**********************/
/* Submit a new score */
/**********************/

function submitScore(){
    var data = {};
    $('#submitscore input').each(function(){
        if($(this).attr('name') == 'fname'){
         data.fname = $(this).val();
        }
        if($(this).attr('name') == 'lname'){
         data.lname = $(this).val();
        }
        if($(this).attr('name') == 'score'){
         data.score = $(this).val();
        }
    });
    data.d_id = $('#diff').val();
    data = JSON.stringify(data);
    $.ajax({
        url: "/api/highscores",
        type: "POST",
        contentType: 'application/json; charset=utf-8',
        data: data,
        success: function(responseData){
            $('#submitform').hide();
            $('#message_submit').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#message_submit_content').html('You successfully submitted your score for approval!');
            setTimeout(function(){$('#submitModal').modal('hide')},2000);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_submit').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_submit_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An error occured. Please reload the page and try again. <br /><small>' + errorThrown + '</small>');
        },

        timeout: 120000,
    });
}


/*********************/
/* Get approved data */
/*********************/

function getVerified(){
    $.ajax({
        url: "/api/highscores",
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        success: function(resultData) {
            var arr = []
            $.each(resultData, function(key, value) {
                arr.push(value);
            });
            arr.sort(function(a, b) {
                return b['score'] - a['score'];
            });
            $.each(arr, function(key, value) {
                           pos = key + 1;
                           $row = $('<tr>'+
                          '<td>'+pos+'</td>'+
                          '<td>'+value.fname + ' ' + value.lname +'</td>'+
                          '<td>'+ value.difficulty['difficulty'] +'</td>'+
                          '<td>' + value.score + '</td>' +
                          '<td style="display:none"></td>' +
                          '<td style="display:none"></td>' +
                          '</tr>'); 
                $('table>tbody:last').append($row);
            });
            $('#highscores').DataTable();
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_general').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_general_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An error occured. Please reload the page and try again. <br /><small>' + errorThrown + '</small>');
        },

        timeout: 120000,
    });
}


/**************************************/
/* Get all data, including unapproved */
/**************************************/

function getAll(token){
    $.ajax({
        url: "/api/highscores/notApproved",
        type: "GET",
        beforeSend: function(request) {
            request.setRequestHeader('Authorization','Bearer ' + token);
        },
        contentType: 'application/json; charset=utf-8',
        success: function(resultData){
            console.log(resultData);
            var arr = []
            $.each(resultData, function(key, value) {
                arr.push(value);
            });
            arr.sort(function(a, b) {
                return b['score'] - a['score'];
            });
            $.each(arr, function(key, value) {
                           console.log(value);
                           pos = key + 1;
                           $row = $('<tr id="row_' + value.id +'">'+
                                    '<td>'+pos+'</td>'+
                                    '<td>'+value.fname + ' ' + value.lname +'</td>'+
                                    '<td>'+ value.difficulty['difficulty'] +'</td>'+
                                    '<td>' + value.score + '</td></tr>'
                                   );
                          
                          if(value.approved){
                            $row.append('<td>Approved</td>');
                          } else {
                            $row.append('<td><a onclick="approve(' + value.id + ');" class="btn btn-default">Approve</a></td>');
                          }
                          $row.append('<td><a onclick="remove(' + value.id + ');" class="btn btn-default pull-right">Delete</a></td></tr>');
                $('table>tbody:last').append($row);
            });
            $('#highscores').DataTable();
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_general').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_general_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An error occured. Please reload the page and try again. <br /><small>' + errorThrown + '</small>');
        },

        timeout: 120000,
    });
}

/**************************/
/* Approve the high score */
/**************************/

function approve(id){
    data = {};
    data.id = id;
    data.approved = 1;
    data = JSON.stringify(data);
    $.ajax({
        url: "/api/highscores/" + id,
        type: "PUT",
        beforeSend: function(request) {
            request.setRequestHeader('Authorization','Bearer ' + token);
        },
        contentType: 'application/json; charset=utf-8',
        data: data,
        success: function(resultData){
            console.log(resultData);
            $('#row_' + id + ' td:nth-child(5)').html('Approved');
            $('#highscores').DataTable();
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_general').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_general_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An error occured. Please reload the page and try again. <br /><small>' + errorThrown + '</small>');
        },

        timeout: 120000,
    });
}

/************************/
/* Delete the highscore */
/************************/

function remove(id){
    data = {};
    data.id = id;
    data = JSON.stringify(data);
    $.ajax({
        url: "/api/highscores/" + id,
        type: "DELETE",
        beforeSend: function(request) {
            request.setRequestHeader('Authorization','Bearer ' + token);
        },
        contentType: 'application/json; charset=utf-8',
        data: data,
        success: function(resultData){
            console.log(resultData);
            $('#row_' + id).remove();
            $('#highscores tr').each(function(){
                $('#highscores td:first-child').each(function(){
                    $(this).html($(this).parent().index()+1);
                });
            });
            $('#highscores').DataTable();
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $('#message_general').removeClass('hide').addClass('alert alert-danger alert-dismissible').slideDown().show();
            $('#message_general_content').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>An error occured. Please reload the page and try again. <br /><small>' + errorThrown + '</small>');
        },

        timeout: 120000,
    });
}


/****************************************************/
/* Get Cookie by 'name' value                       */
/* From https://www.w3schools.com/js/js_cookies.asp */
/****************************************************/

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


