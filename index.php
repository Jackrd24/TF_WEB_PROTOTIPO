<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../CSS/estilo-2.css" rel="stylesheet" type="text/css"/>
    <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Página Principal</title>
    </head>
    <body>
    <nav>
        <div class="logo">
            <a href="principal.php">
                <img src="../FOTOS/LOGO/logo.jpg" alt="Logo"/>
            </a>
        </div>
        <ul class="menu">
            <li><a href="rutas.php">Rutas</a></li>
            <li><a href="choferes.php">Choferes</a></li>
            <li><a href="inicio_sesion.php">Iniciar Sesión</a></li>
        </ul>
    </nav>

    <div class="slideshow-container">
        <div class="slide active">
            <img src="../FOTOS/FotosPrincipal/FOTO-1.jpg" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="../FOTOS/FotosPrincipal/FOTO-2.jpg" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="../FOTOS/FotosPrincipal/FOTO-3.jpg" alt="Slide 3">
        </div>
        <div class="prev">&#10094;</div>
        <div class="next">&#10095;</div>
    </div>

    <div class="titulo1">
        <h2>¡LOS LUGARES TURISTICOS RECOMENDADOS DEL MES!</h2>
    </div>

    <div class="image-container">
        <div class="image">
            <img src="https://www.peru.travel/Contenido/Destino/Imagen/pe/27/1.1/Principal/Plaza%20de%20Armas%20Arequipa.jpg" alt="Imagen 1">
            <div class="image-name">Arequipa</div>
        </div>
        <div class="image">
            <img src="https://viajerosocultos.com/wp-content/uploads/2022/11/panoramic-view-of-the-mountainous-landscape-of-ayacucho.jpg" alt="Imagen 2">
            <div class="image-name">Ayacucho</div>
        </div>
        <div class="image">
            <img src="https://i.pinimg.com/originals/1c/45/a6/1c45a6ea02362ea50a06c9ca85d11298.jpg" alt="Imagen 3">
            <div class="image-name">Chiclayo</div>
        </div>
        <div class="image">
            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/60/e1/d1/caption.jpg?w=1200&h=-1&s=1" alt="Imagen 4">
            <div class="image-name">Cusco</div>
        </div>
    </div>

    <script>
        const slides = document.querySelectorAll('.slide');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');

        let slideIndex = 0;

        showSlide(slideIndex);

        prevButton.addEventListener('click', () => {
            slideIndex--;
            if (slideIndex < 0) {
                slideIndex = slides.length - 1;
            }
            showSlide(slideIndex);
        });

        nextButton.addEventListener('click', () => {
            slideIndex++;
            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }
            showSlide(slideIndex);
        });

        function showSlide(index) {
            slides.forEach((slide) => {
                slide.classList.remove('active');
            });
            slides[index].classList.add('active');
        }
    </script>
</body>
</html>