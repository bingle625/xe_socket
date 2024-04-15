<script src="{{ \Hsj\XePlugin\ChatPlugin\Plugin::asset('dist/js/app.js') }}"></script>
<script>
    window.Echo.channel('chat')
        .listen('.new-message', (e) => {
            alert('hi');
        });
</script>