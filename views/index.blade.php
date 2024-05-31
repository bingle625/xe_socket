<script src="{{ \Hsj\XePlugin\ChatPlugin\Plugin::asset('dist/js/app.js') }}"></script>
<script>
    fetch('{{ route('chat-plugin::check') }}')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'running') {
                console.log('Soketi server is running on port 6001');
            } else {
                console.log('Soketi server is not running on port 6001');
            }
        })
        .catch(error => {
            console.error('Error checking Soketi server status:', error);
        });
    window.Echo.channel('chat')
        .listen('.new-message', (e) => {
            if (e.message.user != '{{ auth()->id() }}') {
                const _message_body = e.message;
                const chatBody = document.querySelector('#chat-body');
                const messageItem = document.createElement('li');
                messageItem.classList.add('others-message');
                const _my_name = _message_body.user_name;
                const _message = _message_body.message;
                messageItem.innerHTML = `
                <strong class="chat-name">${_my_name}:</strong>
                <span class="chat-message">${_message}</span>
            `;
                chatBody.appendChild(messageItem);
            }
        });
</script>
<style>
    #chat-body .others-message .chat-name {
        color: blue;
    }
</style>

<ul id="chat-body">
</ul>
<form name="chat-form">
    {{ csrf_field() }}
    <input type="text" name="message">
    <button type="submit">submit</button>
</form>

<script>
    $(document).on('submit', 'form[name="chat-form"]', function (event) {
        event.preventDefault();
        const _url = '{{ route('chat-plugin::send-message') }}';
        const _my_id = '{{ auth()->id() }}';
        $.ajax({
            url: _url,
            type: 'post',
            data:{
                message: $('input[name="message"]').val(),
                user_id: _my_id
            },
            success: function (response) {
                const chatBody = document.querySelector('#chat-body');
                const messageItem = document.createElement('li');
                messageItem.classList.add('my-message');
                const _message = response.message;
                const _my_name = response.user_name;
                messageItem.innerHTML = `
                <strong class="chat-name">${_my_name}:</strong>
                <span class="chat-message">${_message}</span>
            `;
                chatBody.appendChild(messageItem);
            }
        });
    });
</script>
