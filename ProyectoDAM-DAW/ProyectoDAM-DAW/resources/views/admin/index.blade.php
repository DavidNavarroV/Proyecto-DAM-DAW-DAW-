@extends('layouts.admin')

@section('content')
<div class="row paginado">
    {{$row -> links()}}
</div>
    <table>
        <thead>
        <th>Jugador</th>
        <th>Puntos</th>
        <th>Tiempo</th>
        </thead>
    @foreach($row as $rowset)

        <tbody>
            <tr>
                <td>{{$rowset-> jugador}}</td>
                <td>{{$rowset-> puntos}}</td>
                <td>{{$rowset-> tiempo}}</td>
            </tr>
        </tbody>

    @endforeach
    </table>
@endsection

