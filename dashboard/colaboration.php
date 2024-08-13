<?php
session_start();
    include('../dbcon.php');
    if (!isset($_SESSION['email'])) {
        header("Location: ../error.php");
        exit();
    }
    $token = bin2hex(random_bytes(64));
    $_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/dashboard.css"/>
    <link rel="icon" type="img/png" href="../picture/logo.png">
    <title>Colaboration Commmunication</title>
</head>
<body class="dark">
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../dashboard/home.php?token=<?php echo $token; ?>">
                        <span class="icon1"><ion-icon name="business-outline"></ion-icon>`</span>
                        <span class="title1">Administrative</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/home.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
                        <span class="title">DOCUMENT MANAGEMENT</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/reservation.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="paper-plane-outline"></ion-icon></span>
                        <span class="title">FACILITIES RESERVATION</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/legal.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="scale-outline"></ion-icon></span>
                        <span class="title">LEGAL MANAGEMENT</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/visitor.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="man-outline"></ion-icon></span>
                        <span class="title">VISITOR MANAGEMENT</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/colaboration.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="-outline"></ion-icon></span>
                        <span class="title">COLAB COMMUNICATION</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/register.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="-outline"></ion-icon></span>
                        <span class="title">ADD ADMIN</span>
                    </a>
                </li>
                <li>
                    <form action="../logout.php" method="POST">
                        <a href="../logout.php">
                            <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                            <span class="title">LOGOUT</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
       
      
        <div class="main" id="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="list-outline"></ion-icon>
                </div>
                <div class="search">
                    <p>Welcome to Administrative</p>
                </div>
                <div class="user">
                    <img src="" alt="">
                    <h1 class="log">A</h1>
                </div>            
            </div>

            <div class="chatBox">
                <div class="chat-messages" id="chat-messages"></div>
                <div class="user-input">
                    <input type="text" id="message-input" placeholder="Type your message..." onkeydown="if(event.keyCode==13) sendMessage()">
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function fetchUsername() {
            return fetch('../code/getName.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        return data.firstname;
                    } else {
                        console.error('Failed to fetch username:', data.error);
                        return 'User';
                    }
                })
                .catch(error => {
                    console.error('Error fetching username:', error);
                    return 'User';
                });
        }

        async function sendMessage() {
            var messageInput = document.getElementById('message-input');
            var message = messageInput.value.trim();

            if (message !== '') {
                var chatMessages = document.getElementById('chat-messages');

                // Fetch the username
                const username = await fetchUsername();

                // Create a message container with username and message
                var messageContainer = document.createElement('div');
                messageContainer.classList.add('message-container');

                var usernameElement = document.createElement('strong');
                usernameElement.textContent = username + ': ';

                var messageElement = document.createElement('span');
                messageElement.textContent = message;

                messageContainer.appendChild(usernameElement);
                messageContainer.appendChild(messageElement);

                // Append the message container to the chat box
                chatMessages.appendChild(messageContainer);

                // Clear the input field
                messageInput.value = '';

                // Scroll to the bottom of the chat messages
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../script/dashboard.js"></script>
</body>
</html>