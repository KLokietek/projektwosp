
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
- var n = 5;

.a(style=`--n: ${n}`)
	- for(var i = 0; i < n; i++)
		.dot(style=`--i: ${i}`)
</body>
</html>