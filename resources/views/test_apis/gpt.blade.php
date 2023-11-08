<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPT Test API</title>
</head>
<body>
    <form method="POST" action="{{route('post_gpt')}}">
        @csrf
        <textarea name="text" id="" cols="150" rows="5"></textarea>
        <br>
        <br>        
        <input type="submit">
    </form>
</body>
</html>