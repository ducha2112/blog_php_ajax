<footer>Все права защищены</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$('#send').click(() => {
    let mess = $('#mess').val();

    $.ajax({
        url: 'ajax/chat.php',
        type: 'POST',
        cache: false,
        data: {

            'mess': mess,
        }, // данные
        dataType: 'html',
        success: (data) => {
            if (data === "Done") {
                let text = $('#show_mess').text();

                if (text === 'Пока сообщений еще нет') {
                    $('.show_mess').remove();
                    $('.chat').append(
                        '<div class="show_mess"><span id="show_mess">' + mess +
                        '</span></div>'
                    );
                }

                $('#mess').val('');
            }

        }
    });
});
setInterval(() => {


    $.ajax({
        url: 'ajax/messages.php',
        type: 'POST',
        cache: false,
        data: {

            'mess': true,
        }, // данные
        dataType: 'html',
        success: (data) => {
            let messages = data.split(',');
            if (messages.length > 1) {
                $('.show_mess').remove();
                $.each(messages, (i, val) => {
                    if (val === '') {
                        $('.chat').prepend('');
                    } else {
                        $('.chat').prepend(
                            '<div class="show_mess"><span id="show_mess">' + val +
                            '</span></div>'
                        );
                    }

                })

            }

        }
    });


}, 3000);
</script>