<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lession</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lession</a>
  </div>
</nav>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">流水號</th>
      <th scope="col">姓名</th>
      <th scope="col">生日</th>
      <th scope="col">性別</th>
      <th scope="col">動作</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $student)
    <tr>
      <td>{{$student['student_id']}}</td>
      <td>{{$student['student_name']}}</td>
      <td>{{$student['student_birth']}}</td>
      <td>{{$student['student_sex']}}</td>
      <td><button type="button" class="btn btn-success action_box">編輯</button><button type="button" class="btn btn-danger action_box delete_btn">刪除</button></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</body>
</html>
<script src="/js/app.js"></script>
