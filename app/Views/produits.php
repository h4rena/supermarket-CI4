<?= view('templates/header', ['pageTitle' => $pageTitle, 'pageSubtitle' => $pageSubtitle, 'activeNav' => $activeNav, 'caisse' => $caisse ?? null]) ?>

<div class="card">
  <table class="ticket">
    <thead>
      <tr><th>Désignation</th><th>Prix unit.</th><th>Stock</th></tr>
    </thead>
    <tbody>
      <?php foreach ($produits as $p): ?>
        <tr>
          <td><?= esc($p->designation) ?></td>
          <td><?= esc($p->prix) ?></td>
          <td><?= esc($p->quantite_stock) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= view('templates/footer') ?>
