window.Echo.channel('notifications')
    .listen('NewNotification', function(e){
        console.log(e);
    })