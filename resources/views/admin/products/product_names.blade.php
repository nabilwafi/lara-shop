<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>Product Menu</h2>
  </div>
  
  <div class="card-body">
    <div class="nav flex-column">
      <a class="nav-link" href="{{ route('admin.products.edit', $productID) }}">Product Detail</a>
      <a class="nav-link" href="{{ route('admin.products.images', $productID) }}">Product Images</a>
    </div>
  </div>
</div>