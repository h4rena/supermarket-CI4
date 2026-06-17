<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion — SuperCaisse</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#F3F6F2;
  --surface:#FFFFFF;
  --accent:#E2672A;
  --accent-soft:#FBEAE0;
  --text:#1C2620;
  --muted:#6B7A72;
  --border:#DCE6DD;
  --radius:10px;
  --font-display:'Sora', sans-serif;
  --font-body:'Inter', sans-serif;
}
*{box-sizing:border-box;}
html,body{margin:0;padding:0;height:100%;}
body{
  font-family:var(--font-body);
  background:var(--bg);
  color:var(--text);
  display:flex;align-items:center;justify-content:center;
}
.card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:36px 32px;
  width:100%;max-width:380px;
}
.brand{
  font-family:var(--font-display);
  font-weight:700;
  font-size:1.3rem;
  text-align:center;
  margin-bottom:24px;
}
.brand span{color:var(--accent);}
.field{margin-bottom:16px;}
.field label{
  display:block;font-size:0.85rem;font-weight:500;
  margin-bottom:6px;color:var(--muted);
}
.field input{
  width:100%;padding:9px 12px;
  border:1px solid var(--border);border-radius:8px;
  font-family:var(--font-body);font-size:0.92rem;
  background:#fff;
}
.field input:focus{
  outline:2px solid var(--accent);outline-offset:1px;
  border-color:var(--accent);
}
.btn{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--accent);color:#fff;
  border:none;border-radius:8px;
  padding:10px 20px;width:100%;
  font-family:var(--font-body);font-weight:600;
  font-size:0.9rem;cursor:pointer;justify-content:center;
  margin-top:8px;
}
.btn:hover{background:#C8551E;}
.error{
  background:#fee;color:#c33;padding:10px 12px;
  border-radius:8px;font-size:0.85rem;margin-bottom:16px;
}
.field-pwd{position:relative;}
.field-pwd input{padding-right:36px;}
.toggle-pwd{
  position:absolute;right:8px;bottom:8px;
  background:none;border:none;cursor:pointer;
  font-size:1.1rem;padding:4px;color:var(--muted);line-height:1;
}
.toggle-pwd:hover{color:var(--text);}
</style>
</head>
<body>
<div class="card">
  <div class="brand">Super<span>Caisse</span></div>
  <?php if (session()->getFlashdata('error')): ?>
    <div class="error"><?= esc(session()->getFlashdata('error')) ?></div>
  <?php endif; ?>
  <form method="post" action="<?= site_url('/login') ?>">
    <div class="field">
      <label for="nom_utilisateur">Nom d'utilisateur</label>
      <input type="text" name="nom_utilisateur" id="nom_utilisateur" required>
    </div>
    <div class="field field-pwd">
      <label for="mot_de_passe">Mot de passe</label>
      <input type="password" name="mot_de_passe" id="mot_de_passe" required>
      <button type="button" class="toggle-pwd" id="togglePwd" onclick="togglePassword()">👁️</button>
    </div>
    <button type="submit" class="btn">Se connecter</button>
  </form>
  <p style="text-align:center;font-size:0.8rem;color:var(--muted);margin-top:20px;">
    Identifiants de test : <strong>admin</strong> / <strong>password</strong>
  </p>
</div>
<script>
function togglePassword() {
  const input = document.getElementById('mot_de_passe');
  const btn = document.getElementById('togglePwd');
  if (input.type === 'password') {
    input.type = 'text';
    btn.textContent = '🙈';
  } else {
    input.type = 'password';
    btn.textContent = '👁️';
  }
}
</script>
</body>
</html>
