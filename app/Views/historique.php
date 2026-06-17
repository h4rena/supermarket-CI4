<?= view('templates/header', ['pageTitle' => $pageTitle, 'pageSubtitle' => $pageSubtitle, 'activeNav' => $activeNav, 'caisse' => $caisse]) ?>

<?php if (!$caisse): ?>
  <div class="card" style="text-align:center; padding:40px; color:var(--muted);">
    <p style="font-size:1.1rem;">Veuillez d'abord choisir une caisse</p>
    <a href="<?= site_url('/choisir-caisse') ?>" class="btn" style="margin-top:12px;">Choisir une caisse</a>
  </div>
<?php elseif (empty($ventes)): ?>
  <div class="card" style="text-align:center; padding:40px; color:var(--muted);">
    <p style="font-size:1.1rem;">Aucun achat clôturé pour cette caisse</p>
  </div>
<?php else: ?>
  <?php foreach ($ventes as $v): ?>
    <div class="card" style="margin-bottom:16px;">
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
        <span style="font-weight:600;">Vente #<?= esc($v->id_vente) ?></span>
        <span style="color:var(--muted); font-size:0.85rem;"><?= esc($v->date_vente) ?></span>
      </div>
      <table class="ticket">
        <thead>
          <tr><th>Produit</th><th>Prix unit.</th><th>Qté</th><th>Montant</th></tr>
        </thead>
        <tbody>
          <?php foreach ($v->achats as $a): ?>
            <tr>
              <td><?= esc($a->designation) ?></td>
              <td><?= esc($a->prix_unitaire) ?></td>
              <td><?= esc($a->quantite) ?></td>
              <td><?= esc($a->montant) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr><td colspan="3">Total</td><td><?= esc($v->total) ?></td></tr>
        </tfoot>
      </table>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?= view('templates/footer') ?>
