<?php
	session_start();	

	require_once 'assets/php/config/bdd.php';
	$req = $bdd->query('SELECT * FROM category ');
	$categories = $req->fetchAll();

	if(empty($_GET['category']))
		$category = $categories[0]['id'];
	else
		$category = $_GET['category'];

	$req = $bdd->prepare('SELECT * FROM product WHERE category_id=:category_id');
	$req->execute(array(':category_id' => $category));
	$products = $req->fetchAll();
?>

<?php
    include 'assets/php/partials/header.php';
    pageHeader('', ['product'], 2);
?>

	
<div id="container">

	<div class="content-categorie">
		<?php
			foreach($categories as $category) {
				?>
				<div class="categorie">	
					<a class="no-link" href="product.php?category=<?php echo $category['id']; ?>" >
				 		<?php echo $category['name'].' '; ?>
				 	</a>
				</div>  	
				<?php
			} 
		?>
	
	</div>

	<div class="row margin-top-row">
		
		<div class="full">
			<?php
				foreach($products as $product) { 
					?>
					<div class="product">
						<a class="title"><?php echo $product['name']; ?></a>
						<img src="assets/uploads/<?php echo $product['image']; ?>" class="image-product" />
						<a class="description"><?php echo $product['description']; ?></a>
						<a class="prix"><?php echo $product['price']; ?> €</a>

						<div class="add_sup">
							<div class="command">
								<a class="product_minus">-</a>
								<div class="product_number">1</div>
								<a class="product_plus">+</a>
							</div>

							<div >
								<a class="button">ADD</a>
							</div>
						</div>

					</div>
					<?php
				}
			?>

		</div>

		<div class="right-cart">
			<a class="top"><i class="fa fa-shopping-cart" aria-hidden="true">&nbsp &nbsp</i>cart</a>
			<div class="button button_order"><a href="cart.php" class="no-link">Validate your order</a></div>
			<div class="text_pickup">
				Pick-up : 11AM
			</div>
			<div class="text_resume">
				<table>
					<tbody>
						<tr>
							<td class="nb_product">1×3 croissants 3,00 €</td>
							<td class="prod_plus"><i class="fa fa-plus" aria-hidden="true"></td>
							<td class="prod_minus"><i class="fa fa-minus" aria-hidden="true"></td>
							<td class="prod_cancel"><i class="fa fa-times" aria-hidden="true"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<a class="bottom">Total $10</a>

			</div>

	</div>

</div>

<?php
    include 'assets/php/partials/footer.php';
?>




