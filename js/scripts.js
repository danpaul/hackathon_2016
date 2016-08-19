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
    jQuery.ajax({
        url: 'api/index.php?method=hasquestion&user='+username,
        type: 'GET',
        dataType: 'json',
        data: {},
        success: function (data) {
            return data;
        },
        error: function(){
            console.log('failed to create user');
        },
        complete: function(){
            //console.log('done');
        }
    });
}

//start question process
$("#question-form").submit(function(){
    console.log(poll_for_question());
    return false;
});
