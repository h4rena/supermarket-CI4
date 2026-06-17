<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SuperCaisse</title>
<style>
:root{
  --bg:#F3F6F2;
  --surface:#FFFFFF;
  --sidebar:#16332D;
  --sidebar-soft:#1F4A41;
  --text:#1C2620;
  --muted:#6B7A72;
  --accent:#E2672A;
  --accent-soft:#FBEAE0;
  --border:#DCE6DD;
  --radius:10px;
  --font-display:system-ui, -apple-system, 'Segoe UI', sans-serif;
  --font-body:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
  --font-mono:'SF Mono', 'Fira Code', 'Cascadia Code', 'Consolas', monospace;
}
*{box-sizing:border-box;}
html,body{margin:0;padding:0;}
body{
  font-family:var(--font-body);
  background:var(--bg);
  color:var(--text);
  min-height:100vh;
}
a{color:inherit;text-decoration:none;}
.app{
  display:flex;
  min-height:100vh;
}
.sidebar{
  width:230px;
  flex-shrink:0;
  background:var(--sidebar);
  color:#E8EFE9;
  display:flex;
  flex-direction:column;
  padding:24px 0;
  position:relative;
}
.sidebar::after{
  content:"";
  position:absolute;
  top:0; right:-1px; bottom:0;
  width:10px;
  background-image:radial-gradient(circle at 5px 0, transparent 5px, var(--bg) 5.5px);
  background-size:14px 14px;
  background-repeat:repeat-y;
}
.brand{
  font-family:var(--font-display);
  font-weight:700;
  font-size:1.15rem;
  padding:0 24px 22px;
  letter-spacing:0.01em;
}
.brand span{color:var(--accent);}
.nav{
  display:flex;
  flex-direction:column;
  gap:2px;
  margin-top:8px;
}
.nav a{
  display:flex;
  align-items:center;
  gap:12px;
  padding:11px 24px;
  font-size:0.92rem;
  font-weight:500;
  color:#C9D8CF;
  border-left:3px solid transparent;
  transition:background 0.15s, color 0.15s;
}
.nav a:hover{
  background:var(--sidebar-soft);
  color:#fff;
}
.nav a.active{
  background:var(--sidebar-soft);
  color:#fff;
  border-left-color:var(--accent);
}
.nav .icon{
  width:18px; text-align:center; font-size:1rem; opacity:0.9;
}
.sidebar-footer{
  margin-top:auto;
  padding:0 24px;
}
.sidebar-footer a{
  display:flex;
  align-items:center;
  gap:10px;
  padding:11px 0;
  font-size:0.88rem;
  color:#9DB3A6;
  border-top:1px solid rgba(255,255,255,0.08);
  margin-top:8px;
  padding-top:14px;
}
.sidebar-footer a:hover{color:#fff;}
.main{
  flex:1;
  display:flex;
  flex-direction:column;
  min-width:0;
}
.topbar{
  display:flex;
  align-items:center;
  justify-content:space-between;
  background:var(--surface);
  border-bottom:1px solid var(--border);
  padding:16px 28px;
}
.page-title{
  font-family:var(--font-display);
  font-size:1.1rem;
  font-weight:600;
}
.page-title small{
  display:block;
  font-family:var(--font-body);
  font-weight:400;
  font-size:0.8rem;
  color:var(--muted);
  margin-top:2px;
}
.caisse-badge{
  display:flex;
  align-items:center;
  gap:10px;
  background:var(--accent-soft);
  border:1px dashed var(--accent);
  border-radius:999px;
  padding:7px 16px 7px 8px;
  font-family:var(--font-mono);
  font-size:0.85rem;
  font-weight:600;
  color:#9C3D14;
}
.caisse-badge .dot{
  width:8px;height:8px;border-radius:50%;
  background:var(--accent);
}
.content{
  flex:1;
  padding:28px;
}
.card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:24px;
}
table.ticket{
  width:100%;
  border-collapse:collapse;
  font-family:var(--font-mono);
  font-size:0.88rem;
}
table.ticket th{
  text-align:left;
  font-family:var(--font-body);
  font-weight:600;
  font-size:0.78rem;
  text-transform:uppercase;
  letter-spacing:0.04em;
  color:var(--muted);
  padding:10px 12px;
  border-bottom:1px solid var(--border);
}
table.ticket td{
  padding:10px 12px;
  border-bottom:1px solid var(--border);
}
table.ticket tfoot td{
  font-weight:600;
  border-bottom:none;
  border-top:2px solid var(--text);
}
.field{margin-bottom:16px;}
.field label{
  display:block;
  font-size:0.85rem;
  font-weight:500;
  margin-bottom:6px;
  color:var(--muted);
}
.field select, .field input{
  width:100%;
  padding:9px 12px;
  border:1px solid var(--border);
  border-radius:8px;
  font-family:var(--font-body);
  font-size:0.92rem;
  background:#fff;
}
.field select:focus, .field input:focus{
  outline:2px solid var(--accent);
  outline-offset:1px;
  border-color:var(--accent);
}
.btn{
  display:inline-flex;
  align-items:center;
  gap:8px;
  background:var(--accent);
  color:#fff;
  border:none;
  border-radius:8px;
  padding:10px 20px;
  font-family:var(--font-body);
  font-weight:600;
  font-size:0.9rem;
  cursor:pointer;
}
.btn:hover{background:#C8551E;}
.menu-toggle{display:none;}
@media (max-width: 820px){
  .sidebar{
    position:fixed; left:0; top:0; bottom:0;
    transform:translateX(-100%);
    transition:transform 0.2s;
    z-index:50;
  }
  .sidebar.open{transform:translateX(0);}
  .menu-toggle{
    display:inline-flex;
    background:none; border:none;
    font-size:1.3rem;
    margin-right:10px;
    cursor:pointer;
  }
}
</style>
</head>
<body>

<div class="app">

  <aside class="sidebar" id="sidebar">
    <div class="brand">Super<span>Caisse</span></div>
    <nav class="nav">
      <a href="<?= site_url('/') ?>" class="<?= $activeNav === 'accueil' ? 'active' : '' ?>"><span class="icon">⌂</span> Accueil</a>
      <a href="<?= site_url('/choisir-caisse') ?>" class="<?= $activeNav === 'choisir' ? 'active' : '' ?>"><span class="icon">▾</span> Choisir une caisse</a>
      <a href="<?= site_url('/saisie-achats') ?>" class="<?= $activeNav === 'saisie' ? 'active' : '' ?>"><span class="icon">▤</span> Saisie des achats</a>
      <a href="<?= site_url('/produits') ?>" class="<?= $activeNav === 'produits' ? 'active' : '' ?>"><span class="icon">▦</span> Produits</a>
      <a href="<?= site_url('/historique') ?>" class="<?= $activeNav === 'historique' ? 'active' : '' ?>"><span class="icon">◷</span> Historique</a>
    </nav>
    <div class="sidebar-footer">
      <a href="<?= site_url('/logout') ?>"><span class="icon">⏻</span> Déconnexion</a>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div style="display:flex; align-items:center;">
        <button class="menu-toggle" id="menuToggle">☰</button>
        <div class="page-title">
          <?= $pageTitle ?>
          <?php if (isset($pageSubtitle)): ?>
            <small><?= $pageSubtitle ?></small>
          <?php endif; ?>
        </div>
      </div>
      <div class="caisse-badge">
        <span class="dot"></span> Caisse n° <?= isset($caisse) ? esc($caisse) : '2' ?>
      </div>
    </header>

    <main class="content">
