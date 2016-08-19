//create user
username = '';
jQuery.ajax({
    url: 'api/index.php?method=create',
    type: 'GET',
    dataType: 'json',
    data: {},
    success: function (data) {
        console.log(data);
        username = data.user_name;
    },
    error: function(){
        console.log('failed to create user');
    },
    complete: function(){
        //console.log('done');
    }
});

//get user location
user_lat = false;
user_long = false;
function user_location() {
    // Try W3C Geolocation (Preferred)
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            user_lat = position.coords.latitude;
            user_long = position.coords.longitude;
            console.log('lat: '+ user_lat);
            console.log('long' + user_long);
            $('input#lat').val(user_lat);
            $('input#long').val(user_long);
            jQuery.ajax({
                url: 'api/index.php?method=update&user='+username+'&long='+user_long+'&lat='+user_lat,
                type: 'GET',
                dataType: 'json',
                data: {},
                success: function (data) {
                    console.log('location updated');
                },
                error: function(){
                    console.log('failed to update location');
                },
                complete: function(){
                    //console.log('done');
                }
            });
        }, function() {
            browserSupportFlag = false;
            handleNoGeolocation(browserSupportFlag);
        });
    }
    // Browser doesn't support Geolocation
    else {
        browserSupportFlag = false;
        handleNoGeolocation(browserSupportFlag);
    }
    function handleNoGeolocation(errorFlag) {
        if (errorFlag == true) {
            alert("Geolocation service failed.");
        } else {
            alert("Your browser doesn't support geolocation.");
        }
    }
}

user_location();

//get location every 30 seconds
window.setInterval(function(){
    user_location();
}, 5000);

function poll_for_question(){
    
}

//start question process
appearin = '';
question = '';
$("#question-form").submit(function(){
    $('#form-overlay').fadeIn();
    window.setInterval(function(){
        jQuery.ajax({
            url: 'api/index.php?method=hasquestion&user='+username,
            type: 'GET',
            dataType: 'json',
            data: {},
            success: function (data) {
                console.log(data);
                if(!jQuery.isEmptyObject(data)){
                    appearin = data.appearin;
                    question_num = data.question_number;
                    jQuery.ajax({
                        url: 'questions.json',
                        type: 'GET',
                        dataType: 'json',
                        data: {},
                        success: function (data) {
                            console.log(data[question_num]);
                            $('#intro').hide();
                            $('#question h1').text(data[question_num]['question'] + '...');
                            $('.answer-0').addClass('twa-'+data[question_num]['answers'][0]);
                            $('.answer-1').addClass('twa-'+data[question_num]['answers'][1]);
                            $('.answer-2').addClass('twa-'+data[question_num]['answers'][2]);
                            $('.answer-3').addClass('twa-'+data[question_num]['answers'][3]);
                            $('#question').show();
                        },
                        error: function(){
                            console.log('failed get question');
                        },
                        complete: function(){
                            //console.log('done');
                        }
                    });
                }
            },
            error: function(){
                console.log('failed to poll for question');
            },
            complete: function(){
                //console.log('done');
            }
        });
    }, 5000);
    return false;
});
