<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Your dashboard content here

$username = $_SESSION['username'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="inc/footer.css">
</head>

<body>
    <?php require('inc/header.php') ?>
    <br><br><br>
    <section class="header">
        <div class="wrapper">
            <div class="header-grid">
                <div>
                    <h1>Dashboard</h1>
                    <p class="header-total">Welcome, <?php echo htmlspecialchars($username); ?></p>
                </div>
            </div>
        </div>
    </section>
    <section class="top-cards">
        <div class="wrapper">
            <div class="grid">
                <article class="card facebook">
                    <p class="card-title">
                        Total Clicks
                    </p>
                    <p class="card-followers">
                        <span class="card-followers-number">000</span>
                        <span class="card-followers-title">Page views</span>
                    </p>
                    <p class="card-today">
                        Coming Soon
                    </p>
                </article>
                <article class="card twitter">
                    <p class="card-title">
                        Card Created
                    </p>
                    <p class="card-followers">
                        <span class="card-followers-number" id="totalLink"></span>
                        <span class="card-followers-title">Total Cards</span>
                    </p>
                    <p class="card-today">
                        using localstorage
                    </p>
                </article>
                <!-- <article class="card instagram">
            <p class="card-title">
              <img src="./images/instagram.png" alt="" />
              @jpmontoya182
            </p>
            <p class="card-followers">
              <span class="card-followers-number">12K</span>
              <span class="card-followers-title">Followers</span>
            </p>
            <p class="card-today">
              <img src="./images/icon-up.png" alt="" width="9px" />
              12 Today
            </p>
          </article>
          <article class="card youtube">
            <p class="card-title">
              <img src="./images/youtube.png" alt="" />
              
            </p>
            <p class="card-followers">
              <span class="card-followers-number">5m</span>
              <span class="card-followers-title">Followers</span>
            </p>
            <p class="card-today is-danger">
              <img src="./images/icon-down.png" alt="" width="9px" />
              12 Today
            </p>
          </article> -->
            </div>
        </div>
    </section>
    <hr>
    <section>
        <div class="container">
            <div class="screen">
                <div class="screen-body">
                    <div class="screen-body-item left">
                        <div class="app-title">
                            <span>CREATED</span>
                            <span>CARDS</span>
                        </div>
                        <div class="createdCardList" id="responseMessage">
                        </div>
                        <div class="app-contact">If you generate any card. Please save link.</div>
                    </div>
                    <div class="screen-body-item">
                        <div class="app-title">
                            <span>CREATE</span>
                            <span>CARD</span>
                        </div>
                        <form id="myForm">
                        <!-- <form action="submit.php" method="POST"> -->
                            <div class="app-form">
                                <div class="app-form-group">
                                    <input class="app-form-control" required placeholder="NAME" value="HAPPY BIRTHDAY 🎂">
                                </div>
                                <div class="app-form-group">
                                    <input class="app-form-control" required name="field1" placeholder="NAME">
                                </div>
                                <div class="app-form-group">
                                    <input class="app-form-control" required name="field3" placeholder="YOUR NAME">
                                </div>
                                <div class="app-form-group message">
                                    <input class="app-form-control" required name="field2" placeholder="MESSAGE">
                                    <!-- <textarea name="" id="" cols="50" rows="10" placeholder="MESSAGE"></textarea> -->
                                </div>
                                <div class="app-form-group buttons">
                                    <button type="submit" class="app-form-button">CREATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require('inc/footer.php') ?>
    <script>
        $(document).ready(function() {
            // Load stored response messages if available
            if (localStorage.getItem('responseMessages')) {
                const responseMessages = JSON.parse(localStorage.getItem('responseMessages'));
                let totalLink = 0;
                responseMessages.forEach(message => {
                    $('#responseMessage').append('<div>' + message + '</div>');
                    totalLink++;
                });
                document.getElementById('totalLink').innerText = totalLink;
            }

            $('#myForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'submit.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage').append(response);
                        $('#myForm')[0].reset(); // Reset the form

                        let responseMessages = [];
                        if (localStorage.getItem('responseMessages')) {
                            responseMessages = JSON.parse(localStorage.getItem('responseMessages'));
                        }
                        responseMessages.push(response);
                        localStorage.setItem('responseMessages', JSON.stringify(responseMessages));
                    }
                });
            });
        });
    </script>
    <script src="script.js"></script>
</body>

</html>