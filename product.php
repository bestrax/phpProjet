<?php
	session_start();	

	require_once 'assets/php/config/bdd.php';

	$cart = array();
	$cartInfo = array('pickup' => 0, 'total' => 0);


	//To manage the pickup

	if (empty($_POST['pickup']) && !isset($_SESSION['cartPickup']))
		header('Location: index.php');

	if (!empty($_POST['pickup']))
		$_SESSION['cartPickup'] = $_POST['pickup'];

	$cartInfo['pickup'] = $_SESSION['cartPickup'];


	// To add an item to the cart

	if (!empty($_POST['id']) && !empty($_POST['quantity'])) {

		// If the cart doesn't exist
		if(!isset($_SESSION['cart']))
			$_SESSION['cart'] = array(array('id' => htmlentities($_POST['id']), 'quantity' => intval($_POST['quantity'])));

		//If the cart exists we try to add the quantity or we add the item
		else {
			$found = false;
			foreach ($_SESSION['cart'] as $i => $item) {
				if ($item['id'] == htmlentities($_POST['id'])) {
					$_SESSION['cart'][$i]['quantity'] += intval($_POST['quantity']);
					$found = true;
				}
			}

			if(!$found)
				$_SESSION['cart'][] = array('id' => htmlentities($_POST['id']), 'quantity' => intval($_POST['quantity']));
		}

	}

	// To modify item in the cart
	if (!empty($_POST['modify'])) {

		foreach ($_SESSION['cart'] as $i => $item) {
			if ($item['id'] == htmlentities($_POST['modify'])) {
				if (isset($_POST['plus']))
					$_SESSION['cart'][$i]['quantity']++;
				else if (isset($_POST['minus']))
					$_SESSION['cart'][$i]['quantity']--;

				if (isset($_POST['remove']) || $_SESSION['cart'][$i]['quantity'] <= 0)
					array_splice($_SESSION['cart'], $i, 1);
				break;
			}
		}

	}

	//To show the cart

	if (isset($_SESSION['cart'])) {

		foreach ($_SESSION['cart'] as $item) {
			$req = $bdd->prepare('SELECT id, name, price FROM product WHERE id=:id');
			$req->execute(array(':id' => $item['id']));
			$value = $req->fetch();
			$cart[] = array('item' => $value, 'quantity' => $item['quantity']);
			$cartInfo['total'] += $item['quantity'] * $value['price'];
		}

	}


	//To show the category and products
	$req = $bdd->query('SELECT * FROM category ');
	$categories = $req->fetchAll();


	if (empty($_GET['category']))
		$currentCategory = $categories[0]['id'];
	else
		$currentCategory = $_GET['category'];

	$req = $bdd->prepare('SELECT * FROM product WHERE category_id=:category_id');
	$req->execute(array(':category_id' => $currentCategory));
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
				<div class="categorie <?php echo $currentCategory == $category['id']  ? 'active' : ''; ?>">
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

							<form action="product.php<?php echo !empty($_GET['category']) ? '?category='.$_GET['category'] : ''; ?>" method="post">

								<input type="hidden" name="id" value="<?php echo $product['id']; ?>" />

								<div class="command">
									<a class="product_minus" onClick="minus(this);">-</a>
									<div class="product_number">1</div>
									<input type="hidden" name="quantity" value="1" />
									<a class="product_plus" onClick="plus(this);">+</a>
								</div>

								<div >
									<button type="submit" class="button">ADD</button>
								</div>

							</form>

						</div>

					</div>
					<?php
				}
			?>

		</div>

		<div class="right-cart">
			<a class="top"><i class="fa fa-shopping-cart" aria-hidden="true">&nbsp &nbsp</i>cart</a>

			<?php
				if (count($cart) > 0) {

			?>

					<div class="button button_order"><a href="cart.php" class="no-link">Validate your order</a></div>
					<div class="text_pickup">
						Pick-up : <?php echo $cartInfo['pickup']; ?>
					</div>
					<div class="text_resume">
						<table>
							<tbody>
							<?php
							foreach ($cart as $item) {
								?>
								<tr>
									<form action="product.php<?php echo !empty($_GET['category']) ? '?category='.$_GET['category'] : ''; ?>" method="post">
										<input type="hidden" name="modify" value="<?php echo $item['item']['id']; ?>"/>
										<td class="nb_product"><?php echo $item['quantity'] . ' x ' . $item['item']['name'] . ' $' . $item['item']['price']; ?></td>
										<td class="prod_plus">
											<button type="submit" name="plus">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</button>
										</td>
										<td class="prod_minus">
											<button type="submit" name="minus">
												<i class="fa fa-minus" aria-hidden="true"></i>
											</button>
										</td>
										<td class="prod_cancel">
											<button type="submit" name="remove">
												<i class="fa fa-times" aria-hidden="true"></i>
											</button>
										</td>
									</form>
								</tr>
								<?php
							}
							?>
							</tbody>
						</table>
					</div>

					<?php
				}
				else {
					?>
						<div class="text_empty"> Your cart is empty </div>
					<?php
				}
			?>
			<a class="bottom">Total $<?php echo $cartInfo['total']; ?></a>

			</div>

	</div>

</div>

<script src="assets/js/product.js"></script>

<?php
    include 'assets/php/partials/footer.php';
?>




