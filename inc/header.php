<nav class="nav">
        <div class="container">
            <h1 class="logo"><a href="/card/index.php">Cards</a></h1>
            <ul>
                <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo"<li><a href='register.html'>Register</a></li>";
                        echo"<li><a href='login.html'>Login</a></li>";
                    }else{
                        echo"<li><a href='logout.php'>Logout</a></li>";
                    }
                ?>
                <li><a href="#" class="current">Services</a></li>
                <li><a href="#">Contact</a></li>
                <li><div class="dark-mode">
                    <input type="checkbox" class="checkbox" id="checkbox" />
                    <label class="switch" for="checkbox"></label>
                </div></li>
            </ul>
        </div>       
</nav>
