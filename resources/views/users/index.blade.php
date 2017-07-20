<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->

  <div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи -->
    <form action="{{ url('user') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}

      <!-- Имя задачи -->
      <div class="form-group">
        <label for="user" class="col-sm-3 control-label">User</label>

        <div class="col-sm-6">
          <input type="text" name="name" id="user-name" class="form-control">
        </div>
      </div>

      <!-- Кнопка добавления задачи -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> Add user
          </button>
        </div>
      </div>
    </form>
  </div>

  <!-- TODO: Текущие задачи -->
    @if (count($users) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Current User
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>User</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Тело таблицы -->
          <tbody>
            @foreach ($users as $user)
              <tr>
                <!-- Имя задачи -->
                <td class="table-text">
                  <div>{{ $user->name }}</div>
                </td>

                <td>
                  <!-- TODO: Кнопка Удалить -->
                   <tr>
                      <!-- Имя задачи -->
                        <td class="table-text">
                        <!--<div>{{ $user->name }}</div>-->
                      </td>

                      <!-- Кнопка Удалить -->
                      <td>
                        <form action="{{ url('user/'.$user->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}

                          <button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Удалить
                          </button>
                        </form>
                      </td>
                    </tr>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
   @endif
@endsection