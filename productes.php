<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productes - Cooperativa Girasols</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/productes.css">
</head>

<body>

  <header>
    <div class="leaf-icon">🌻</div>
    <div>
      <h1>Els nostres productes</h1>
      <p>Cooperativa Girasols de Sant Martí</p>
    </div>
    <a href="/index.php" class="btn-tornar">← Tornar</a>
  </header>

  <div class="search-bar">
    <input type="text" id="search" placeholder="Cerca un producte..." oninput="filtrar()">
    <span class="counter" id="counter"></span>
  </div>

  <div class="grid" id="grid"></div>

  <footer>
    Cooperativa Girasols de Sant Martí &mdash; Productes frescos i de temporada
  </footer>

  <script>
    const productes = [{
        nom: "All tendre",
        emoji: "🧄",
        tag: "verdura",
        cerca: "all tendre"
      },
      {
        nom: "Alls secs",
        emoji: "🧄",
        tag: "verdura",
        cerca: "alls secs"
      },
      {
        nom: "Alvocat",
        emoji: "🥑",
        tag: "fruita",
        cerca: "alvocat"
      },
      {
        nom: "Ametlles",
        emoji: "🌰",
        tag: "altre",
        cerca: "ametlles"
      },
      {
        nom: "Api (es cobra a pes)",
        emoji: "🥬",
        tag: "verdura",
        cerca: "api"
      },
      {
        nom: "Aranja",
        emoji: "🍊",
        tag: "fruita",
        cerca: "aranja taronja"
      },
      {
        nom: "Bleda",
        emoji: "🥬",
        tag: "verdura",
        cerca: "bleda"
      },
      {
        nom: "Bròcoli",
        emoji: "🥦",
        tag: "verdura",
        cerca: "brocoli"
      },
      {
        nom: "Carbassa",
        emoji: "🎃",
        tag: "verdura",
        cerca: "carbassa"
      },
      {
        nom: "Cacauet (es cobra a pes)",
        emoji: "🥜",
        tag: "llegum",
        cerca: "cacauet"
      },
      {
        nom: "Carbassó",
        emoji: "🥒",
        tag: "verdura",
        cerca: "carbasso"
      },
      {
        nom: "Carxofa",
        emoji: "🌿",
        tag: "verdura",
        cerca: "carxofa"
      },
      {
        nom: "Ceba seca",
        emoji: "🧅",
        tag: "verdura",
        cerca: "ceba seca"
      },
      {
        nom: "Ceba tendra",
        emoji: "🧅",
        tag: "verdura",
        cerca: "ceba tendra"
      },
      {
        nom: "Cigrons",
        emoji: "🫘",
        tag: "llegum",
        cerca: "cigrons"
      },
      {
        nom: "Cogombre",
        emoji: "🥒",
        tag: "verdura",
        cerca: "cogombre"
      },
      {
        nom: "Col Milà",
        emoji: "🥬",
        tag: "verdura",
        cerca: "col mila"
      },
      {
        nom: "Col Picuda",
        emoji: "🥬",
        tag: "verdura",
        cerca: "col picuda"
      },
      {
        nom: "Col Rave",
        emoji: "🥬",
        tag: "verdura",
        cerca: "col rave"
      },
      {
        nom: "Enciam",
        emoji: "🥗",
        tag: "verdura",
        cerca: "enciam"
      },
      {
        nom: "Espàrrec",
        emoji: "🌿",
        tag: "verdura",
        cerca: "esparrec"
      },
      {
        nom: "Espinac",
        emoji: "🥬",
        tag: "verdura",
        cerca: "espinac"
      },
      {
        nom: "Faves",
        emoji: "🫘",
        tag: "llegum",
        cerca: "faves"
      },
      {
        nom: "Herbes pel caldo",
        emoji: "🌿",
        tag: "altre",
        cerca: "herbes caldo"
      },
      {
        nom: "Kale Nero di Toscana",
        emoji: "🥬",
        tag: "verdura",
        cerca: "kale nero toscana"
      },
      {
        nom: "Kiwi",
        emoji: "🥝",
        tag: "fruita",
        cerca: "kiwi"
      },
      {
        nom: "Llenties",
        emoji: "🫘",
        tag: "llegum",
        cerca: "llenties"
      },
      {
        nom: "Llimona",
        emoji: "🍋",
        tag: "fruita",
        cerca: "llimona"
      },
      {
        nom: "Maduixot",
        emoji: "🍓",
        tag: "fruita",
        cerca: "maduixot"
      },
      {
        nom: "Mandarina",
        emoji: "🍊",
        tag: "fruita",
        cerca: "mandarina"
      },
      {
        nom: "Ortanique",
        emoji: "🍊",
        tag: "fruita",
        cerca: "ortanique"
      },
      {
        nom: "Mongeta del Ganxet",
        emoji: "🫘",
        tag: "llegum",
        cerca: "mongeta ganxet"
      },
      {
        nom: "Moniato",
        emoji: "🍠",
        tag: "verdura",
        cerca: "moniato"
      },
      {
        nom: "Nap granel",
        emoji: "🌿",
        tag: "verdura",
        cerca: "nap"
      },
      {
        nom: "Nous",
        emoji: "🌰",
        tag: "altre",
        cerca: "nous"
      },
      {
        nom: "Ous (Mitja dotzena)",
        emoji: "🥚",
        tag: "altre",
        cerca: "ous"
      },
      {
        nom: "Pastanaga (manat)",
        emoji: "🥕",
        tag: "verdura",
        cerca: "pastanaga manat"
      },
      {
        nom: "Pastanaga granel",
        emoji: "🥕",
        tag: "verdura",
        cerca: "pastanaga granel"
      },
      {
        nom: "Patata Àgria",
        emoji: "🥔",
        tag: "verdura",
        cerca: "patata agria"
      },
      {
        nom: "Patata Rudolph",
        emoji: "🥔",
        tag: "verdura",
        cerca: "patata rudolph"
      },
      {
        nom: "Pera Conference",
        emoji: "🍐",
        tag: "fruita",
        cerca: "pera conference"
      },
      {
        nom: "Pèsol",
        emoji: "🫛",
        tag: "llegum",
        cerca: "pesol"
      },
      {
        nom: "Plàtan",
        emoji: "🍌",
        tag: "fruita",
        cerca: "platan"
      },
      {
        nom: "Poma Fuji",
        emoji: "🍎",
        tag: "fruita",
        cerca: "poma fuji"
      },
      {
        nom: "Poma Golden",
        emoji: "🍎",
        tag: "fruita",
        cerca: "poma golden"
      },
      {
        nom: "Poma Story",
        emoji: "🍎",
        tag: "fruita",
        cerca: "poma story"
      },
      {
        nom: "Porro (manat)",
        emoji: "🌿",
        tag: "verdura",
        cerca: "porro"
      },
      {
        nom: "Rave (manat)",
        emoji: "🌿",
        tag: "verdura",
        cerca: "rave"
      },
      {
        nom: "Remolatxa",
        emoji: "🫚",
        tag: "verdura",
        cerca: "remolatxa"
      },
      {
        nom: "Rotlle de 300 bosses compostables 30x40",
        emoji: "♻️",
        tag: "altre",
        cerca: "bosses compostables"
      },
      {
        nom: "Shiitake",
        emoji: "🍄",
        tag: "verdura",
        cerca: "shiitake"
      },
      {
        nom: "Taronja",
        emoji: "🍊",
        tag: "fruita",
        cerca: "taronja"
      },
      {
        nom: "Tomacó",
        emoji: "🍅",
        tag: "verdura",
        cerca: "tomaco tomaquet"
      },
      {
        nom: "Xampinyó",
        emoji: "🍄",
        tag: "verdura",
        cerca: "xampinyo"
      },
      {
        nom: "Xirivia",
        emoji: "🌿",
        tag: "verdura",
        cerca: "xirivia"
      },
    ];

    const tagLabels = {
      verdura: "Verdura",
      fruita: "Fruita",
      llegum: "Llegum",
      altre: "Altre"
    };

    function renderCards(llista) {
      const grid = document.getElementById('grid');
      const counter = document.getElementById('counter');
      counter.textContent = llista.length + ' productes';

      if (llista.length === 0) {
        grid.innerHTML = '<div class="no-results">Cap producte trobat 🔍</div>';
        return;
      }

      grid.innerHTML = llista.map((p, i) => `
    <div class="card" style="animation-delay: ${i * 0.03}s">
      <div class="card-img">${p.emoji}</div>
      <div class="card-body">
        <div class="card-name">${p.nom}</div>
        <span class="card-tag tag-${p.tag}">${tagLabels[p.tag]}</span>
      </div>
    </div>
  `).join('');
    }

    function filtrar() {
      const q = document.getElementById('search').value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
      const filtrats = productes.filter(p => {
        const cerca = p.cerca.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        const nom = p.nom.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        return cerca.includes(q) || nom.includes(q);
      });
      renderCards(filtrats);
    }

    renderCards(productes);
  </script>

</body>

</html>
