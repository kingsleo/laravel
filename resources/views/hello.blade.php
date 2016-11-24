<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hello</title>
</head>
<body>
<form method="post" action="/">
    <input type="text" name="msg" />
    {{method_field('PUT')}}
    <input type="submit" value="提交" />
</form>
</body>
</html>