<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Arsip Digital</title>
</head>
<body>

    <div class="main-content">
        <header>
            <h1>
            <i class='bx bx-archive'></i> Arsip Digital
            </h1>
            <div class="user">
                <a href="login.php"><h2>Masuk</h2></a>
            </div>
        </header>

        <main>
            <div class="text">
                <h1>ARSIP DOKUMEN SECARA DIGITAL</h1>
            </div>
           <div class="main">
               <img src="img/digital-archive.jpg">
           </div>
        </main>

    </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
            document.querySelector(".drop").classList.remove("show");
            document.querySelector(".dropp").classList.remove("show");
        }

        function drop() {
            document.querySelector(".drop").classList.toggle("show");
            sidebar.classList.add("active");
        }
        function dropp() {
            document.querySelector(".dropp").classList.toggle("show");
            sidebar.classList.add("active");
        }
    </script>
</body>
</html>