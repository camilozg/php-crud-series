<?php include 'views/header.php' ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Biblioteca de plataformas</h1>
            </div>
            <div class="col-sm-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Plataformas</h5>
                        <p class="card-text">Listado y gestión de las plataformas.</p>
                        <a href="views/platform/list.php" class="btn btn-primary">Listado de Plataformas</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Directores/as</h5>
                        <p class="card-text">Listado y gestión de los directores/as.</p>
                        <a href="views/director/list.php" class="btn btn-primary">Listado de Directores/as</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Actores y Actrices</h5>
                        <p class="card-text">Listado y gestión de los actores y actrices.</p>
                        <a href="views/actor/list.php" class="btn btn-primary">Listado de Actores y Actrices</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Idiomas</h5>
                        <p class="card-text">Listado y gestión de los diomas para audio y subtítulos.</p>
                        <a href="views/languaje/list.php" class="btn btn-primary">Listado de Idiomas</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Series</h5>
                        <p class="card-text">Listado y gestión de las series.</p>
                        <a href="views/serie/list.php" class="btn btn-primary">Listado de Series</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>