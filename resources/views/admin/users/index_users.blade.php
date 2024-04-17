@extends('layouts.app')
<!-- Die Angezeigte Seite des User-Managements -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <!-- Überschrift und Liste aller User-->
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Userame</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user-> name}}</td>
                                    <td>{{$user-> username}}</td>
                                    <td>{{$user-> email}}</td>
                                    <td>{{implode(', ' , $user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td>
                                        <!-- Buttons zum Editieren und Löschen der User-->
                                        <div class="btn-group">
                                          @can('UserAdmin')
                                            <a href ="{{route('admin.users.edit', $user->id) }}" ><button type="button" class="btn btn-outline-primary ml-1 float-left">Edit</button>
                                            </a>@endcan
                                            @can('UserAdmin')
                                            <!-- Button trigger modal -->
                                            <input type="button" class="button_delete btn-outline-warning btn ml-2 float-right" data-toggle="modal" data-target="#exampleModal{{$user->id}}" value="Delete"/>
                                        </div>

                        <!-- Modal (Abfrage ob man den User wirklich löschen möchte) -->
                         @foreach($users as $user)
                           <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                           <div class="modal-content">
                           <div class="modal-header">
                            Wollen sie {{$user->name}} wirklich löschen?
                           </div>
                          <div class="modal-body">
                              <!-- Buttons Zurück der das Modal schließt und Delete der den User löscht-->
                             <a href ="/admin/users" >
                              <button type="button" class="btn btn-outline-info mr-1 float-left">Nein</button></a>

                              <form action="{{route('admin.users.destroy', $user)}}" method="POST" >
                                @csrf
                             {{method_field('DELETE')}}
                             <button type="submit" class="btn btn-outline-danger mr-1 float-right">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endcan
    </td>
</tr>
@endforeach
</tbody>
</table>
        <!-- Führt einen wieder zur Startseite-->
        <a href ="/" >
            <button type="button" class="btn btn-outline-info">Zurück</button></a>
        </div>
    </div>
</div>
</div>
</div>
@endsection
