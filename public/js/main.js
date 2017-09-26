$(document).ready(function(){
    
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
                          '</tr>'); 
                $('table>tbody:last').append($row);
            });
            $('#highscores').DataTable();
        },
        error : function(jqXHR, textStatus, errorThrown) {
            window.alert(errorThrown);
        },

        timeout: 120000,
    });
    $('#myModal').modal({ show: false})
});

function verify(){
    var data = {};
    $('#loginform input').each(function(){
        if($(this).attr('name') == 'email'){
         data.email = $(this).val();
        }
        if($(this).attr('name') == 'password'){
         data.password = $(this).val();
        }
        else {
            data._token = $(this).val();
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
            console.log(responseData.data.api_token);
            document.cookie="token=" + responseData.data.api_token;
            
        },
        error : function(jqXHR, textStatus, errorThrown) {
            window.alert(errorThrown);
        },

        timeout: 120000,
    });
}



