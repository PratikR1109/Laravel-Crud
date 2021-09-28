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
<h1>Registration Form</h1>

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
                <td> &nbsp; First Name &nbsp; </td>
                <td>
                    <input type="text" name="fname" id="fname" value="{{old('fname') ? old('fname') : @$user->fname}}" placeholder="Enter First Name">
                    @error('fname')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td> &nbsp; Last Name &nbsp; </td>
                <td>
                    <input type="text" name="lname" id="lname" value="{{old('lname') ? old('lname') : @$user->lname}}" placeholder="Enter Last Name">
                    @error('lname')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr> 
            <tr>
                <td> &nbsp; Email Id &nbsp; </td>
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
                <td> &nbsp; Contact &nbsp; </td>
                <td>
                    <input type="text" name="contact" id="contact" value="{{old('contact') ? old('contact') : @$user->contact}}" placeholder="Enter Contact">
                    @error('contact')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td> &nbsp; Gender &nbsp; </td>
                <td>
                    <input type="radio" name="gender" id="gender" value="Male" 
                    {{ old('gender')=='Male' ? 'checked' : '' }} {{(@$user->gender=='Male') ? 'checked' : '' }}> Male
                    <input type="radio" name="gender" id="gender" value="Female" 
                    {{ old('gender')=='Female' ? 'checked' : '' }} {{(@$user->gender=='Female') ? 'checked' : '' }}> Female
                    @error('gender')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td> &nbsp; Birthdate &nbsp; </td>
                <td>
                    <select name="dd" id="dd">
                        <option value="">DD</option>
                        @for($i=1;$i<=31;$i++)
                            <option value="{{$i}}" 
                            {{ old('dd') == $i ? 'selected' : '' }} {{(@$birthdate[0] == $i) ? "selected" : "" }}>{{$i}}</option>
                        @endfor
                    </select>
                    <select name="mm" id="mm">
                        <option value="">MM</option>
                        @for($i=1;$i<=12;$i++)
                            <option value="{{$i}}" 
                            {{ old('mm') == $i ? 'selected' : '' }} {{(@$birthdate[1] == $i) ? "selected" : "" }}>{{$i}}</option>
                        @endfor
                    </select>
                    <select name="yy" id="yy">
                        <option value="">YYYY</option>
                        @for($i=1990;$i<=date("Y");$i++)
                            <option value="{{$i}}" 
                            {{ old('yy') == $i ? 'selected' : '' }} {{(@$birthdate[2] == $i) ? "selected" : "" }}>{{$i}}</option>
                        @endfor
                    </select>
                    @error('dd')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                    @error('mm')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                    @error('yy')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
           <tr>
                <td> &nbsp; Entrydate &nbsp; </td>
                <td> <input type="date" name="entrydate" value="{{old('entrydate') ? old('entrydate') : @$user->entrydate}}">
                @error('entrydate')
                    <div class="validation-error">{{ $message }}</div>
                @enderror</td>
            </tr>
            <tr>
                <td> &nbsp; Hobby &nbsp; </td>
                <td id="hobby">
                    <input type="checkbox" name="hobby[]" value="Music" 
                    {{ (is_array(old('hobby')) and in_array('Music', old('hobby'))) ? 'checked' : '' }}
                    @if(!empty($hobby)){ @if(@in_array('Music',@$hobby )) {{"checked" }}@endif }@endif > Music <br>
                    <input type="checkbox" name="hobby[]" value="Dance" 
                    {{ (is_array(old('hobby')) and in_array('Dance', old('hobby'))) ? 'checked' : '' }}
                    @if(!empty($hobby)){ @if(@in_array('Dance',@$hobby )) {{"checked" }}@endif }@endif > Dance <br>
                    <input type="checkbox" name="hobby[]" value="Books" 
                    {{ (is_array(old('hobby')) and in_array('Books', old('hobby'))) ? 'checked' : '' }}
                    @if(!empty($hobby)){ @if(@in_array('Books',@$hobby )) {{"checked" }}@endif }@endif > Books <br>
                    <input type="checkbox" name="hobby[]" value="Movie" 
                    {{ (is_array(old('hobby')) and in_array('Movie', old('hobby'))) ? 'checked' : '' }}
                    @if(!empty($hobby)){ @if(@in_array('Movie',@$hobby )) {{"checked" }}@endif }@endif > Movie <br>
                    <input type="checkbox" name="hobby[]" value="Sports" 
                    {{ (is_array(old('hobby')) and in_array('Sports', old('hobby'))) ? 'checked' : '' }}
                    @if(!empty($hobby)){ @if(@in_array('Sports',@$hobby )) {{"checked" }}@endif }@endif > Sports <br>
                    @error('hobby')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td> &nbsp; Image &nbsp; </td>
                <td >
                    <input type="file" name="image" id="image" value="{{old('image') ? old('image') : @$user->image}}"><br> 
                    @error('image')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                    {{@$user->image}}
                    @if(@$user->id) <img src="{{asset('upload/'.@$user->image)}}" width="60px"> @endif
                </td>
            </tr>    
            <tr>
                <td> &nbsp; Register &nbsp; </td>
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