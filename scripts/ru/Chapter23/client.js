var pollServer = function() {
    $.get('chat.php', function(result) {
        
        if(!result.success) {
            console.log("Ошибка при опросе сервера на предмет новых сообщений!");
            return;
        }
        
        $.each(result.messages, function(idx) {
            
            var chatBubble;
            
            if(this.sent_by == 'self') {
                chatBubble = $('<div class="row bubble-sent pull-right">' + 
                               this.message + 
                               '</div><div class="clearfix"></div>');
            } else {
                chatBubble = $('<div class="row bubble-recv">' + 
                               this.message + 
                               '</div><div class="clearfix"></div>');
            }
            
            $('#chatPanel').append(chatBubble);
        });
        
        setTimeout(pollServer, 5000);
    });
}

$(document).on('ready', function() {
    pollServer();
    
    $('button').click(function() {
        $(this).toggleClass('active');
    });
});

$('#sendMessageBtn').on('click', function(event) {
    event.preventDefault();
    
    var message = $('#chatMessage').val();
    
    $.post('chat.php', {
        'message' : message
    }, function(result) {
        
        $('#sendMessageBtn').toggleClass('active');
        
        
        if(!result.success) {
            alert("Во время отправки вашего сообщения возникла ошибка");
        } else {
            console.log("Сообщение отправлено!");
            $('#chatMessage').val('');
        }
    });
    
});