<x-app-layout>

<x-slot name="header">
    <h3>Expensas por Cobrar</h3>
</x-slot>

<div class="container">
<div class="card shadow p-3">
<div class="mb-3">

    <label>Selecciona el mes Aperturado</label>
    <select name="mes" class="form-control">
        
    </select>
    <a href="" class="btn btn-success">
            Generar Listado
            </a>
    </div>
</div>
<br>
    <div class="mb-3">
        <a href="{{ route('expensas.create') }}" class="btn btn-success">
            + Registrar Pago
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
                    <th>Departamento</th>
                    <th>Monto</th>
                    <th>Multa</th>
                    <th>Tiempo de Mora</th>
                    <th>Estado</th>
                    <th>Saldo</th>
                    <th>Pagado</th>
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
                    <td></td>
                    
                </tr>
             

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>







