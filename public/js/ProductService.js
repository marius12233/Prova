(function(){
	"use strict";

	angular
	.module('productShop')
	.service('ProductService',ProductService);

	//ProductService.$inject = ['$http', '$rootScope'];

	function ProductService(){
		var products = {};
        var addProduct = addProduct;
        var getProducts = getProducts;

        products.list = [];
        products.addProduct = addProduct;
        products.getProducts = getProducts;


    function addProduct(p){
        products.list.push(p);
    }

    function getProducts(){
        return products.list;
    }

    return products;



    };




		


})();