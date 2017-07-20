<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap шаблон... -->
    <div class="control-panel panel panel-default">
        <div class="text-center panel-heading">
            <h5>Controls</h5>
        </div>
        <div class="panel-body">
            <ul class="panel-group">
                <li><a href="javascript:void(0);"><span class="fa fa-binoculars"></span>Find Quests</a></li>
                <li><a href="javascript:void(0);"><span class="fa fa-street-view"></span>Find Catchers</a></li>
                <li><a href="javascript:void(0);"><span class="fa fa-map"></span>Set Area</a></li>

                <li class="panel panel-default">
                    <div class="panel-heading">
                        <a class="panel-title" href="#filtersItems" data-toggle="collapse"><span class="fa fa-plus-square-o"></span>Filter</a>
                    </div>
                    <div id="filtersItems" class="panel-collapse collapse">
                        <ul class="panel-body">
                            <li class="text-center"><a href="javascript:void(0);">Quests</a></li>
                            <li class="text-center"><a href="javascript:void(0);">Catchers</a></li>
                        </ul>
                    </div>
                </li>

                <li class="panel panel-default">
                    <div class="panel-heading">
                        <a class="panel-title" href="#tasksItems" data-toggle="collapse"><span class="fa fa-plus-square-o"></span>My Quests</a>
                    </div>
                    <div id="tasksItems" class="panel-collapse collapse">
                        <ul class="panel-body">
                            <li><a href="javascript:void(0);"><span class="fa fa-tasks"></span>Quest list</a></li>
                            <li><a href="javascript:void(0);"><span class="fa fa-plus"></span>New quest</a></li>
                            <li><a href="javascript:void(0);"><span class="fa fa-edit"></span>Edit quest</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div id="map"></div>
    <div class="panel-body hidden">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <!-- Форма новой задачи -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Имя задачи -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Имя задачи</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task-text" class="col-sm-3 control-label">Текст задачи</label>

                <div class="col-sm-6">
                    <input type="text" name="text" id="task-text" class="form-control">
                </div>
            </div>
            <!-- Task Location -->
            <div class="form-group">
                <label for="latitude" class="col-sm-3 control-label">Latitude</label>

                <div class="col-sm-6">
                    <input type="number" step="0.0000001" min="-180" max="180" name="latitude" id="latitude" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="longitude" class="col-sm-3 control-label">Longitude</label>

                <div class="col-sm-6">
                    <input type="number" step="0.0000001" min="-180" max="180" name="longitude" id="longitude" class="form-control">
                </div>
            </div>

            <!-- Кнопка добавления задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить задачу
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Текущие задачи -->
    @if (count($tasks) > 0)
        <div class="panel panel-default panel-tasks">
            <div class="panel-body">
                <table class="table table-condensed task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th class="text-right">
                        <i class="controls fa fa-edit"></i>
                        <i class="controls fa fa-power-off"></i>
                        <i class="controls fa fa-close"></i>
                    </th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text task">
                                <h3><span>{{$task->id}}</span>{{ $task->name }}</h3>
                                <p>{{ $task->text }}</p>
                                <p>{{ $task->latitude }}</p>
                                <p>{{ $task->longitude }}</p>
                                <p>{{ $task->created_at }}</p>


                                <!-- Кнопка Удалить -->
                                <form class="hidden" action="{{ url('task/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRkO6emVZRCnI9iNYa6hdjML_nfp9GWpk"></script>

<script>
    function initialize() {
        var me = { lat: 46.4318223, lng: 30.747123 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: me
        });
    var taskElem,taskLocation;
    var markers = {};
    var tasksArr = document.getElementsByClassName('task');
    for(var i = 0;i < tasksArr.length; i++)
        {
             taskLocation = {
                lat:parseFloat(tasksArr[i].getElementsByTagName('P')[1].innerHTML),
                lng:parseFloat(tasksArr[i].getElementsByTagName('P')[2].innerHTML),
            };
            markers[taskElem] = new google.maps.Marker({
                position: taskLocation,
                label: tasksArr[i].getElementsByTagName('SPAN')[0].innerHTML,
                map: map
            });
        }

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    window.onload = function(){
        document.getElementsByClassName('fa-tasks')[0].parentNode.onclick = function(){
            var panel = document.getElementsByClassName('panel-tasks')[0];
            //alert(panel.style.display);
            if(panel.style.display !== 'block') {
                panel.style.display = 'block';
                //this.childNodes[0].className = 'fa fa-close';
            }
            else {
                panel.style.display = 'none';
                //this.childNodes[0].className = 'fa fa-list';
            }
        };
        document.getElementsByClassName('fa-close')[0].onclick = function(){
            document.getElementsByClassName('panel-tasks')[0].style.display = 'none';
        };
    }

</script>