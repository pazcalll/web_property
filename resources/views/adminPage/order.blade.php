@extends('adminPage/_layout')

@section('content')
  <h2 class="col h2 mb-4 text-gray-800 font-weight-bold">Pesanan</h2>

  <table class="table text-center" aria-describedby="list-order">
    <thead>
      <tr class="thead-dark">
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr style="background: #fdfdfe;">
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
@endsection