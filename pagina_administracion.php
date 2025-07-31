<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>El Buen Café - Presentación</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Open+Sans&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      overflow: hidden;
      background: #000;
    }

    .slide {
      display: none;
      height: 100vh;
      width: 100vw;
      background-size: cover;
      background-position: center;
      color: #fff;
      padding: 4rem;
      text-align: center;
      position: relative;
    }

    .slide::after {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 0;
    }

    .slide-content {
      position: relative;
      z-index: 1;
    }

    .active {
      display: block;
    }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 4rem;
      margin-bottom: 1rem;
    }

    p {
      font-size: 1.5rem;
      max-width: 800px;
      margin: auto;
      line-height: 1.6;
    }

    .buttons {
      margin-top: 2rem;
      z-index: 2;
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap; /* para que se ajuste en pantallas pequeñas */
    }

    .buttons button {
      background: rgba(90, 60, 50, 0.5);

      color: #fff;
      border: none;
      padding: 3rem 5rem;
      font-size: 3rem;
      margin: 0;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      flex: 1 1 auto;
      min-width: 150px;
      max-width: 350px;
    }

    .buttons button:hover {
      background: #3e2723;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93');">
    <div class="slide-content">
      <h1>Bienvenidos </h1>
      <p>Una experiencia para los sentidos. Más que una compra , un momento inolvidable.</p>

      <div class="buttons">
        <form action="listado_proveedor.php" method="get">
          <button type="submit">Siguiente</button>
        </form>

        <form action="listado_proveedor.php" method="get">
          <button type="submit">hola</button>
        </form>  
      </div>

    </div>
  </div>

  <script>
    const slides = document.querySelectorAll('.slide');
    let current = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });
    }

    function nextSlide() {
      if (current < slides.length - 1) {
        current++;
        showSlide(current);
      }
    }

    function prevSlide() {
      if (current > 0) {
        current--;
        showSlide(current);
      }
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowRight') nextSlide();
      if (e.key === 'ArrowLeft') prevSlide();
    });
  </script>

</body>
</html>
