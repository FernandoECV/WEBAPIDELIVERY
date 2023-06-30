<!DOCTYPE html>
<html>

<head>
    <title>Listagem de Municípios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Listagem de Municípios</h1>

        @if (isset($message))
            <div class="alert alert-success mt-4">
                {{ $message }}
            </div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IBGE ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($municipios as $municipio)
                    <tr>
                        <td>{{ $municipio->id }}</td>
                        <td>{{ $municipio->ibge_id }}</td>
                        <td>{{ $municipio->ibge_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
