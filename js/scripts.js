//create user
username = '';
jQuery.ajax({
    url: 'api/index.php?method=create',
    type: 'GET',
    dataType: 'json',
    data: {},
    success: function (data) {
        //console.log(data);
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
           // console.log('lat: '+ user_lat);
           // console.log('long' + user_long);
            $('input#lat').val(user_lat);
            $('input#long').val(user_long);
            jQuery.ajax({
                url: 'api/index.php?method=update&user='+username+'&long='+user_long+'&lat='+user_lat,
                type: 'GET',
                dataType: 'json',
                data: {},
                success: function (data) {
                    //console.log('location updated');
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
question_id = '';
isPaused = false;
$("#question-form").submit(function(){
    $('#form-overlay').fadeIn();
    var my_question_int = window.setInterval(function(){
        jQuery.ajax({
            url: 'api/index.php?method=hasquestion&user='+username,
            type: 'GET',
            dataType: 'json',
            data: {},
            success: function (data) {
                //console.log(data);
                if(!jQuery.isEmptyObject(data) && isPaused == false){
                    appearin = data.appearin;
                    question_num = data.question_number;
                    $('#question h1');
                    question_id = data.id;
                    isPaused = true;
                    clearInterval(my_question_int);
                    //console.log(question_id);
                    jQuery.ajax({
                        url: 'questions.json',
                        type: 'GET',
                        dataType: 'json',
                        data: {},
                        success: function (data) {
                            //console.log(data[question_num]);
                            $('#intro').hide();
                            $('#question h1').text(data[question_num]['question'] + '...');
                            $('.answer-0').addClass('twa-'+data[question_num]['answers'][0]);
                            $('.answer-1').addClass('twa-'+data[question_num]['answers'][1]);
                            $('.answer-2').addClass('twa-'+data[question_num]['answers'][2]);
                            $('.answer-3').addClass('twa-'+data[question_num]['answers'][3]);
                            $('#question').show();
                            $('#form-overlay').hide();
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

appearin_popped = false;

//submit answers
$('.answers a').click(function(){
    var answer_num = $(this).data('answer');
    $('#question').hide();
   // console.log('api/index.php?user='+username+'&question='+question_id+'&answer='+answer_num+'&method=answerquestion');
    jQuery.ajax({
        url: 'api/index.php?user='+username+'&question='+question_id+'&answer='+answer_num+'&method=answerquestion',
        type: 'GET',
        dataType: 'json',
        data: {},
        success: function (data) {
            console.log(data);
            
            var my_int = window.setInterval(function(){
                jQuery.ajax({
                    url: 'api/index.php?method=getquestion&question='+question_id,
                    type: 'GET',
                    dataType: 'json',
                    data: {},
                    success: function (data) {
                        console.log(data);
                        //username = data.user_name;
                        
                        var dataarray = _.toArray(data.answers);
                        var answer_1 = dataarray[0];
                        var answer_2 = dataarray[1];
                        if(answer_1 !== null && answer_2!== null){
                            if(answer_1 == answer_2 && appearin_popped == false){
                                clearInterval(my_int);
                                appearin_popped = true;
                                console.log('MATCH!');
                                window.open(data.appearin);
                                location.reload();
                            }
                            else {
                                clearInterval(my_int);
                                
                                jQuery.ajax({
                                    url: 'api/index.php?method=unpause&user='+username,
                                    type: 'GET',
                                    dataType: 'json',
                                    data: {},
                                    success: function (data) {
                                        $('#question').hide();
                                        $('#question h1').text('');
                                        $('#form-overlay').hide();
                                        $('#intro').show();
                                        isPaused = false;
                                        appearin_popped = false;
                                        location.reload();
                                    },
                                    error: function(){
                                        console.log('failed to create user');
                                    },
                                    complete: function(){
                                        //console.log('done');
                                    }
                                });
                            }
                        }
                    },
                    error: function(){
                        console.log('failed to find answers');
                        location.reload();
                    },
                    complete: function(){
                        //console.log('done');
                    }
                });
            }, 1000);
            
        },
        error: function(){
            console.log('failed to answer question');
        },
        complete: function(){
            //console.log('done');
        }
    });
});
