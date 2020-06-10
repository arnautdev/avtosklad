<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Автосклад | Dmitry Arnaut</title>
</head>
<body>

<main role="main" class="container">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-2">
        <a class="navbar-brand" href="<?php echo request()->url(''); ?>">AUTO-STORE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?php if ($this->hasPermission('cars.index')) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo request()->url('cars'); ?>">Cars</a>
                    </li>
                <?php } ?>

                <?php if ($this->hasPermission('cars.create')) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo request()->url('cars/create'); ?>">Add car</a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav pull-right">
                <?php if (!session()->has('user')) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo request()->url('user/login'); ?>">Login / Register</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <?php echo session()->get('user')->name; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo request()->url('user/logout'); ?>">
                            Log Out
                        </a>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </nav>

    <?php if (isset($errors)) { ?>
        <pre><?php echo var_dump($errors); ?></pre>
    <?php } ?>

    <?php if (!is_null(session()->get('flash'))) { ?>
        <div class="alert alert-warning" role="alert">
            <?php echo session()->get('flash');
            session()->remove('flash'); ?>
        </div><!-- ./alert alert-warning -->
    <?php } ?>

    <?php echo $contentForLayout; ?>
</main>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>