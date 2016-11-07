function confirmDeleteCategory(id) {
    var r = confirm("Are your sure to delete this category and all its products ?\nIt can't be undone.");
    if (r == true) {
        window.location.href = 'index.php?category=' + id + '&delete=true';
    }
}

function confirmDeleteProduct(id) {
    var r = confirm("Are your sure to delete this product ?\nIt can't be undone.");
    if (r == true) {
        window.location.href = 'index.php?product=' + id + '&delete=true';
    }
}