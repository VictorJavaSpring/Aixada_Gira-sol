<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productes - Cooperativa Girasols</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    :root {
      --verd: #2d6a4f;
      --verd-clar: #52b788;
      --groc: #f4a261;
      --crema: #fefae0;
      --fosc: #1b2018;
      --gris: #6c757d;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: var(--crema);
      font-family: 'DM Sans', sans-serif;
      color: var(--fosc);
    }

    header {
      background-color: var(--verd);
      padding: 2rem 3rem;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    header h1 {
      font-family: 'Playfair Display', serif;
      color: white;
      font-size: 2rem;
      letter-spacing: 0.02em;
    }

    header p {
      color: rgba(255, 255, 255, 0.75);
      font-size: 0.95rem;
      margin-top: 0.2rem;
    }

    .leaf-icon {
      font-size: 2.5rem;
    }

    .search-bar {
      background: white;
      padding: 1.5rem 3rem;
      border-bottom: 1px solid #e0e0d0;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .search-bar input {
      flex: 1;
      padding: 0.6rem 1rem;
      border: 2px solid #ddd;
      border-radius: 25px;
      font-size: 1rem;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color 0.2s;
    }

    .search-bar input:focus {
      border-color: var(--verd-clar);
    }

    .counter {
      color: var(--gris);
      font-size: 0.9rem;
      white-space: nowrap;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1.5rem;
      padding: 2.5rem 3rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: default;
      animation: fadeIn 0.4s ease both;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(12px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card-img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      background: #f0f0e8;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 4rem;
    }

    .card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .card-body {
      padding: 1rem;
    }

    .card-name {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      color: var(--fosc);
      line-height: 1.3;
    }

    .card-tag {
      display: inline-block;
      margin-top: 0.4rem;
      font-size: 0.72rem;
      padding: 0.2rem 0.6rem;
      border-radius: 20px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .tag-verdura {
      background: #d8f3dc;
      color: #1b4332;
    }

    .tag-fruita {
      background: #fff3cd;
      color: #856404;
    }

    .tag-llegum {
      background: #f8d7da;
      color: #842029;
    }

    .tag-altre {
      background: #e2e3e5;
      color: #383d41;
    }

    .no-results {
      grid-column: 1/-1;
      text-align: center;
      padding: 4rem;
      color: var(--gris);
      font-size: 1.1rem;
    }

    .btn-tornar {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255, 255, 255, 0.15);
      color: white;
      text-decoration: none;
      padding: 0.5rem 1.2rem;
      border-radius: 25px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
      transition: background 0.2s;
      margin-left: auto;
    }

    .btn-tornar:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    footer {
      text-align: center;
      padding: 2rem;
      color: var(--gris);
      font-size: 0.85rem;
      border-top: 1px solid #e0e0d0;
      margin-top: 2rem;
    }
  </style>
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