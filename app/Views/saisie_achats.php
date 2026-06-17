<?= view('templates/header', ['pageTitle' => $pageTitle, 'pageSubtitle' => $pageSubtitle, 'activeNav' => $activeNav, 'caisse' => $caisse]) ?>

<?php if (!$caisse): ?>
  <div class="card" style="text-align:center; padding:40px; color:var(--muted);">
    <p style="font-size:1.1rem;">Veuillez d'abord choisir une caisse</p>
    <a href="<?= site_url('/choisir-caisse') ?>" class="btn" style="margin-top:12px;">Choisir une caisse</a>
  </div>
<?php else: ?>

<div class="card" style="margin-bottom:20px;">
  <form method="post" action="<?= site_url('/ajouter-achat') ?>">
    <div class="field" style="display:flex; gap:16px; align-items:flex-end;">
      <div style="flex:2;">
        <label for="produit">Produit</label>
        <select name="produit" id="produit" required>
          <option value="">— Choisir un produit —</option>
          <?php foreach ($produits as $p): ?>
            <option value="<?= esc($p->id) ?>"><?= esc($p->designation) ?> — <?= esc($p->prix) ?> Ar</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div style="flex:1;">
        <label for="quantite">Quantité</label>
        <input type="number" name="quantite" id="quantite" min="1" value="1" required>
      </div>
      <button type="submit" class="btn">Valider</button>
    </div>
  </form>
</div>

<?php if (!empty($achats)): ?>
  <div style="display:flex; justify-content:flex-end; margin-bottom:16px;">
    <form method="post" action="<?= site_url('/cloturer') ?>" onsubmit="return confirm('Clôturer cet achat ? La liste sera vidée pour le prochain client.')">
      <button type="submit" class="btn">Clôturer achat</button>
    </form>
  </div>
<?php endif; ?>

<div class="card">
  <table class="ticket">
    <thead>
      <tr><th>Produit</th><th>Prix unit.</th><th>Qté</th><th>Montant</th></tr>
    </thead>
    <tbody>
      <?php if (empty($achats)): ?>
        <tr><td colspan="4" style="text-align:center;color:var(--muted);">Aucun achat enregistré</td></tr>
      <?php else: ?>
        <?php foreach ($achats as $a): ?>
          <tr>
            <td><?= esc($a->designation) ?></td>
            <td><?= esc($a->prix_unitaire) ?></td>
            <td><?= esc($a->quantite) ?></td>
            <td><?= esc($a->montant) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <tr><td colspan="3">Total</td><td><?= esc($total) ?></td></tr>
    </tfoot>
  </table>
</div>

<?php endif; ?>

<?= view('templates/footer') ?>
