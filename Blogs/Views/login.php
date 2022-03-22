<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/img/logo/flogo.png" sizes="32x32" type="image/png">

    <!-- Bootstrap, FontAwesome, Custom Styles -->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="Assets/css/style.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">


    <title><?= $_SESSION['username_err']; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <?php include "Components/header.php" ?>
    <!-- </Header> -->

    <!-- Main -->
    <main class="main">

        <!-- Latest Articles -->
        <div class="section jumbotron mb-0 h-100">
            <!-- container -->
            <div class="container d-flex flex-column justify-content-center align-items-center h-100">

                <div class="wrapper my-0 pt-3 bg-white w-50 text-center">
                    <img src="Assets/img/logo/logo.png" alt="dev culture logo" style="width: 100px;height: auto;">
                </div>

                <!-- row -->
                <div class="wrapper bg-white rounded px-4 py-4 w-50">

                    <form action="../Controller/User.php" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?= (!empty($_SESSION['username_err'])) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?= $_SESSION['username_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?= (!empty($_SESSION['password_err'])) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?= $_SESSION['password_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Login">
                        </div>
                        <p><a href="#" class="text-muted">Lost your password?</a></p>
                    </form>
                </div>

                <!-- /row -->

            </div>
            <!-- /container -->
        </div>


    </main><!-- </Main> -->

    <!-- Footer -->
    <!-- <?php include "Components/footer.php" ?> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>