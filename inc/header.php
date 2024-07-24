<nav class="nav">
        <div class="container">
            <h1 class="logo"><a href="/">Cards</a></h1>
            <ul>
                <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo"<li><a href='register.html' class='current'>Register</a></li>";
                        echo"<li><a href='login.html'>Login</a></li>";
                    }else{
                        echo"<li><a href='logout.php'>Logout</a></li>";
                    }
                ?>
                <li><div class="dark-mode">
                    <input type="checkbox" class="checkbox" id="checkbox" />
                    <label class="switch" for="checkbox"></label>
                </div></li>
            </ul>
        </div>       
</nav>
