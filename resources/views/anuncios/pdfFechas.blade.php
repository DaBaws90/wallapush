{{--
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

<h1>Productos vendidos de la categoría: {{ $categoria->nombre }}</h1>
{{-- <h1 style="text-align:center;">Solicitudes de {{ $type }}</h1> --}}

{{-- <table align="center" class="table table-hover" style="border: 1px solid black;">
    <thead>
        <tr>
            <th style="border: 1px solid black;">Producto</th>
            <th style="border: 1px solid black;">Precio</th>
            <th style="border: 1px solid black;">Vendedor</th>
            <th style="border: 1px solid black;">Fecha creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anuncios as $anuncio)
        <tr>
            <td style="border: 1px solid black;">
                {{ $anuncio->producto }}
            </td>
            <td style="text-align:center;border: 1px solid black;">
                {{ $anuncio->precio }}
            </td>
            <td style="text-align:center;border: 1px solid black;">
                {{ $anuncio->vendedor->name }}
            </td>
            <td style="text-align:center;border: 1px solid black;">
                {{ $anuncio->created_at }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table> --}}

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Vendedor</th>
            <th scope="col">Fecha creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anuncios as $anuncio)
        <tr>
            <td style="border: 1px solid black;">
                {{ $anuncio->producto }}
            </td>
            <td style="text-align:center;border: 1px solid black;">
                {{ $anuncio->precio }}
            </td>
            <td style="text-align:center;border: 1px solid black;">
                {{ $anuncio->vendedor->name }}
            </td>
            <td style="text-align:center;border: 1px solid black;">
                {{ $anuncio->created_at }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
