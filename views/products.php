<?php
ob_start();
?>
 
<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Products</h2>
        <p class="text-muted mb-0">Manage and track all your keycaps</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
 
        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>
                    <?php echo isset($aproduct) ? 'Edit Product' : 'Product Form'; ?>
                </h5>
                <small class="text-muted">Fill in the details of a product</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">* Required fields</span>
            </div>
        </div>
         
        <hr>
 
        <form action="<?= BASE_URL ?>productcontroller/<?= isset($aproduct) ? 'update' : 'save' ?>" method="post" class="needs-validation" novalidate>
            <?php if (isset($aproduct)): ?>
            <input type="hidden" name="original_product_num" value="<?php echo htmlspecialchars($aproduct['fld_product_num']); ?>">
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="pid" class="form-label">Product ID <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_num" id="pid" type="text" class="form-control" placeholder="Enter Product ID" value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_num']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="name" class="form-label">Name <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_name" id="name" type="text" class="form-control" placeholder="Enter Product Name" value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_name']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label">Price <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_price" id="price" type="number" class="form-control" placeholder="Enter Price" value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_price']) : ''; ?>" required min="0" step="0.01">
                </div>
                <div class="col-md-3">
                <label for="brand" class="form-label">Brand <span class="text-danger" aria-hidden="true">*</span></label>
                <?php
                $brands = ['Keychron', 'Ducky', 'Akko', 'Gateron'];
                $selectedBrand = $aproduct['fld_product_brand'] ?? '';
                ?>
                <select name="product_brand" id="brand" class="form-select" required>
                    <option value="">Select Brand</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= htmlspecialchars($brand) ?>" <?= $selectedBrand === $brand ? 'selected' : '' ?>><?= htmlspecialchars($brand) ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
 
                <div class="col-md-3">
                <label for="material" class="form-label">Material <span class="text-danger">*</span></label>
                <?php
                $materials = ['PBT', 'ABS', 'POM'];
                $selectedMaterial = $aproduct['fld_product_material'] ?? '';
                ?>
                <select name="product_material" id="material" class="form-select" required>
                    <option value="">Select Material</option>
                    <?php foreach ($materials as $material): ?>
                        <option value="<?= htmlspecialchars($material) ?>" <?= $selectedMaterial === $material ? 'selected' : '' ?>><?= htmlspecialchars($material) ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
 
                <div class="col-md-3">
                <label for="profile" class="form-label">Profile <span class="text-danger">*</span></label>
                <?php
                $profiles = ['OEM', 'Cherry', 'SA', 'DSA'];
                $selectedProfile = $aproduct['fld_product_profile'] ?? '';
                ?>
                <select name="product_profile" id="profile" class="form-select" required>
                    <option value="">Select Profile</option>
                    <?php foreach ($profiles as $profile): ?>
                        <option value="<?= htmlspecialchars($profile) ?>" <?= $selectedProfile === $profile ? 'selected' : '' ?>><?= htmlspecialchars($profile) ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                 
                <div class="col-md-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_quantity" id="quantity" type="number" class="form-control" placeholder="Enter Quantity" value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_quantity']) : ''; ?>" required min="0">
                </div>
                <div class="col-md-3">
                    <label for="product_image" class="form-label">Image</label>
                    <input name="product_image" id="product_image" type="text" class="form-control" placeholder="Enter image filename" value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_image'] ?? '') : ''; ?>">
                </div>
            </div>
             
            <hr class="mt-4 mb-3">
             
            <div>
                <button type="submit" name="<?= isset($aproduct) ? 'update' : 'create' ?>" class="btn btn-primary">
                <i class="bi bi-save me-1"></i><?= isset($aproduct) ? 'Update' : 'Create' ?>
                </button> 
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
            </div>
        </form>
    </div>
</div>
 
<div class="card shadow-sm">
    <div class="card-body">
  
        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-table text-primary me-2"></i>
                    Product List
                </h5>
                <small class="text-muted">View and manage all products in the inventory</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Total: <?php echo !empty($products) ? count($products) : 0; ?> items</span>
        </div>
    </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['fld_product_num']); ?></td>
                                <td><?php echo htmlspecialchars($product['fld_product_name']); ?></td>
                                <td>$<?php echo number_format((float)$product['fld_product_price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($product['fld_product_brand']); ?></td>
                                <td>
                                    <a href="<?=BASE_URL; ?>productcontroller/edit/<?php echo htmlspecialchars($product['fld_product_num']); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-image"></i>
                                    </button>
                                    <a href="<?= BASE_URL ?>productcontroller/delete/<?= $product['fld_product_num'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No products found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>