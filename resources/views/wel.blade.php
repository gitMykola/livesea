
<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{ asset('css/livesea.css') }}" rel="stylesheet">
        <link href="{{ asset('css/rain.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script sr="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<!-- Styles -->
<style>
    html, body {
        background:#555;
        background: linear-gradient(transparent 40%, #000), url("/img/start.jpg");
        background-attachment: fixed;
        background-size: cover;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    h1,h2,h3,h4,h5,h6{
        font-family: 'Raleway', sans-serif;
        background: transparent;
        font-weight: 100;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        position:absolute;
        bottom:130px;
        text-align: center;
        margin-top:0px;
        color:#fff;
    }

    .title {
        font-size: 104px;
    }

    .links > a {
        color: #fff;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        //margin-bottom: 30px;
    }
    .simple-text{
        font-size:15px;
        font-weight: bold;
        color:aqua;
        margin-bottom:20px;
    }
    @media screen and (max-width:720px){
        .content>.title{
            font-size:80px;
        }
    }
    @media screen and (max-width:580px){
    }
</style>
</head>
<body>
<div class="flex-center position-ref full-height">
<!--    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/tasks') }}">Tasks</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif -->

    <div class="content">
        <div class="title m-b-md">
            {{$appName}}
        </div>
        <div class="simple-text">@lang('common.simpleText')</div>
        <div class="links">
            @if (Auth::check())
                <a href="{{ url('/tasks') }}">Tasks</a>
            @else
                <a href="{{ url('/login') }}">@lang('auth.login')</a>
                <a href="{{ url('/register') }}">@lang('auth.register')</a>
            @endif
        </div>
    </div>
</div>
<!--<div>
    <h4>Tasks List</h4>
    <ul id="tasksList"></ul>
</div>-->
</body>
</html>
<script>
window.onload = function(){
    var protocol = location.protocol;
    var slashes = protocol.concat("//");
    var host = slashes.concat(window.location.hostname);
    var xhttp = new XMLHttpRequest();
    var tasks = new Array();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.dir(this.responseText.toString());
            var dataTasks = JSON.parse(this.responseText);
            for (var i in dataTasks)
            {
                tasks.push(dataTasks[i]);
                /*document.getElementById("tasksList").innerHTML += '' +
                    '<div><p>ID = ' + tasks[i].id+'</p>' +
                    '<p>Name = ' + tasks[i].name+'</p>' +
                    '<p>Text = ' + tasks[i].text+'</p>' +
                    '<p>Date = ' + tasks[i].updated_at+'</p>' +
                    '</dir>';*/
            }
            //console.dir(tasks);
            var node = null;
            for(var i in tasks){
                node = document.createElement('a');
                node.textContent = tasks[i].name; //+ ' ' + tasks[i].price;
                node.className = 'fall';//'fallTasks';
                node.style.left = setPosition();
                node.style.animationDelay = 4.7*i + 's';
                document.body.appendChild(node);
                node = null;
            }
           // fallTasks();
        }
    };
    xhttp.open("GET", host + "/tasksAll", true);
    xhttp.send();
    responsive();
}/*
function fallTasks(){
    var count = 200;
    var timerId = 0;
    var setElem = function(){
        var tasks = document.getElementsByClassName('fallTasks');
        //console.dir(tasks);
        for (var i in tasks)
        {
            console.dir(tasks[i].className);
            tasks[i].className = tasks[i].className.replace(' fall', '');
            tasks[i].style.left = setPosition();
            tasks[i].style.animationDelay = 4*i + 's';
            tasks[i].className += ' fall';
        }
        count--;
    }
    if(count > 0)
    {
        timerID = setInterval(setElem,8000);
    }else {
        clearInterval(timerId);
    };
}*/
function setPosition(){
    var screenH = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    var screenW = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var posLeft = Math.random()*(screenW - 150);
    return posLeft + 'px';
}
function responsive(){
    var screenH = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    var screenW = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if ((screenW/screenH < 0.0075 && screenW < 768) || screenH < 500)
    {
        document.getElementsByClassName('content')[0].style.bottom = 30 + 'px';
    }else{document.getElementsByClassName('content')[0].style.bottom = 130 + 'px';}
}
$(window).on('orientationchange',function(){
    responsive();
});
</script>
