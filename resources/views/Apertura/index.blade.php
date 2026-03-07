<x-app-layout>

<x-slot name="header">
    <h3>Lista de Meses</h3>
</x-slot>

<div class="container">

    <div class="mb-3">
        <a href="{{ route('apertura.create') }}" class="btn btn-success">
            + Registrar Apertura de Mes
        </a>

        <a href="" class="btn btn-success">
            📊 Exportar Excel
        </a>

        <a href="" class="btn btn-danger">
            📄 Exportar PDF
        </a>
    </div>
    

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow p-3">

        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Gestion</th>
                    <th>Monto Recaudado</th>
                    <th>Monto Pendiente</th>
                    <th>Monto Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
             

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>







