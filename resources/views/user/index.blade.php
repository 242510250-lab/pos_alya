@extends('layouts.app')

@section('tittle', 'user')

@section('content')

@include('layouts.navbar')

<h1>Halaman Users</h1>
<a href= "{{ route('admin.users.create') }}" class="btn btn_primary">create</a>
<form action="{{ route('admin.users') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search username or email">
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $users->firstitem() + $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        <td>
            <a href="{{ Route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                Edit Akun
            </a>
            ||
            <form action="{{ route('admin.users.destory', $user) }}" method="POST" class="d-inline">
                @csrf
                @method("DELETE")
                <BUTTON CLASS="btn btn-sm btn-danger" onclick="return confirm('yakin hapus user ini')">
                    Hapus
                </button>
            </form>
        </td>
        <td>1</td>
<td>bintang</td>
<td>widhi@email.com</td>
<td>admin</td>
<td>
    <a href="" class="btn btn-sm btn-warning">
        Edit Akun
    </a>
    ||
    <form action="" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
            Hapus
        </button>
    </form>
</td>
</tr>
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
      <td>John</td>
      <td>Doe</td>
      <td>@social</td>
    </tr>
  </tbody>
</table>

@endsection