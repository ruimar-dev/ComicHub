<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>ComicHub</title>

  <link rel="stylesheet" href="../public/css/style.css">

</head>

<body onload="character()">
  <div class="jumbotron">
    <div class="container">
      <a href="../../index.php">Volver</a>
      <h1 class="header-main-title">Buscador de Comic Marvel</h1>
      <form id="connectionForm">

        <div class="form-group">
          <input required type="text" name="name" id="name" class="form-control character-search-box"
            placeholder="(Ex. Hulk, Iron Man, Spider-Man, etc...)">
        </div>
        <input type="submit" value="Search!" class="btn btn-danger mb-2 float-right search-character-button">

      </form>
    </div>
  </div>

  <div class="container" id="contentContainer">

    <div class="d-flex align-items-center" id="characterSpinnerSection"></div>
    <div class="d-flex align-items-center" id="comicsSpinnerSection"></div>
      <section id="characterSection"></section>
      <section id="comicSection"></section>
  </div>

  <script src="main.js"></script>

</body>

</html>