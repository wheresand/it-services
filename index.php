<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>it-services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    @keyframes colorChange {
        0% { color: red; }
        25% { color: blue; }
        50% { color: green; }
        75% { color: orange; }
        100% { color: red; }
    }

    .color-changing-text {
        animation: colorChange 2s infinite;
    }
</style>
</head>
<body>
    <div class="container pt-5">
    <h1 id="welcome-text" class="text-center">Welcome it-services</h1>

    </div>

    <script>
    function changeColor() {
        const colors = ["red", "blue", "green", "purple", "orange"];
        let text = document.getElementById("welcome-text");
        text.style.color = colors[Math.floor(Math.random() * colors.length)];
    }

    setInterval(changeColor, 1000); // เปลี่ยนสีทุก 1 วินาที
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>