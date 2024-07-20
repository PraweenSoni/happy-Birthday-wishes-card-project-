<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="inc/footer.css">
</head>

<body>
    <?php require('inc/header.php') ?>
    <div class="hero">
        <div class="container">
            <h1>Welcome To My Website</h1>
            <p>Create your wish card for free.</p>
        </div>
    </div>

    <section class="container content">
        <h2>Content One</h2>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione dolorem voluptates eveniet tempora ut cupiditate magnam, sapiente, hic quo in ipsum iste soluta eaque perferendis nihil recusandae dolore officia aperiam corporis similique. Facilis quos tempore labore totam! Consectetur molestiae iusto ducimus error reiciendis aspernatur dolor, modi dolorem sit architecto, voluptate magni sunt unde est quas? Voluptates a dolorum voluptatum quo perferendis aut sit. Aspernatur libero laboriosam ab eligendi omnis delectus earum labore, placeat officiis sint illum rem voluptas ipsum repellendus iste eius recusandae quae excepturi facere, iure rerum sequi? Illum velit delectus dicta et iste dolorum obcaecati minus odio eligendi!</p>

        <h3>Content Two</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur provident nostrum possimus inventore nisi laboriosam consequatur modi nulla eos, commodi, omnis distinctio! Maxime distinctio impedit provident, voluptates illo odio nostrum minima beatae similique a sint sapiente voluptatum atque optio illum est! Tenetur tempora doloremque quae iste aperiam hic cumque repellat?</p>
    </section>
    <?php require('inc/footer.php') ?>
    <script>
        const nav = document.querySelector('.nav')
        window.addEventListener('scroll', fixNav)

        function fixNav() {
            if (window.scrollY > nav.offsetHeight + 150) {
                nav.classList.add('active')
            } else {
                nav.classList.remove('active')
            }
        }
    </script>
</body>

</html>