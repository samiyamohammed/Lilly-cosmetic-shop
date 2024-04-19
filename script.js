const products = document.querySelectorAll('.product');

products.forEach(product => {
    product.addEventListener('click', () => {
        product.classList.toggle('active');
    });
});