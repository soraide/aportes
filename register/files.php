<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subir Archivos PDF</title>
</head>

<body>
  <h1>Subir Archivos PDF</h1>
  <input type="file" multiple id="input-pdfs">

  <div id="div-nombres-pdfs"></div>

  <script>
    const inputPdfs = document.getElementById("input-pdfs");
    const divNombresPdfs = document.getElementById("div-nombres-pdfs");

    const MAX_ARCHIVOS = 7;

    inputPdfs.addEventListener("change", (event) => {
      const archivos = event.target.files;

      if (archivos.length > MAX_ARCHIVOS) {
        alert(`Solo se pueden subir ${MAX_ARCHIVOS} archivos.`);
        inputPdfs.value = "";
      } else {
        for (const archivo of archivos) {
          divNombresPdfs.innerHTML += `<li>${archivo.name}</li>`;
        }
      }
    });

  </script>
</body>

</html>