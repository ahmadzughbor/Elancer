<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= {{asset('css/bootstrap.min.css')}}>
    <title>{{config('app.name')}} </title>
</head>

<body>
    <div class="conteniner">
        <h1 class="mb-3"><?= $title ?? 'show'  ?></h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name </th>
                        <th>slug </th>
                        <th>prrent id</th>
                        <th>created at</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{$category->id}} </td>
                            <td><a href="{{route('categories.show',[$category->id])}}">{{ $category->name }} </a></td>
                            <td>{{$category->slug}} </td>
                            <td>{{$category->parent_id }}</td>
                            <td>{{$category->created_at}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
