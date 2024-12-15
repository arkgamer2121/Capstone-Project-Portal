<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chat-box {
            border: 1px solid #ccc;
            height: 400px;
            overflow-y: scroll;
            padding: 10px;
        }
        .message {
            margin-bottom: 10px;
        }
        .user-message {
            color: blue;
        }
        .admin-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chat Box</h2>
        <div class="chat-box">
            <?php foreach ($messages as $message): ?>
                <div class="message <?= esc($message['type']) === 'admin' ? 'admin-message' : 'user-message'; ?>">
                    <strong><?= esc($message['sender']); ?>:</strong>
                    <p><?= esc($message['message']); ?></p>
                    <small><?= esc($message['timestamp']); ?></small>
                </div>
            <?php endforeach; ?>
        </div>

        <form action="/chat/send" method="post" class="mt-3">
            <div class="form-group">
                <input type="text" name="sender" placeholder="Your Name" class="form-control" required>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Type your message here..." class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

        <hr>

    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#sendUserMessage').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: '/chat/send', // Your send message endpoint
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    // Assuming your server returns the updated messages
                    $('.chat-box').empty(); // Clear the chat box
                    data.messages.forEach(function(message) {
                        $('.chat-box').append(
                            '<div class="message ' + (message.type === 'admin' ? 'admin-message' : 'user-message') + '"><strong>' + message.sender + ':</strong><p>' + message.message + '</p><small>' + message.timestamp + '</small></div>'
                        );
                    });
                }
            });
        });
    });
</script>

</body>
</html>
