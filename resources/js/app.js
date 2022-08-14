require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.private(`App.Models.User.${userId}`).notification(function (data) {
    $('#notificationsList').prepend(`    <div class="dropdown-divider"></div>
    <a href=${data.url}?notify_id = ${data.id}" class="dropdown-item">
            <strong>*</strong>
        <i class="fas fa-envelope mr-2"></i> {{ ${data.body} }}
        <span class="float-right text-muted text-sm">3 mins</span>
    </a>`);
    let count = $('#newNotifications').text()
    count++;
    $('#newNotifications').text(count)
})
window.Echo.join(`messages.${userId}`).listen('messageCreated',function(){
alert(data.message.message)
})
