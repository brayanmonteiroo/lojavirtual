<section class="container my-5">
  <h2 class="text-center mb-4">Produtos em Ofertas</h2>
  <div class="row">
    <?php if (!empty($produtos)): ?>
      <?php foreach ($produtos as $produto): ?>
        <!-- Produto 1 -->
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <img src="https://placehold.co/600x400" class="card-img-top" alt="Produto 1">
            <div class="card-body text-center">
              <h5 class="card-title"><?php echo htmlspecialchars($produto->nome, ENT_QUOTES, 'UTF-8')  ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8')  ?></p>
              <p class="text-success fw-bold">R$ <?php echo number_format($produto->preco, 2, ',', '.') ?></p>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php else: ?>
      <div class="alert alert-warning" role="alert">
        <p>Nenhum produto para exibir!</p>
      </div>



    <?php endif ?>
  </div>
</section>