<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>五子棋</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">五子棋</a>
  </div>
</nav>
<div class="container">
<div class="alert alert-primary" role="alert">
    <span>局號：<span class="round"></span></span>
    <span>玩家：<span class="player"></span>-<span class="status"></span></span>
    <button type="button" class="btn btn-primary new_round">新局</button>
</div>
    <table class="Table">
        <tbody>
            @for($X = 0; $X < 11; $X++)
            <tr>
                    @for($Y = 0; $Y < 11; $Y++)
                    <td id="nine_{{$X}}_{{$Y}}" class="nine"></td>
                    @endfor
            </tr>
            @endfor
        </tbody>

    </table>
</div>
</body>
</html>
<script src="/js/app.js"></script>
