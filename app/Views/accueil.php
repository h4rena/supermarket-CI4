<?= view('templates/header', ['pageTitle' => $pageTitle, 'pageSubtitle' => $pageSubtitle, 'activeNav' => $activeNav, 'caisse' => $caisse ?? null]) ?>

<div class="card" style="max-width:480px;">
  <form method="post" action="<?= site_url('/choisir-caisse') ?>">
    <div class="field">
      <label for="caisse">Choisir Caisse</label>
      <select name="caisse" id="caisse" required>
        <option value="">— Sélectionnez une caisse —</option>
        <?php foreach ($caisses as $c): ?>
          <option value="<?= esc($c->numero) ?>" <?= isset($caisse) && $caisse === $c->numero ? 'selected' : '' ?>>
            Caisse n° <?= esc($c->numero) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn">Valider</button>
  </form>
</div>

<?= view('templates/footer') ?>
