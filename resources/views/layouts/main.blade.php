<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JWT SPA</title>
    <link rel="stylesheet" href="{{ asset('sass/app.scss') }}">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">

</head>
<body class='body'>
    <div id="app">
        
    </div>
    <script src="https://rawcdn.githack.com/karolsw3/gradientify/7f5a74cd8380a843477b7abfa9baca2fd127013a/dist/gradientify.min.js"></script>
    <script>
        let gradientify = new Gradientify(
        '.body',
          [
            "linear-gradient(90deg, rgba(32,32,32,1) 0%, rgba(54,1,63,1) 49%, rgba(88,0,99,1) 100%))", // Array of CSS gradients
            "linear-gradient(45deg, rgba(54,1,63,1) 0%, rgba(88,0,99,1) 49%, rgba(54,1,63,1) 100%)",
            "linear-gradient(0deg, rgba(88,0,99,1), rgba(54,1,63,1) )"
          ],
          5000 // Fading interval in miliseconds
        )
    </script>


     
    <style>
        body{
            height: 100vh;
            background: rgb(45, 7, 45);
        }
        #app{
            z-index: 1;
            position: relative;
        }
    </style>
</body>
</html>