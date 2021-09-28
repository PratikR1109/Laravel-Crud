<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel - Milan</title>
    <style>
        body{
            background-color: skyblue;
        }
        table{
            margin: auto;
        }
        tr{
            background-color: black;
            color: aqua;
        }
        td{
            background-color: green;
            color: white;
            text-align: center;
        }
        h1{
            color: red;
            text-align: center;
        }
        h3{
            color: red;
            text-align: center;
        }
        a{
            text-decoration: none;
            color: blue;
            background-color: white;
        }
        .validation-error{
            text-align: center;
            color: yellow;
        }
    </style>
</head>
<body>
<h1>Login Form</h1>

<!-- All Errors On The Top -->
<!-- @if ($errors->any())
  <div class="validation-error">
     <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
     @if ($errors->has('email'))
     @endif
  </div>
@endif -->

    <form id="table-form" method="POST" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td> &nbsp; User Id &nbsp; </td>
                <td>
                    <input type="text" name="email" id="email" value="{{old('email') ? old('email') : @$user->email}}" placeholder="Enter Email Address">
                    @error('email')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>            
            <tr>
                <td> &nbsp; Password &nbsp; </td>
                <td>
                    <input type="pwd" name="pwd" id="pwd" value="{{old('pwd') ? old('pwd') : @$user->pwd}}" placeholder="Enter Password">
                    @error('pwd')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>            
            <tr>
                <td> &nbsp; Submit &nbsp; </td>
                <td>
                    <input type="submit" name="submit" id="submit" value="submit">
                </td>
            </tr>
        </table>
    </form>
    <br>
    <table>
        <tr>
            <td><a href="/insert"> &nbsp; Insert Data &nbsp; </a></td>
            <td><a href="/view"> &nbsp; View Data &nbsp; </a></td>
        </tr>
    </table>
</body>
</html>